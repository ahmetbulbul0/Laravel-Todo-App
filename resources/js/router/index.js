import { createRouter, createWebHistory } from "vue-router";

const router = createRouter({
    history: createWebHistory(import.meta.env.BASE_URL),
    routes: [
        {
            name: "Welcome",
            path: "/",
            component: () => import("../pages/Welcome.vue"),
        },
        {
            name: "Login",
            path: "/login",
            component: () => import("../pages/Login.vue"),
        },
        {
            name: "Register",
            path: "/register",
            component: () => import("../pages/Register.vue"),
        },
        {
            name: "MyTodos",
            path: "/my-todos",
            component: () => import("../pages/MyTodos.vue"),
        },
        {
            name: "NewTodo",
            path: "/new-todo",
            component: () => import("../pages/NewTodo.vue"),
        },
        {
            name: "TodoDetail",
            path: "/todo-detail/:todoId",
            component: () => import("../pages/TodoDetail.vue"),
        },
        {
            name: "TodoEdit",
            path: "/todo-edit/:todoId",
            component: () => import("../pages/TodoEdit.vue"),
        },
        {
            name: "LogOut",
            path: "/log-out",
            component: () => import("../pages/TodoEdit.vue"),
        },
        {
            name: "TodoDelete",
            path: "/log-out",
            component: () => import("../pages/TodoEdit.vue"),
        },
        {
            name: "IsComplete",
            path: "/log-out",
            component: () => import("../pages/TodoEdit.vue"),
        },
    ],
});

export default router;
