<template>
    <div class="container">
        <div class="md-box">
            <div class="header">
                <div class="title size140">
                    <span>Todo Detail</span>
                </div>
                <div class="links">
                    <router-link :to="{ name: 'TodoEdit', params: { todoId: todo.id } }" class="bg-green link link-icon"><i class="fa-solid fa-pen-to-square"></i></router-link>
                    <a @click="deleteTodo(todo.id)" class="bg-red link link-icon"><i class="fa-solid fa-trash"></i></a>
                    <router-link :to="{ name: 'MyTodos' }" class="bg-redPink link">My Todo's</router-link>
                    <router-link :to="{ name: 'NewTodo' }" class="bg-redPink link">New Todo</router-link>
                    <a class="bg-redPink link" @click="store.dispatch('logOut')">Log Out</a>
                </div>
            </div>
            <div class="list">
                <div class="item block">
                    <label>Content:</label>
                    <textarea class="mt12 h140" v-model="todo.content" readonly>{ todo.content }</textarea>
                </div>
                <div class="item block">
                    <label>Added Time:</label>
                    <div class="item dateTime">
                        <input type="date" v-model="addedDate" readonly />
                        <input type="time" v-model="addedTime" readonly />
                    </div>
                </div>
                <div class="item block">
                    <label>Is Completed:</label>
                    <input type="text" v-model="isCompleted" class="mt12" readonly />
                </div>
                <div class="item block">
                    <label>User:</label>
                    <input type="text" v-model="user" readonly class="mt12" />
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import router from "../router";
import { useRoute } from "vue-router";
import { useStore } from "vuex";
import { getRequestUrlValue, deleteRequestUrlValue, patchRequestUrlValue } from "../api";
const route = useRoute();
const store = useStore();

const todoId = route.params.todoId;

var todo = await getRequestUrlValue("todos", store.state.token, todoId);

if (todo.response && todo.response.status == 404) {
    router.push({ name: "MyTodos" });
}

todo = todo.data.data;

const splitAddedTime = todo.addedTime.split(" ");

const addedDate = splitAddedTime[0];
const addedTime = splitAddedTime[1];

const user = todo.user.fullName + " (" + todo.user.username + ")";

const isCompleted = todo.isCompleted ? "yes" : "no";

async function deleteTodo(todoId) {
    await deleteRequestUrlValue("todos", store.state.token, todoId);
    location.reload();
}

async function completeTodo(todoId) {
    await patchRequestUrlValue("todos", store.state.token, todoId, { isCompleted: true });
    router.push({ name: "MyTodos" });
    location.reload();
}

</script>
