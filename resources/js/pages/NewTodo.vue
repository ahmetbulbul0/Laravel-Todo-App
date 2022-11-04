<template>
    <div class="container">
        <div class="md-box">
            <div class="header">
                <div class="title size140">
                    <span>Todo Add</span>
                </div>
                <div class="links">
                    <router-link :to="{ name: 'MyTodos' }" class="bg-redPink link">My Todo's</router-link>
                    <router-link :to="{ name: 'LogOut' }" class="bg-redPink link">Log Out</router-link>
                </div>
            </div>
            <form class="form mt12">
                <div class="line">
                    <label>Content:</label>
                    <textarea class="mt6 h140"></textarea>
                </div>
                <div class="line">
                    <button class="fullBtn bg-green">Add Todo</button>
                </div>
            </form>
        </div>
    </div>
</template>

<script setup>

</script>
