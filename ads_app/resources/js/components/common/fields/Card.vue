<script setup>
const props = defineProps({
    cardClass: {
        type: String,
        default: "card mb-3 mt-3 ms-3 me-3",
    },
    header: {
        type: String,
        default: "",
    },
    footer: {
        type: String,
        default: "",
    },
});
</script>

<style scoped></style>
<template>
    <div class="card">
        <div class="card-header">
            <slot name="header"></slot>
        </div>
        <div :class="[props.cardClass]">
            <div class="card-body">
                <slot></slot>
            </div>
        </div>
        <div class="footer">
            <slot name="footer"></slot>
        </div>
    </div>
</template>
