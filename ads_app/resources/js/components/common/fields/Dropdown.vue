<script setup>
import { computed } from "vue";
const emit = defineEmits(["update:modelValue"]);
const props = defineProps({
    modelValue: {
        type: String,
        default: "",
    },
    mainClass: {
        type: String,
        default: "",
    },
    defaultSelect: {
        type: String,
        default: "",
    },
    options: {
        type: Object,
        default: [],
    },
    placeholder: {
        type: String,
        default: "",
    },
    label: {
        type: String,
        default: "",
    },
    isRequired: {
        type: Boolean,
        default: false,
    },
    isShow: {
        type: Boolean,
        default: true,
    },
    errorMessage: {
        type: String,
        default: "",
    },
});

const isInvalid = computed(() => props.errorMessage.trim() !== "");
const selectValue = (e) => {
    emit("update:modelValue", e.target.value);
};
</script>

<style scoped>
span {
    color: red;
    font-size: 0.8em;
}
.is-invalid {
    border-color: red;
}
</style>

<template>
    <div v-if="isShow">
        <label class="form-label mb-2">{{ label }}</label>
        <select
            @change="selectValue($event)"
            :class="[mainClass, 'form-select', { 'is-invalid': isInvalid }]"
            :placeholder="placeholder"
            :value="modelValue"
        >
            <option selected disabled value="">{{ defaultSelect }}</option>
            <option
                v-for="(value, item, index) in options"
                :key="index"
                :value="value"
            >
                {{ item }}
            </option>
        </select>
        <span v-if="props.errorMessage">{{ props.errorMessage }}</span>
    </div>
</template>
