<template>
    <div>
        <label class="form-label">{{field.name}}</label>
        <div class="input-group has-validation" :class="{ 'has-error': submitted && val[field.name] && val[field.name].$error }">
            <span class="input-group-text" id="inputGroupPrepend">@</span>
            <input type="text" name="name" class="form-control" id="yourUsername" required>
            <div class="invalid-feedback">{{field.name.$error}}</div>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            field: Object,
            submitted: Boolean
        }
    }
</script>
