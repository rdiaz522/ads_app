<template>
    <main>
        <div class="container">
            <section
                class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

                            <div class="card mb-3">

                                <div class="card-body">

                                    <div class="pt-4 pb-2">
                                        <h5 class="card-title text-center pb-0 fs-4">Login to Your Account</h5>
                                        <p class="text-center small">Enter your username & password login</p>
                                    </div>

                                    <form class="row g-3 needs-validation" novalidate
                                          @submit.prevent="(e) => e.preventDefault()">

                                        <span v-if="errors !== null && typeof errors !== 'object' && typeof errors === 'string'" > {{ errors }} </span>

                                        <div class="col-12">
                                            <label for="yourUsername" class="form-label">Username</label>
                                            <input type="text" name="email" class="form-control"
                                                   v-model="credentials.username" id="yourUsername" required>
                                            <span v-if="errors.username" > {{ errors.username[0] }} </span>
                                        </div>

                                        <div class="col-12">
                                            <label for="yourPassword" class="form-label">Password</label>
                                            <input type="password" name="password" class="form-control"
                                                   v-model="credentials.password" id="yourPassword" required>
                                            <span v-if="errors.password" > {{ errors.password[0] }} </span>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="remember"
                                                       value="true" id="rememberMe">
                                                <label class="form-check-label" for="rememberMe">Remember me</label>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <button class="btn btn-primary w-100" type="submit" @click="login">Login
                                            </button>
                                        </div>
                                        <div class="col-12">
                                            <p class="small mb-0">Don't have account?  <router-link to="/register"> Create an account </router-link></p>

                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </section>

        </div>
    </main><!-- End #main -->
</template>

<script>
    import AuthService from '@/services/auth.service';
    import TokenService from '@/services/token.service';

    export default {
        data() {
            return {
                credentials: {username: null, password: null},
                token: TokenService.getToken('token'),
                errors: {}
            }
        },

        methods: {
            login() {
                AuthService.userLogin(this.credentials).then((response) => {
                    if (response.data) {
                        TokenService.setToken(response.data.token);
                        this.$router.push('home');
                    }
                }, (errors) => {
                    this.errors = errors;
                });
            }
        }
    }

</script>

<style scoped>
    span {
        color:red;
        font-size: 0.8em;
    }

</style>
