<script setup>
import BaseComponent from "@/components/common/BaseComponent.vue";
import Datatable from "@/components/common/fields/Datatable.vue";
import UserService from "@/services/user.service";
import { onMounted, ref } from "vue";
const columns = ["Full Name", "Role", "Status", "Created At", "Created By"];
const visibleFields = [
    "fullname",
    "user_type",
    "login_status",
    "created_at",
    "created_by",
];
const dataRaw = ref([]);

const getUsers = async () => {
    try {
        const response = await UserService.getUserDataTable();
        dataRaw.value = response.data.data;
    } catch (errors) {
        console.log(errors);
    }
};

onMounted(() => {
    getUsers();
});
</script>

<style scoped></style>

<template>
    <BaseComponent>
        <div class="card">
            <div class="card-header">
                <router-link to="/createUser" class="btn btn-primary float-end"
                    ><i class="bi bi-plus-circle-dotted h5"></i> Add User
                </router-link>
                <h2><i class="bi bi-people"></i> Users</h2>
            </div>
            <Datatable
                :columns="columns"
                :visibleFields="visibleFields"
                :data="dataRaw"
                :orderBy="[3, 'desc']"
                v-if="dataRaw.length"
            ></Datatable>
        </div>
    </BaseComponent>
</template>
