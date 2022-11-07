<template>
    <div class="container" v-if="!store.state.token">
        <div class="sm-box">
            <div class="title size120">
                <span>Login</span>
            </div>
            <div class="subText mt6">
                <span>if you don't have an account, <router-link :to="{ name: 'Register' }">Register Here</router-link></span>
            </div>
            <form class="form mt12" @submit.prevent="store.dispatch('login', {email: email, password: password})">
                <div class="line">
                    <label>Email:</label>
                    <input type="text" class="mt6" v-model="email">
                </div>
                <div class="line">
                    <label>Password:</label>
                    <input type="password" class="mt6" v-model="password">
                </div>
                <div class="line" v-if="store.state.loginError">
                    <label>{{ store.state.loginError }}</label>
                </div>
                <div class="line">
                    <button class="fullBtn bg-redPink" type="submit">Login</button>
                </div>
            </form>
        </div>
    </div>
</template>

<script setup>
import { ref } from "@vue/reactivity";
import router from "../router";
import { useStore } from 'vuex';
const store = useStore();

if (store.state.token) {
    router.push({ name: "MyTodos" });
}

const email = ref('');
const password = ref('');
var signInError = ref('');




</script>
