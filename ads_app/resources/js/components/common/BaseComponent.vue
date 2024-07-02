<template>
    <Header></Header>
    <Sidebar></Sidebar>
    <main id="main" class="main"> <slot></slot> </main>
    <Footer></Footer>
</template>

<script>
    import Header from '@/components/common/layout/Header.vue';
    import Sidebar from '@/components/common/layout/Sidebar.vue';
    import Footer from '@/components/common/layout/Footer.vue';

    export default {
        name: "BaseComponent",
        components: {
            Header,
            Sidebar,
            Footer
        }
    }
</script>

<style scoped>

</style>
