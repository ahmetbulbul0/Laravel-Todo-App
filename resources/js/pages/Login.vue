<template>
    <div class="container">
        <div class="sm-box">
            <div class="title size120">
                <span>Login</span>
            </div>
            <div class="subText mt6">
                <span>if you don't have an account, <router-link :to="{ name: 'Register' }">Register Here</router-link></span>
            </div>
            <form class="form mt12" @submit.prevent="login">
                <div class="line">
                    <label>Username:</label>
                    <input type="text" class="mt6" v-model="username">
                </div>
                <div class="line">
                    <label>Password:</label>
                    <input type="password" class="mt6" v-model="password">
                </div>
                <div class="line" v-if="signInError">
                    <label>{{ signInError }}</label>
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
import axios from "axios";
import router from "../router";

const username = ref('');
const password = ref('');

async function login () {
    signInError.value = '';

    const data = {
        username: username.value,
        password: password.value,
    };

    const login = await axios.post("http://localhost:8000/api/login", { username: data.username, password: data.password }).then(function (res) {
        if (res.data == 'ok') {
            router.push({ name: 'MyTodos' });
        } else {
            alertError({signInError : "Login Failed"});
        }
    });
}

var signInError = ref('');
function alertError(error) {
    if (error.fullName) {
        signInError.value = error.signInError[0];
    }
}

</script>
