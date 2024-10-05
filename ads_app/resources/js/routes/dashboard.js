import Dashboard from '@/components/views/Dashboard/Dashboard.vue';

export default {
    path: '/home',
    name: 'Home',
    component: Dashboard,
    meta: { requiresAuth: true }
};
