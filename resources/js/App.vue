<script setup>
import { RouterLink, RouterView } from "vue-router";
</script>

<template>
    <!-- Navigation bar -->

    <nav class="navbar navbar-expand-lg bg-body-tertiary shadow-lg">
        <div class="container-fluid">
            <a class="navbar-brand text-decoration-none" href="#">VideoLesson</a>
            <button
                class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent"
                aria-expanded="false"
                aria-label="Toggle navigation"
            >
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <li><RouterLink class="text-decoration-none text-dark" to="/">Home</RouterLink></li>
                    </li>
                </ul>
                <ul class="navbar-nav ">
                    <li class="nav-item">
                        <RouterLink class="pe-3 text-decoration-none text-dark" to="/login">Prijava</RouterLink>
                    </li>
                    <li class="nav-item">
                        <RouterLink class="text-decoration-none text-dark" to="/register">Registracija</RouterLink>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <ul>


    </ul>

    <RouterView />
</template>

<script>
export default {
    name: "App",
    data() {
        return {
            appTitle: "VideoLessonApp",
            sidebar: false,
            menuItems: [
                { title: "Home", path: "/home", icon: "home" },
                { title: "Register", path: "/register", icon: "face" },
                { title: "Login", path: "/login", icon: "lock_open" },
            ],
        };
    },
};
</script>

<style scoped></style>
