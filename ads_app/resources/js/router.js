import {createWebHistory, createRouter} from 'vue-router';
import Dashboard from '@/routes/dashboard';
import NotFound from '@/components/views/NotFound.vue';
import Customer from '@/routes/customer';
import Users from '@/routes/users';

const routes = [
    ...Users,
    Dashboard,
    Customer,
    {
        path: '/:pathMatch(.*)*',
        name: 'NotFound',
        component: NotFound
    }
];

const router = new createRouter({
    history: createWebHistory(),
    routes,
});

router.beforeEach((to, from, next) => {
    const token = localStorage.getItem('token');
    if (to.matched.some(record => record.meta.requiresAuth) && !token) {
        next({name: 'Login'});
    } else if (to.name === 'Login' && token) {
        next({name: 'Home'});
    } else {
        next();
    }

});


export default router;
