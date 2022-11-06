<template>
    <div class="container">
        <div class="md-box">
            <div class="header">
                <div class="title size140">
                    <span>My Todo's</span>
                </div>
                <div class="select">
                    <select>
                        <option selected disabled>Sorting</option>
                        <option>First Incomplete Todo's</option>
                        <option>First Completed Todo's</option>
                        <option>First Newest</option>
                        <option>First Oldest</option>
                    </select>
                </div>
                <div class="links">
                    <router-link :to="{ name: 'NewTodo' }" class="bg-redPink link">Add Todo</router-link>
                    <a class="bg-redPink link" @click="store.commit('logOut')">Log Out</a>
                </div>
            </div>
            <div class="header">
                <div class="radios left">
                    <label>
                        <input type="radio" name="filter">
                        Completed Todo's
                    </label>
                    <label>
                        <input type="radio" name="filter">
                        Incomplete Todo's
                    </label>
                </div>
                <div class="text">
                    <input type="text" placeholder="Searh in my todos...">
                </div>
            </div>
            <div class="list" v-if="todos.data.data.length > 0">
                <div class="item column3 between" v-for="todo in todos.data.data" :key="todo.id">
                    <div class="links">
                        <a class="bg-darkGreen1 hoverGreen1 icon"><i class="fa-regular fa-circle-check"></i></a>
                        <router-link :to="{ name: 'TodoDetail', params: { todoId: todo.id } }">{{ todo.content }}</router-link>
                    </div>
                    <div class="links">
                        <router-link :to="{ name: 'TodoDetail', params: { todoId: todo.id } }" class="bg-darkPink hoverPink icon"><i class="fa-solid fa-up-right-from-square"></i></router-link>
                        <a class="bg-darkRed hoverRed icon"><i class="fa-solid fa-trash"></i></a>
                        <router-link :to="{ name: 'TodoEdit', params: { todoId: todo.id } }" class="bg-darkGreen hoverGreen icon"><i class="fa-solid fa-pen-to-square"></i></router-link>
                    </div>
                </div>

            </div>
        </div>
    </div>
</template>

<script setup>

import router from "../router";
import { getRequest } from "../api";
import { useStore } from 'vuex';
const store = useStore();

if (!store.state.token) {
    router.push({ name: "Login" });
}

const todos = await getRequest("todos", store.state.token);

</script>
