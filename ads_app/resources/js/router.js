import {createWebHistory, createRouter} from 'vue-router';
import Login from '@/routes/login';
import Home from '@/routes/home';
import NotFound from '@/components/views/NotFound.vue';


const routes = [
    Login,
    Home,
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
        next({ name : 'login'});
    } else if (to.name === 'login' && token) {
        next({ name : 'home'});
    }else {
        next();
    }

});


export default router;
