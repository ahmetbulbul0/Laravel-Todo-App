<template>
    <div class="container">
        <div class="md-box">
            <div class="header">
                <div class="title size140">
                    <span>Todo Edit</span>
                </div>
                <div class="links">
                    <router-link :to="{ name: 'MyTodos' }" class="bg-redPink link">My Todo's</router-link>
                    <router-link :to="{ name: 'NewTodo' }" class="bg-redPink link">Add Todo</router-link>
                    <a class="bg-redPink link" @click="store.commit('logOut')">Log Out</a>
                </div>
            </div>
            <form class="form mt12" @submit.prevent="updateTodo">
                <div class="line">
                    <label>Content:</label>
                    <textarea class="mt12 h140" v-model="todo.content">{ todo.content }</textarea>
                </div>
                <div class="line">
                    <label>Is Completed:</label>
                    <div class="radios around">
                        <label>
                            <input type="radio" v-model="todo.isCompleted" value="1" :checked="todo.isCompleted">
                            Yes
                        </label>
                        <label>
                            <input type="radio" v-model="todo.isCompleted" value="0" :checked="!todo.isCompleted">
                            No
                        </label>
                    </div>
                </div>
                <div class="line">
                    <button class="fullBtn bg-green">Edit Todo</button>
                </div>
            </form>
        </div>
    </div>
</template>

<script setup>

import router from "../router";
import { useRoute } from "vue-router";
import { useStore } from "vuex";
import { getRequestUrlValue, patchRequestUrlValue } from "../api";
const route = useRoute();
const store = useStore();

const todoId = route.params.todoId;

var todo = await getRequestUrlValue("todos", store.state.token, todoId);

if (todo.response && todo.response.status == 404) {
    router.push({ name: "MyTodos" });
}

todo = todo.data.data;

async function updateTodo () {
    const data = {
        content: todo.content,
        isCompleted: todo.isCompleted
    };
    await patchRequestUrlValue(
        "todos",
        store.state.token,
        todoId,
        data
    );
    router.push({ name: "MyTodos" });
}

</script>
