<template>
    <div class="modal fade" id="smallModal" tabindex="-1" ref="sessionModal">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Your Session is about to expire in : {{ sessionTimeLeft }} seconds</h5>
                </div>
                <div class="modal-body">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" @click="logout" data-bs-dismiss="modal">Logout
                    </button>
                    <button type="button" class="btn btn-primary" @click="continueSession" data-bs-dismiss="modal">Continue
                    </button>
                </div>
            </div>
        </div>
    </div><!-- End Small Modal-->
</template>

<script>
    import AuthService from '@/services/auth.service';
    import SessionService from '@/services/session.service';
    import { mapActions, mapGetters } from 'vuex';


    export default {
        name: "SessionTimeout",

        computed: {
            ...mapGetters('Sessions', ['sessionTimeLeft']),
        },

        methods: {
            ...mapActions('Sessions', ['getModalRefs', 'startTimer']),

            getRefModals() {
                this.getModalRefs(this.$refs);
            },

            continueSession() {
                this.startTimer(30);
            },

            async logout() {
                try {
                    await AuthService.userLogout();
                    SessionService.logoutSession();
                    this.$router.push({name: 'login'});
                } catch (error) {
                    console.log(error);
                }
            },
        },

        mounted() {
            this.getRefModals();
        }

    }
</script>

<style scoped>

</style>
