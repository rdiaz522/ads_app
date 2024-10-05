<template>
    <Header></Header>
    <Sidebar></Sidebar>
    <main id="main" class="main app">
        <slot></slot>
    </main>
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
html, body {
    height: 100%;
    margin: 0;
    padding: 0;
}

.app {
    display: flex;
    flex-direction: column;
    min-height: 100vh;
}
</style>
