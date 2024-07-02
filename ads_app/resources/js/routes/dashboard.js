import Dashboard from '@/components/views/Dashboard/Dashboard.vue';

export default {
    path: '/home',
    name: 'home',
    component: Dashboard,
    meta: { requiresAuth: true }
};
