<script setup>
import { TextBox, Button, Card, Dropdown } from "@/components/common/fields/index"; // prettier-ignore
import UserService from "@/services/user.service.js";
import BaseComponent from "@/components/common/BaseComponent.vue";
import { onMounted, reactive, ref } from "vue";
import useHandleErrors from "@/components/common/shared/useHandleErrors.js";
import { useRoute } from "vue-router";

const route = useRoute();
const isEdit = ref(false);

const userForm = {
    firstname: "",
    lastname: "",
    middlename: "",
    email: "",
    username: "",
    password: "",
    gender: "",
    user_type: "",
};

const getUserById = async () => {
    const response = await UserService.getUserById(route.params.id);
    console.log(response);
};

// Check if the route is for Update User
if (route.name == "UpdateUser") {
    getUserById();
    isEdit.value = true;
}

const formData = reactive({ ...userForm });

const gender = {
    Male: "male",
    Female: "female",
};

const user_type = {
    Administrator: "ADMINISTRATOR",
    User: "USER",
};

const errorMessage = ref({});
const successMessage = ref("");
const success = ref(false);

const save = async () => {
    try {
        resetValues();
        let response;
        if (isEdit.value) {
            response = await UserService.updateUser(formData);
        } else {
            response = await UserService.createUser(formData);
        }
        const result = response.data;
        successMessage.value = result.message;
        success.value = result.success;
        Object.assign(formData, { ...userForm });
    } catch (errors) {
        errorMessage.value = useHandleErrors(errors);
    }
};

const resetValues = () => {
    errorMessage.value = {};
    success.value = false;
    successMessage.value = "";
};
</script>

<style scoped>
span {
    color: red;
    font-size: 0.8em;
}
</style>

<template>
    <BaseComponent>
        <Card>
            <template v-slot:header>
                <router-link to="/users" class="float-end me-3">
                    <i class="bi bi-arrow-left-circle h1"></i>
                </router-link>
                <h2 class="card-title pb-0 fs-4">
                    <i class="bi bi-people-fill"></i> Create User
                </h2>
            </template>
            <div
                v-if="success"
                class="alert alert-success alert-dismissible fade show"
                role="alert"
            >
                {{ successMessage }}
                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="alert"
                    aria-label="Close"
                ></button>
            </div>
            <form class="needs-validation" @submit.prevent="save">
                <div class="row">
                    <TextBox
                        class="col-lg-4 mb-3"
                        label="First Name"
                        placeholder="Enter First Name"
                        v-model="formData.firstname"
                        :errorMessage="errorMessage.firstname"
                    />

                    <TextBox
                        class="col-lg-4 mb-3"
                        label="Last Name"
                        placeholder="Enter Last Name"
                        v-model="formData.lastname"
                        :errorMessage="errorMessage.lastname"
                    />

                    <TextBox
                        class="col-lg-4 mb-3"
                        label="Middle Name"
                        placeholder="Enter Middle Name"
                        v-model="formData.middlename"
                        :errorMessage="errorMessage.middlename"
                    />

                    <TextBox
                        class="col-lg-4 mb-3"
                        label="Email"
                        placeholder="Enter Email"
                        v-model="formData.email"
                        type="email"
                        :errorMessage="errorMessage.email"
                    />

                    <TextBox
                        class="col-lg-4 mb-3"
                        label="Username"
                        placeholder="Enter Username"
                        v-model="formData.username"
                        :errorMessage="errorMessage.username"
                    />

                    <TextBox
                        class="col-lg-4 mb-3"
                        label="Password"
                        placeholder="Enter Password"
                        v-model="formData.password"
                        type="password"
                        :errorMessage="errorMessage.password"
                    />

                    <Dropdown
                        class="col-lg-4 mb-3"
                        :options="gender"
                        label="Gender"
                        defaultSelect="Select Gender"
                        v-model="formData.gender"
                        :errorMessage="errorMessage.gender"
                    />

                    <Dropdown
                        class="col-lg-4 mb-3"
                        :options="user_type"
                        label="User Type"
                        defaultSelect="Select User Type"
                        v-model="formData.user_type"
                        :errorMessage="errorMessage.user_type"
                    />
                </div>

                <button type="submit" class="btn btn-success float-end me-3">
                    <i class="bi bi-save h5"></i> Save
                </button>
            </form>
        </Card>
    </BaseComponent>
</template>
