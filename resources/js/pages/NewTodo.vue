<template>
    <div class="container">
        <div class="md-box">
            <div class="header">
                <div class="title size140">
                    <span>Todo Add</span>
                </div>
                <div class="links">
                    <router-link
                        :to="{ name: 'MyTodos' }"
                        class="bg-redPink link"
                        >My Todo's</router-link
                    >
                    <a class="bg-redPink link" @click="store.commit('logOut')"
                        >Log Out</a
                    >
                </div>
            </div>
            <form class="form mt12" @submit.prevent="newTodo">
                <div class="line">
                    <label>Content:</label>
                    <textarea
                        class="mt6 h140"
                        v-model="content"
                        required
                    ></textarea>
                </div>
                <div class="line">
                    <button class="fullBtn bg-green">Add Todo</button>
                </div>
            </form>
        </div>
    </div>
</template>

<script setup>
import router from "../router";
import { useStore } from "vuex";
import { ref } from "@vue/reactivity";
import { postRequest } from "../api";
const store = useStore();

if (!store.state.token) {
    router.push({ name: "Login" });
}

const content = ref("");

async function newTodo() {
    const todo = await postRequest(
        "todos",
        { content: content.value },
        store.state.token
    );
    router.push({ name: "MyTodos" });
}
</script>
