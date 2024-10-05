<template>
    <div>
        <BaseComponent>
            <h5>HELLO WORLD</h5>
        </BaseComponent>
    </div>
</template>

<script>
import UserService from "@/services/user.service";
import BaseComponent from "@/components/common/BaseComponent.vue";

export default {
    name: "Dashboard",

    components: {
        BaseComponent,
    },

    methods: {},

    mounted() {
        console.log("Mounted");
        UserService.getUsers(
            (response) => {
                console.log(response);
            },
            (error) => {
                console.log(error);
            }
        );
    },

    beforeMount() {
        console.log("BeforeMounted");
    },
};
</script>
