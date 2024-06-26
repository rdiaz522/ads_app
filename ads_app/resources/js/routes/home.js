import Home from '@/components/views/Home/Home.vue';

export default {
    path: '/home',
    name: 'home',
    component: Home,
    meta: { requiresAuth: true }
};
