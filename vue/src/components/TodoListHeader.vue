<template>
    <div class="header">
        <div class="title size140">
            <span>{{ title }}</span>
        </div>
        <div class="select">
            <select v-model="sortingValue" @change="$emit('sorting', sortingValue)">
                <option value="" disabled :selected="sortingValue.value == ''">Sorting</option>
                <option value="isCompleted09" :selected="sortingValue.value == 'isCompleted09'">First Incomplete Todo's</option>
                <option value="isCompleted90" :selected="sortingValue.value == 'isCompleted90'">First Completed Todo's</option>
                <option value="addedTime09" :selected="sortingValue.value == 'addedTime09'">First Newest</option>
                <option value="addedTime90" :selected="sortingValue.value == 'addedTime90'">First Oldest</option>
            </select>
        </div>
        <div class="links">
            <router-link :to="{ name: 'NewTodo' }" class="bg-redPink link">New Todo</router-link>
            <a class="bg-redPink link" @click="$emit('logOut')">Log Out</a>
        </div>
    </div>
    <div class="header">
        <div class="radios left">
            <label>
                <input type="radio" v-model="filter" value="">
                All
            </label>
            <label>
                <input type="radio" v-model="filter" value="yes">
                Completed Todo's
            </label>
            <label>
                <input type="radio" v-model="filter" value="no">
                Incomplete Todo's
            </label>
        </div>
        <div class="text">
            <input type="text" placeholder="Search in todos..." v-model="search" @keyup.enter="$emit('search', search)">
            <a class="searchBtn" @click="$emit('search', search)">
                <i class="fa-solid fa-magnifying-glass"></i>
            </a>
        </div>
    </div>
</template>

<script setup>
import { ref } from '@vue/reactivity';
import { watch } from '@vue/runtime-core';
import { useStore } from 'vuex';
const store = useStore();
var sortingValue = ref("");
const search = ref("");
if (store.state.myTodosSorting) {
    sortingValue.value = store.state.myTodosSorting
}
const props = defineProps(["title"]);
const title = props.title;
const emits = defineEmits(["filter"]);
const filter = ref("");
if (store.state.myTodosFilter) {
    filter.value = store.state.myTodosFilter;
}
watch(filter, (newFilter, oldFilter) => {
    emits("filter", filter.value);
})
</script>
