<template>
    <main>
        <loading v-model:active="this.$store.state.Loading.isLoading" :is-full-page="false" :color="`#242020`" :loader="`bars`"/>
        <SessionTimeout></SessionTimeout>
        <RouterView />
    </main>
</template>

<style lang="scss">

    // import 3rd party plugins css here
</style>

<script>
    import SessionTimeout from "./components/common/modal/SessionTimeout.vue";
    import Loading from 'vue-loading-overlay';

    export default {
        name: "AdsApp",

        components: {
            Loading,
            SessionTimeout
        }
    };
</script>
