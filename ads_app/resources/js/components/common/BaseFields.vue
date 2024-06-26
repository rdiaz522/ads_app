<template>
    <div>
       <form novalidate class="create-form" @submit.prevent="(e) => e.preventDefault()">
           <div v-for="fields in rows" :keys="fields.name">
                <Text v-if="fields.name === 'textbox'" v-model=""></Text>
           </div>
       </form>
    </div>
</template>

<script>
    import { Text } from '@/components/fields';

    export default {
        props: {
            fields: Object
        },
        components: {
            Text
        }
    }
</script>
