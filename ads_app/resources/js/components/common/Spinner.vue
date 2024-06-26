<template>
    <!-- Center aligned spinner -->
    <div class="customSpinner" v-if="isLoading">
        <div class="spinner-border" style="width: 50px; height: 50px;" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div><!-- End Center aligned spinner -->
</template>

<script>
    export default {
        props: {
            isLoading: false
        },
        name: "Spinner"
    }
</script>

<style scoped>

</style>
