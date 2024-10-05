
export default {
    path: '/customer-management',
    name: 'customer-managemet',
    component: () => import('@/components/views/CustomerManagement/CustomerManagement.vue'),
    meta: { requiresAuth: true }
};
