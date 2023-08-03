<template>
    <div class="container">
        <div class="row d-flex flex-column align-items-center mt-5">
            <form
                class="col-12 col-md-9 col-lg-6 col-sm-12 border p-5 shadow-lg"
                @submit.prevent="loginUser"
                method="POST"
            >
                <input type="hidden" v-model="this.POST" />
                <input type="hidden" name="" v-model="this.csrfToken" />
                <div class="mb-3 mt-3">
                    <label for="uname" class="form-label">Email:</label>
                    <input
                        type="email"
                        class="form-control"
                        id="uname"
                        placeholder="Unesite vas email"
                        name="uname"
                        v-model="form.email"
                    />
                    <p v-if="errors.email" class="text-danger">
                        {{ errors.email[0] }}
                    </p>
                </div>
                <div class="mb-3">
                    <label for="pwd" class="form-label">Lozinka:</label>
                    <input
                        type="password"
                        class="form-control"
                        id="pwd"
                        placeholder="Unesite vasu lozinku"
                        name="pswd"
                        v-model="form.password"
                    />
                    <p v-if="errors.password" class="text-danger">
                        {{ errors.password[0] }}
                    </p>
                </div>

                <button type="submit" class="btn btn-primary w-100">
                    Prijava
                </button>
                <div v-if="failedReg" class="alert alert-danger mt-3">Pogresan email ili lozinka</div>
            </form>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            form: {
                email: "",
                password: "",
            },
            errors: {},
            POST: "",
            csrfToken: "",
            failedReg:false,
        };
    },
    methods: {
        fetchCsrfToken() {
            axios
                .get("/sanctum/csrf-cookie")
                .then((response) => {
                    this.csrfToken = response.data.csrf_token;
                })
                .catch((error) => {
                    console.error(error);
                });
        },
        loginUser() {
            const Data = {
                email: this.form.email,
                password: this.form.password,
            };
            axios.defaults.headers.common["X-CSRF-TOKEN"] = this.csrfToken;
            axios
                .post("/loginUser", Data)
                .then((response) => {
                    this.logMessage = response.data.poruka;

                    this.successRegg = true;
                    if (this.logMessage == "Uspješna prijava") {
                        this.$store.dispatch(
                            "setLoginMessage",
                            this.logMessage
                        );
                        this.$store.commit(
                            "setLoggedInUser",
                            response.data.user
                        );
                        this.successRegg = true;
                        this.falseReg = false;
                        this.$router.push("/");
                    } else {
                        this.failedReg = true;
                        this.successRegg = false;
                    }
                })
                .catch((error) => {
                    console.log("Error:", error);
                    if (error.response && error.response.status === 422) {
                        this.errors = error.response.data.errors;
                    } else {
                        console.log(error);
                    }
                });
        },
    },
};
</script>

<style lang="scss" scoped></style>
