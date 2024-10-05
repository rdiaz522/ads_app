import Login from "@/components/views/Users/Login.vue";

export default [
    {
        path: "/",
        name: "Login",
        component: Login,
    },
    {
        path: "/createUser",
        name: "CreateUser",
        meta: { requiresAuth: true },
        component: () => import("@/components/views/Users/CreateOrUpdate.vue"),
    },
    {
        path: "/updateUser/:id",
        name: "UpdateUser",
        meta: { requiresAuth: true },
        component: () => import("@/components/views/Users/CreateOrUpdate.vue"),
    },
    {
        path: "/users",
        name: "Users",
        meta: { requiresAuth: true },
        component: () => import("@/components/views/Users/Users.vue"),
    },
];
