<template>
    <div class="list" v-if="todos && todos.length > 0">
        <div class="item column3 between" :class="{ 'bg-softGreen': todo.isCompleted }" v-for="todo in todos"
            :key="todo.id">
            <div class="links">
                <a @click="$emit('completeTodo', todo.id)" class="hoverGreen1 icon"
                    :class="{ 'bg-darkGreen1': !todo.isCompleted, 'bg-green1': todo.isCompleted }"><i
                        class="fa-regular fa-circle-check"></i></a>
                <router-link :to="{ name: 'TodoDetail', params: { todoId: todo.id } }"
                    :class="{ lineThrough: todo.isCompleted }">{{ todo.content }}</router-link>
            </div>
            <div class="links">
                <router-link :to="{ name: 'TodoDetail', params: { todoId: todo.id } }"
                    class="bg-darkPink hoverPink icon"><i class="fa-solid fa-up-right-from-square"></i></router-link>
                <a @click="$emit('deleteTodo', todo.id)" class="bg-darkRed hoverRed icon"><i
                        class="fa-solid fa-trash"></i></a>
                <router-link :to="{ name: 'TodoEdit', params: { todoId: todo.id } }"
                    class="bg-darkGreen hoverGreen icon"><i class="fa-solid fa-pen-to-square"></i></router-link>
            </div>
        </div>
        <div class="paginateContainer mt12">
            <div class="paginate">
                <a v-if="paginate.previousPage" @click="$emit('changePage', paginate.previousPage)" class="icon"><i
                        class="fa-solid fa-arrow-left"></i></a>
                <a v-if="paginate.previousPreviousPage" @click="$emit('changePage', paginate.previousPreviousPage)">{{
                        paginate.previousPreviousPage
                }}</a>
                <a v-if="paginate.previousPage" @click="$emit('changePage', paginate.previousPage)">{{
                        paginate.previousPage
                }}</a>
                <a class="current">{{ paginate.nowPage }}</a>
                <a v-if="paginate.nextPage" @click="$emit('changePage', paginate.nextPage)">{{ paginate.nextPage }}</a>
                <a v-if="paginate.nextNextPage" @click="$emit('changePage', paginate.nextNextPage)">{{
                        paginate.nextNextPage
                }}</a>
                <a v-if="paginate.nextPage" @click="$emit('changePage', paginate.nextPage)" class="icon"><i
                        class="fa-solid fa-arrow-right"></i></a>
            </div>
        </div>
    </div>
</template>

<script setup>
const props = defineProps(["data"]);

const todos = props.data.data.data;

const paginate = props.data.data.paginate;
</script>
