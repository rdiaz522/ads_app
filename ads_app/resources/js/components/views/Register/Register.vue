<template>
    <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

                    <div class="d-flex justify-content-center py-4">
                        <a href="index.html" class="logo d-flex align-items-center w-auto">
                            <img src="assets/img/logo.png" alt="">
                            <span class="d-none d-lg-block">NiceAdmin</span>
                        </a>
                    </div><!-- End Logo -->

                    <div class="card mb-3">

                        <div class="card-body">

                            <div class="pt-4 pb-2">
                                <h5 class="card-title text-center pb-0 fs-4">Create an Account</h5>
                                <p class="text-center small">Enter your personal details to create account</p>
                            </div>

                            <form class="row g-3 needs-validation" @submit.prevent="(e) => e.preventDefault()"
                                  novalidate>
                                <div class="col-12">
                                    <label for="firstName" class="form-label">First Name</label>
                                    <input type="text" name="firstname" v-model="formData.firstname"
                                           class="form-control" id="firstName" required>
                                    <div class="invalid-feedback">Please, enter your first name!</div>
                                </div>

                                <div class="col-12">
                                    <label for="lastname" class="form-label">Last Name</label>
                                    <input type="text" name="lastname" v-model="formData.lastname" class="form-control"
                                           id="lastname" required>
                                    <div class="invalid-feedback">Please, enter your Last name!</div>
                                </div>

                                <div class="col-12">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="text" name="email" v-model="formData.email" class="form-control"
                                           id="email" required>
                                    <div class="invalid-feedback">Please, enter your Email!</div>
                                </div>

                                <div class="col-12">
                                    <label class="col-sm-2 col-form-label">Gender</label>
                                    <select class="form-select" name="gender" v-model="formData.gender"
                                            aria-label="Default select example">
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                    </select>
                                </div>

                                <div class="col-12">
                                    <label for="username" class="form-label">Username</label>
                                    <input type="text" name="username" v-model="formData.username" class="form-control"
                                           id="username" required>
                                    <div class="invalid-feedback">Please, enter your username!</div>
                                </div>

                                <div class="col-12">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" name="password" v-model="formData.password"
                                           class="form-control" id="password" required>
                                    <div class="invalid-feedback">Please, enter your password!</div>
                                </div>

                                <div class="col-12">
                                    <div class="form-check">
                                        <input class="form-check-input" name="terms" type="checkbox" value=""
                                               id="acceptTerms" required>
                                        <label class="form-check-label" for="acceptTerms">I agree and accept the <a
                                            href="#">terms and conditions</a></label>
                                        <div class="invalid-feedback">You must agree before submitting.</div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button class="btn btn-primary w-100" @click="register">Create Account</button>
                                </div>
                                <div class="col-12">
                                    <p class="small mb-0">Already have an account?
                                        <router-link to="/">Log in</router-link>
                                    </p>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
</template>

<script lang="ts">
    import {UserFormData} from "@/types/users";
    import UserService from '@/services/user.service';

    export default {
        name: "Register",
        data() {
            return {
                formData: {} as UserFormData,
                errors: {}
            }
        },

        methods: {
            register() {
                UserService.register(this.formData).then((response) => {
                    console.log(response);
                }, (errors) => {
                    this.errors = errors;
                    console.log(this.errors);
                })
            }
        }
    }
</script>

<style scoped>

</style>
