<script setup>
import DataTable from "datatables.net-vue3";
import DataTablesCore from "datatables.net-bs5";
import "datatables.net-responsive-dt";
DataTable.use(DataTablesCore);

const props = defineProps({
    columns: {
        type: Array,
        default: [],
    },
    data: {
        type: Array,
        default: [],
    },
    setAction: {
        type: Boolean,
        default: true,
    },
    orderBy: {
        type: Array,
        default: [],
    },
    visibleFields: {
        type: Array,
        default: [],
    },
});

const options = {
    responsive: true,
    order: [props.orderBy],
};
</script>
<style scoped>
@import "datatables.net-dt";
</style>
<template>
    <!-- Table with stripped rows -->
    <div class="card-body">
        <DataTable class="display" width="100%" :options="options">
            <thead>
                <tr>
                    <th
                        v-for="(column, i) in props.columns"
                        :key="i"
                        scope="col"
                        class="text-start"
                    >
                        {{ column }}
                    </th>

                    <th v-if="setAction"></th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="items in props.data" :key="items">
                    <td
                        class="text-start"
                        scope="col"
                        v-if="props.visibleFields.length"
                        v-for="visibleField in props.visibleFields"
                        :key="visibleField"
                    >
                        {{ items[visibleField] }}
                    </td>

                    <td v-else v-for="item in items" :key="item">{{ item }}</td>
                    <td v-if="setAction">
                        <router-link
                            :to="`updateUser/${items.id}`"
                            class="btn btn-primary"
                        >
                            <i class="bi bi-pencil-square"></i
                        ></router-link>
                        <button class="btn btn-danger">
                            <i class="bi bi-trash-fill"></i>
                        </button>
                    </td>
                </tr>
            </tbody>
        </DataTable>
        <!-- End Table with stripped rows -->
    </div>
</template>
