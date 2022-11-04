<template>
    <div class="container">
        <div class="sm-box">
            <div class="title size120">
                <span>Register</span>
            </div>
            <div class="subText mt6">
                <span>if you have an account, <router-link :to="{ name: 'Login' }">Login Here</router-link></span>
            </div>
            <form class="form mt12" @submit.prevent="register">
                <div class="line">
                    <label>Full Name:</label>
                    <input type="text" class="mt6" v-model="fullName" required>
                </div>
                <div class="line" v-if="fullNameError">
                    <label>{{ fullNameError }}</label>
                </div>
                <div class="line">
                    <label>Username:</label>
                    <input type="text" class="mt6" v-model="username" required>
                </div>
                <div class="line" v-if="usernameError">
                    <label>{{ usernameError }}</label>
                </div>
                <div class="line">
                    <label>Password:</label>
                    <input type="password" class="mt6" v-model="password" required>
                </div>
                <div class="line" v-if="passwordError">
                    <label>{{ passwordError }}</label>
                </div>
                <div class="line">
                    <label>E-Mail:</label>
                    <input type="email" class="mt6" v-model="email" required>
                </div>
                <div class="line" v-if="emailError">
                    <label>{{ emailError }}</label>
                </div>
                <div class="line">
                    <button class="fullBtn bg-redPink">Register</button>
                </div>
            </form>
        </div>
    </div>
</template>

<script setup>
import { ref } from "@vue/reactivity";
import axios from "axios";
import router from "../router";

const fullName = ref('');
const username = ref('');
const password = ref('');
const email = ref('');

async function register () {
    fullNameError.value = '';
    usernameError.value = '';
    passwordError.value = '';
    emailError.value = '';

    const data = {
        fullName: fullName.value,
        username: username.value,
        password: password.value,
        email: email.value,
        type: "user"
    };
    const register = await axios.post("http://localhost:8000/api/users", data).catch(function (error) {
        if (error.response) {
            alertErrors(error.response.data.errors);
        }
    }).then(function (res) {
        loginUser(data.username, data.password);
    });
}

var fullNameError = ref('');
var usernameError = ref('');
var passwordError = ref('');
var emailError = ref('');
function alertErrors(errors) {
    if (errors.fullName) {
        fullNameError.value = errors.fullName[0];
    }
    if (errors.username) {
        usernameError.value = errors.username[0];
    }
    if (errors.password) {
        passwordError.value = errors.password[0];
    }
    if (errors.email) {
        emailError.value = errors.email[0];
    }
}

async function loginUser (username, password) {
    const login = await axios.post("http://localhost:8000/api/login", { username: username, password: password }).then(function (res) {
        if (res.data == 'ok') {
            goMyTodos();
        } else if (res.data == 'failed') {
            alert("Login Failed");
        } else {
            alert("Login Failed (Unknow)");
        }
    });
}

function goMyTodos() {
    router.push({ name: 'MyTodos' });
}

</script>
