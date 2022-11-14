<template>
    <div class="container">
        <div class="md-box">
            <TodoListHeader @sorting="sorting" @filter="filter" @logOut="logOut" @search="search" :title="title" />
            <TodoList v-if="todos" :data="todos" @deleteTodo="deleteTodo" @completeTodo="completeTodo"
                @changePage="changePage" />
        </div>
    </div>
</template>

<script setup>
import router from "../router";
import {
    getRequest,
    deleteRequestUrlValue,
    patchRequestUrlValue,
    getRequestQuery,
} from "../api";
import axios from "axios";
import { ref } from "@vue/reactivity";
import { useStore } from "vuex";
import { defineAsyncComponent, onMounted, watch } from "@vue/runtime-core";
import { useRoute } from "vue-router";
const route = useRoute();
const TodoList = defineAsyncComponent((todos) =>
    import("../components/TodoList.vue")
);
const TodoListHeader = defineAsyncComponent((todos) =>
    import("../components/TodoListHeader.vue")
);
const store = useStore();
const title = "All   Todos";
store.commit("setPage", "");
var todos = ref("");
if (
    store.state.myTodosSorting &&
    store.state.myTodosFilter &&
    store.state.myTodosPage
) {
    todos.value = await getRequestQuery("todos", store.state.token, {
        sorting: store.state.myTodosSorting,
        isCompleted: store.state.myTodosFilter,
        page: store.state.myTodosPage,
    });
} else if (store.state.myTodosSorting && store.state.myTodosPage) {
    todos.value = await getRequestQuery("todos", store.state.token, {
        sorting: store.state.myTodosSorting,
        page: store.state.myTodosPage,
    });
} else if (store.state.myTodosFilter && store.state.myTodosPage) {
    todos.value = await getRequestQuery("todos", store.state.token, {
        isCompleted: store.state.myTodosFilter,
        page: store.state.myTodosPage,
    });
} else if (store.state.myTodosSorting && store.state.myTodosFilter) {
    todos.value = await getRequestQuery("todos", store.state.token, {
        sorting: store.state.myTodosSorting,
        isCompleted: store.state.myTodosFilter,
    });
} else if (store.state.myTodosSorting) {
    todos.value = await getRequestQuery("todos", store.state.token, {
        sorting: store.state.myTodosSorting,
    });
} else if (store.state.myTodosFilter) {
    todos.value = await getRequestQuery("todos", store.state.token, {
        isCompleted: store.state.myTodosFilter,
    });
} else if (store.state.myTodosPage) {
    todos.value = await getRequestQuery("todos", store.state.token, {
        page: store.state.myTodosPage,
    });
} else {
    todos.value = await getRequest("todos", store.state.token);
}
async function search(search) {
    todos.value = "";
    todos.value = await getRequestQuery("todos", store.state.token, {
        search: search,
    });
    store.commit("setMyTodosSorting", "");
    store.commit("setMyTodosFilter", "");
    store.commit("setPage", "");
}
async function filter(filterValue) {
    todos.value = null;
    if (store.state.myTodosSorting) {
        todos.value = await getRequestQuery("todos", store.state.token, {
            sorting: store.state.myTodosSorting,
            isCompleted: filterValue,
        });
    } else {
        todos.value = await getRequestQuery("todos", store.state.token, {
            isCompleted: filterValue,
        });
    }
    store.commit("setPage", 1);
    store.commit("setMyTodosFilter", filterValue);
}
async function sorting(sortingValue) {
    todos.value = null;
    if (store.state.myTodosFilter) {
        todos.value = await getRequestQuery("todos", store.state.token, {
            sorting: sortingValue,
            isCompleted: store.state.myTodosFilter,
        });
    } else {
        todos.value = await getRequestQuery("todos", store.state.token, {
            sorting: sortingValue,
        });
    }
    store.commit("setPage", 1);
    store.commit("setMyTodosSorting", sortingValue);
}
async function changePage(page) {
    todos.value = null;
    if (store.state.myTodosSorting && store.state.myTodosFilter) {
        todos.value = await getRequestQuery("todos", store.state.token, {
            sorting: store.state.myTodosSorting,
            isCompleted: store.state.myTodosFilter,
            page: page,
        });
    } else if (store.state.myTodosSorting) {
        todos.value = await getRequestQuery("todos", store.state.token, {
            sorting: store.state.myTodosSorting,
            page: page,
        });
    } else if (store.state.myTodosFilter) {
        todos.value = await getRequestQuery("todos", store.state.token, {
            isCompleted: store.state.myTodosFilter,
            page: page,
        });
    } else {
        todos.value = await getRequestQuery("todos", store.state.token, {
            page: page,
        });
    }
    store.commit("setPage", page);
    console.log(store.state.myTodosPage);
}
async function deleteTodo(todoId) {
    await deleteRequestUrlValue("todos", store.state.token, todoId);
    location.reload();
}
async function completeTodo(todoId) {
    await patchRequestUrlValue("todos", store.state.token, todoId, {
        isCompleted: true,
    });
    location.reload();
}
function logOut() {
    store.dispatch("logOut").then(() => {
        router.push({
            name: "Login",
        });
    });
}
</script>
