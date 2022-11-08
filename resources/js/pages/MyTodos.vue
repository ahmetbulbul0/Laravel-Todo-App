<template>
    <div class="container">
        <div class="md-box">
            <MyTodosHeader  @sorting="sorting" />
            <TodoList v-if="todos" :data="todos" @deleteTodo="deleteTodo" @completeTodo="completeTodo" />
        </div>
    </div>
</template>

<script setup>
import router from "../router";
import { getRequest, deleteRequestUrlValue, patchRequestUrlValue, getRequestQuery } from "../api";
import { useStore } from 'vuex';
import axios from "axios";
import { ref } from "@vue/reactivity";
import { defineAsyncComponent, onMounted, watch } from "@vue/runtime-core";
const TodoList = defineAsyncComponent((todos) => import("../components/TodoList.vue"));
const MyTodosHeader = defineAsyncComponent((todos) => import("../components/MyTodosHeader.vue"));
const store = useStore();

var todos = ref("");

if (store.state.myTodosSorting) {
    todos.value = await getRequestQuery("todos", store.state.token, { sorting: store.state.myTodosSorting });
} else {
    todos.value = await getRequest("todos", store.state.token);
}

async function sorting(sortingValue) {
    todos.value = null;
    todos.value = await getRequestQuery("todos", store.state.token, { sorting: sortingValue });
    store.commit("setMyTodosSorting", sortingValue);
}

async function deleteTodo(todoId) {
    await deleteRequestUrlValue("todos", store.state.token, todoId);
    location.reload();
}
async function completeTodo(todoId) {
    await patchRequestUrlValue("todos", store.state.token, todoId, { isCompleted: true });
    location.reload();
}
</script>
