<template>
    <div class="container">
        <div class="md-box">
            <div class="header">
                <div class="title size140">
                    <span>New Todo</span>
                </div>
                <div class="links">
                    <router-link
                        :to="{ name: 'MyTodos' }"
                        class="bg-redPink link"
                        >My Todo's</router-link
                    >
                    <a class="bg-redPink link" @click="store.dispatch('logOut')"
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

const content = ref("");

async function newTodo() {
    const todo = await postRequest("todos", store.state.token, {
        content: content.value,
    });
    if (store.state.userType == "admin") {
        router.push({ name: "AllTodos" });
    } else {
        router.push({ name: "MyTodos" });
    }
}
</script>
