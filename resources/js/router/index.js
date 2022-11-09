import { createRouter, createWebHistory } from "vue-router";
import store from "../store";

const router = createRouter({
    history: createWebHistory(import.meta.env.BASE_URL),
    routes: [
        {
            name: "Welcome",
            path: "/",
            component: () => import("../pages/Welcome.vue"),
            meta: {
                isGuest: true,
            },
        },
        {
            name: "Login",
            path: "/login",
            component: () => import("../pages/Login.vue"),
            meta: {
                isGuest: true,
            },
        },
        {
            name: "Register",
            path: "/register",
            component: () => import("../pages/Register.vue"),
            meta: {
                isGuest: true,
            },
        },
        {
            name: "MyTodos",
            path: "/my-todos/:page?",
            component: () => import("../pages/MyTodos.vue"),
            meta: {
                requiresAuth: true,
                isUser: true,
            },
        },
        {
            name: "AllTodos",
            path: "/all-todos/:page?",
            component: () => import("../pages/MyTodos.vue"),
            meta: {
                requiresAuth: true,
                isAdmin: true,
            },
        },
        {
            name: "NewTodo",
            path: "/new-todo",
            component: () => import("../pages/NewTodo.vue"),
            meta: {
                requiresAuth: true,
            },
        },
        {
            name: "TodoDetail",
            path: "/todo-detail/:todoId",
            component: () => import("../pages/TodoDetail.vue"),
            meta: {
                requiresAuth: true,
            },
        },
        {
            name: "TodoEdit",
            path: "/todo-edit/:todoId",
            component: () => import("../pages/TodoEdit.vue"),
            meta: {
                requiresAuth: true,
            },
        },
    ],
});

router.beforeEach((to, from, next) => {
    if (to.meta.requiresAuth && !store.state.token) {
        next({ name: "Login" });
    } else if (to.meta.isAdmin && store.state.userType == "user") {
        next({ name: "MyTodos" });
    } else if (to.meta.isUser && store.state.userType == "admin") {
        next({ name: "AllTodos" });
    } else if (store.state.token && to.meta.isGuest) {
        if (store.state.userType == "admin") {
            next({ name: "AllTodos" });
        } else {
            next({ name: "MyTodos" });
        }
    } else {
        next();
    }
});

export default router;
