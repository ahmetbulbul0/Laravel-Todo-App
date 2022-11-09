<template>
    <div class="container">
        <div class="sm-box">
            <div class="title size120">
                <span>Register</span>
            </div>
            <div class="subText mt6">
                <span
                    >if you have an account,
                    <router-link :to="{ name: 'Login' }"
                        >Login Here</router-link
                    ></span
                >
            </div>
            <form class="form mt12" @submit="register">
                <div class="line">
                    <label>Full Name:</label>
                    <input
                        type="text"
                        class="mt6"
                        v-model="fullName"
                        required
                    />
                </div>
                <div class="line" v-if="store.state.fullNameError">
                    <label>{{ store.state.fullNameError }}</label>
                </div>
                <div class="line">
                    <label>Username:</label>
                    <input
                        type="text"
                        class="mt6"
                        v-model="username"
                        required
                    />
                </div>
                <div class="line" v-if="store.state.usernameError">
                    <label>{{ store.state.usernameError }}</label>
                </div>
                <div class="line">
                    <label>Password:</label>
                    <input
                        type="password"
                        class="mt6"
                        v-model="password"
                        required
                    />
                </div>
                <div class="line" v-if="store.state.passwordError">
                    <label>{{ store.state.passwordError }}</label>
                </div>
                <div class="line">
                    <label>E-Mail:</label>
                    <input type="email" class="mt6" v-model="email" required />
                </div>
                <div class="line" v-if="store.state.emailError">
                    <label>{{ store.state.emailError }}</label>
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
import router from "../router";
import { useStore } from "vuex";
const store = useStore();

const fullName = ref("");
const username = ref("");
const password = ref("");
const email = ref("");

const fullNameError = ref("");
const usernameError = ref("");
const passwordError = ref("");
const emailError = ref("");

async function register(ev) {
    ev.preventDefault();
    const data = {
        fullName: fullName.value,
        username: username.value,
        password: password.value,
        email: email.value,
        type: "user",
    };
    store.dispatch("register", data);
    setTimeout(() => goDashbord(), 500);}
function goDashbord() {
    if (store.state.userType == "user") {
        router.push({ name: "MyTodos" });
    } else if (store.state.userType == "admin") {
        router.push({ name: "AllTodos" });
    }
}
</script>
