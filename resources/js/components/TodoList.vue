<template>
<div class="list" v-if="todos && todos.length > 0">
    <div class="item column3 between" :class="{ 'bg-softGreen': todo.isCompleted }" v-for="todo in todos" :key="todo.id">
        <div class="links">
            <a @click="$emit('completeTodo', todo.id)" class="hoverGreen1 icon" :class="{ 'bg-darkGreen1': !todo.isCompleted, 'bg-green1': todo.isCompleted }"><i class="fa-regular fa-circle-check"></i></a>
            <router-link :to="{ name: 'TodoDetail', params: { todoId: todo.id } }" :class="{ lineThrough: todo.isCompleted }">{{ todo.content }}</router-link>
        </div>
        <div class="links">
            <router-link :to="{ name: 'TodoDetail', params: { todoId: todo.id } }" class="bg-darkPink hoverPink icon"><i class="fa-solid fa-up-right-from-square"></i></router-link>
            <a @click="$emit('deleteTodo', todo.id)" class="bg-darkRed hoverRed icon"><i class="fa-solid fa-trash"></i></a>
            <router-link :to="{ name: 'TodoEdit', params: { todoId: todo.id } }" class="bg-darkGreen hoverGreen icon"><i class="fa-solid fa-pen-to-square"></i></router-link>
        </div>
    </div>
</div>
</template>

<script setup>
const props = defineProps(["data"]);
const todos = props.data.data.data;
</script>
