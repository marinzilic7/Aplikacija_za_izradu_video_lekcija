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
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 ">
                    <li class="nav-item">
                        <li><RouterLink class="text-decoration-none text-dark" to="/">Home</RouterLink></li>
                    </li>

                    <li class="nav-item">
                        <li><RouterLink class="text-decoration-none text-dark mx-lg-3 " to="/kolegij">Kolegiji</RouterLink></li>
                    </li>
                </ul>
                <ul class="navbar-nav  d-flex justify-content-center align-items-center "  v-if="!isLoggedIn">
                    <li class="nav-item">
                        <RouterLink class="pe-3 text-decoration-none text-dark" to="/login">Prijava</RouterLink>
                    </li>
                    <li class="nav-item">
                        <RouterLink class="text-decoration-none text-dark" to="/register">Registracija</RouterLink>
                    </li>
                </ul>
                <ul v-else class="navbar-nav ">
                    <li>
                            <div class="btn-group dropstart">
                                <button
                                    class="btn btn-light dropdown-toggle text-dark nav-link"
                                    type="button"
                                    data-bs-toggle="dropdown"
                                    aria-expanded="false"
                                >
                                    {{ loggedInUser.ime }}
                                </button>
                                <ul class="dropdown-menu">
                                    <li>
                                        <button
                                            @click="logOut"
                                            class="dropdown-item p-0 text-center"
                                            type="button"
                                        >
                                            Logout
                                        </button>
                                    </li>
                                </ul>
                            </div>
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
import { mapGetters } from "vuex";
export default {

    data() {
        return {
            isLoggedIn: false,


        };
    },
    computed: {
        ...mapGetters(["loggedInUser"]),
        isLoggedIn() {
            return this.loggedInUser !== null;
        },
    },
    created() {
        this.checkLoginStatus();
    },
    methods: {
        checkLoginStatus() {
            axios
                .get("/isLogged")
                .then((response) => {
                    this.loggedInUser = response.data;

                    this.isLoggedIn = true;
                    console.log(this.isLoggedIn);
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        logOut() {
            axios
                .post("/logoutUser")
                .then((response) => {
                    this.isLoggedIn = false;
                    this.loggedInUser = null;
                    this.$store.dispatch("logout");
                    this.$router.push("/login");
                })
                .catch((error) => {
                    console.log(error);
                });
        },

    },
};
</script>

<style scoped></style>
