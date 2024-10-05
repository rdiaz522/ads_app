<template>
    <div :class="[divClass]">
        <button :class="[btnClass]" :type="type" @click="onClick">
            <slot></slot>
        </button>
    </div>
</template>

<script>
export default {
    name: "Button",
    props: {
        divClass: {
            type: String,
            default: 'col-12'
        },
        btnClass: {
            type: String,
            default: 'btn btn-primary'
        },
        type: {
            type: String,
            default: ''
        }
    },
    methods: {
        onClick() {
            this.$emit('on-clicked')
        }
    }
}
</script>

<style scoped>

</style>
