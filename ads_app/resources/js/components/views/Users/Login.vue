<script setup>
import AuthService from "@/services/auth.service.js";
import TokenService from "@/services/token.service.js";
import { TextBox } from "@/components/common/fields/index";
import { reactive, ref } from "vue";
import { useRouter } from "vue-router";
import useHandleErrors from "@/components/common/shared/useHandleErrors.js";

const router = useRouter();
const credentials = reactive({
    username: "",
    password: "",
});
const errorMessage = ref({});

const handleLogin = async () => {
    try {
        const response = await AuthService.userLogin(credentials);
        TokenService.setToken(response.data.token);
        router.push({ name: "Home" });
    } catch (errors) {
        errorMessage.value = useHandleErrors(errors);
    }
};
</script>

<style scoped>
span {
    color: red;
    font-size: 0.8em;
}
</style>

<template>
    <main>
        <div class="container">
            <section
                class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4"
            >
                <div class="container">
                    <div class="row justify-content-center">
                        <div
                            class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center"
                        >
                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="pt-4 pb-2">
                                        <h5
                                            class="card-title text-center pb-0 fs-4"
                                        >
                                            Login to Your Account
                                        </h5>
                                        <p class="text-center small">
                                            Enter your username & password login
                                        </p>
                                    </div>

                                    <form
                                        class="row g-3 needs-validation"
                                        novalidate
                                        @submit.prevent="handleLogin"
                                    >
                                        <span
                                            v-if="
                                                typeof errorMessage === 'string'
                                            "
                                        >
                                            {{ errorMessage }}
                                        </span>

                                        <TextBox
                                            v-model="credentials.username"
                                            placeholder="Please enter a username"
                                            label="Usernames"
                                            :errorMessage="
                                                errorMessage.username
                                            "
                                        />
                                        <TextBox
                                            v-model="credentials.password"
                                            placeholder="Please enter a password"
                                            label="Password"
                                            type="password"
                                            :errorMessage="
                                                errorMessage.password
                                            "
                                        />
                                        <button
                                            type="submit"
                                            class="btn btn-primary"
                                        >
                                            Save
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </main>
    <!-- End #main -->
</template>
