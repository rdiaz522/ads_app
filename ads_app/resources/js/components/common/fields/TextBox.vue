<script setup>
import { ref, computed } from "vue";
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
    type: {
        type: String,
        default: "text",
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
const type = ref(props.type);
const errorState = ref(props.errorMessage);

const errors = computed({
    get() {
        return errorState.value;
    },
    set(newValue) {
        errorState.value = newValue;
    },
});

const isInvalid = computed(
    () => props.errorMessage.trim() !== "" || errors.value.trim() !== ""
);

const handleInput = (e) => {
    if (props.isRequired) {
        validateInput(e.target.value);
    }
    emit("update:modelValue", e.target.value);
};

const validateInput = (inputValue) => {
    if (inputValue.trim() === "") {
        errors.value = "This field is required!";
    } else {
        errors.value = "";
    }
};
</script>

<style scoped>
.color-red {
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
        <div class="input-group">
            <span
                v-if="type === 'email'"
                class="input-group-text"
                id="inputGroupPrepend"
                >@</span
            >
            <input
                @input="handleInput($event)"
                :class="[
                    'form-control',
                    mainClass,
                    { 'is-invalid': isInvalid },
                ]"
                :type="type"
                :placeholder="placeholder"
                aria-describedby="inputGroupPrepend"
                :value="modelValue"
            />
        </div>

        <span class="color-red" v-if="errors">{{ errors }}</span>
        <span class="color-red" v-else-if="props.errorMessage">{{
            props.errorMessage
        }}</span>
    </div>
</template>
