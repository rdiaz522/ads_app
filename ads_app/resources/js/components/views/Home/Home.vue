<template>
    <div>
        Hello World!
        <button class="btn btn-primary sm" @click="logout">Logout</button>
    </div>
</template>

<script>
    import AuthService from '@/services/auth.service';
    import UserService from '@/services/user.service';
    import SessionService from '@/services/session.service';
    import { mapActions } from 'vuex';

    export default {
        name: "Home",
        methods: {
            ...mapActions('Sessions', ['stopTimer']),

            async logout() {
                try {
                    await AuthService.userLogout();
                    SessionService.logoutSession();
                    this.stopTimer();
                    this.$router.push({name: 'login'});
                } catch (error) {
                    console.log(error);
                }
            },
        },

        mounted() {
            console.log('Mounted');
            UserService.getUser((response) => {
                console.log(response);
            }, (error) => {
                console.log(error);
            })
        },

        beforeMount() {
            console.log('BeforeMounted');
        }
    }

</script>
