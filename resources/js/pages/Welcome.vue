<template>
    <div class="container">
        <div class="sm-box">
            <div class="title size120">
                <span>Welcome To Todo App</span>
            </div>
            <div class="list">
                <div class="item center">
                    <router-link class="fullBtn bg-redPink" :to="{ name: 'Login' }">Login</router-link>
                </div>
                <div class="item center">
                    <router-link class="fullBtn bg-redPink" :to="{ name: 'Register' }">Register</router-link>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
</script>
