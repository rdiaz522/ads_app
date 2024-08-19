import CustomerManagement from '@/components/views/CustomerManagement/CustomerManagement.vue';

export default {
    path: '/customer-management',
    name: 'customer-managemet',
    component: CustomerManagement,
    meta: { requiresAuth: true }
};
