<template>
    <div class="container">
        <div class="row d-flex flex-column align-items-center mt-5">
            <form
                class="col-12 col-md-9 col-lg-6 col-sm-12 border p-5 shadow-lg"
                @submit.prevent="registerUser"
                method="POST"
            >
                <input type="hidden" v-model="this.POST" />
                <input type="hidden" name="" v-model="this.csrfToken" />
                <div class="mb-3 mt-3">
                    <label for="uname" class="form-label">Ime:</label>
                    <input
                        @input="checkName"
                        type="text"
                        :class="
                            !checkNameBool
                                ? 'form-control is-valid'
                                : 'form-control is-invalid'
                        "
                        id="uname"
                        placeholder="Unesite vase ime"
                        name="uname"
                        required
                        v-model="form.ime"
                    />
                    <div class="invalid-feedback">
                        <span v-if="!form.ime">Ovo polje je obavezno.</span>
                    </div>
                    <div class="invalid-feedback">
                        Ime mora biti duza od 2 slova.
                    </div>
                </div>
                <div class="mb-3 mt-4">
                    <label for="ulastname" class="form-label x">Prezime:</label>
                    <input
                        type="text"
                        :class="
                            form.prezime
                                ? 'form-control is-valid'
                                : 'form-control is-invalid'
                        "
                        id="ulastname"
                        placeholder="Unesite vase prezime"
                        name="lastName"
                        required
                        v-model="form.prezime"
                    />
                    <div class="invalid-feedback">
                        <span v-if="!form.prezime">Ovo polje je obavezno.</span>
                    </div>
                </div>
                <div class="mb-3 mt-3">
                    <label for="uname" class="form-label">Email:</label>
                    <input
                        type="email"
                        :class="
                            form.email
                                ? 'form-control is-valid'
                                : 'form-control is-invalid'
                        "
                        id="uname"
                        placeholder="Unesite vas email"
                        name="uname"
                        required
                        v-model="form.email"
                    />

                    <div class="invalid-feedback">Ovo polje je obavezno.</div>
                </div>
                <div class="mb-3">
                    <label for="pwd" class="form-label">Lozinka:</label>
                    <input
                        type="password"
                        :class="
                            !checkPassword
                                ? 'form-control is-valid'
                                : 'form-control is-invalid'
                        "
                        id="pwd"
                        placeholder="Unesite vasu lozinku"
                        name="pswd"
                        required
                        v-model="form.password"
                        @input="checkPasswordInput"
                    />

                    <div class="invalid-feedback">
                        <span v-if="!form.password"
                            >Ovo polje je obavezno.</span
                        >
                    </div>
                    <div class="invalid-feedback">
                        Lozinka mora imati vise od 5 znakova.
                    </div>
                </div>
                <div class="mb-3 mt-3">
                    <label for="uname" class="form-label"
                        >Ponovite lozinku:</label
                    >
                    <input
                        type="password"
                        :class="getInputClasses()"
                        id="uname"
                        placeholder="Ponovite vasu lozinku"
                        name="uname"
                        required
                        v-model="form.confPassword"
                        @input="checkPasswordConf"
                    />

                    <div v-if="!form.confPassword" class="invalid-feedback">
                        Ovo polje je obavezno.
                    </div>
                    <div v-else class="invalid-feedback">
                        Lozinke se moraju podudarati.
                    </div>
                </div>

                <button type="submit" class="btn btn-primary w-100">
                    Registriraj
                </button>
                <div v-if="successReg" class="alert alert-success mt-4">
                    Uspjesna registracija!
                    <span
                        ><a href="/login" class="text-decoration-none"
                            >Prijavite se</a
                        ></span
                    >
                </div>
                <p v-if="failedReg" class="alert alert-warning mt-3">
                    Postoji korisnik s tim mailom
                </p>
            </form>
        </div>
    </div>
</template>

<script>
import axios from "axios";
export default {
    data() {
        return {
            form: {
                ime: "",
                prezime: "",
                email: "",
                password: "",
                confPassword: "",
            },
            POST: "",
            csrfToken: "",
            checkNameBool: false,
            checkPassword: false,
            checkPasswordConfiguration: false,
            repeatPw: false,
            successReg: false,
            failedReg: false,
            existMail: "",
        };
    },
    mounted() {
        this.fetchCsrfToken();
        this.checkName();
        this.checkPasswordInput();
        this.checkPasswordConf();
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
        checkName() {
            if (this.form.ime.length < 3) {
                this.checkNameBool = true;
            } else {
                this.checkNameBool = false;
            }
        },

        checkPasswordInput() {
            if (this.form.password.length < 5) {
                this.checkPassword = true;
            } else {
                this.checkPassword = false;
            }
        },

        checkPasswordConf() {
            this.checkPasswordConfiguration =
                this.form.password === this.form.confPassword;
        },
        getInputClasses() {
            return this.form.confPassword && this.checkPasswordConfiguration
                ? "form-control"
                : "form-control is-invalid";
        },

        registerUser() {
            if (
                !this.checkNameBool &&
                !this.checkPassword &&
                this.checkPasswordConfiguration &&
                !this.repeatPw
            ) {
                const Data = {
                    ime: this.form.ime,
                    prezime: this.form.prezime,
                    email: this.form.email,
                    password: this.form.password,
                    confPassword: this.form.confPassword,
                };
                axios.defaults.headers.common["X-CSRF-TOKEN"] = this.csrfToken;
                axios
                    .post("/registerUser", Data)
                    .then((response) => {

                        this.poruka = response.data.poruka;
                        this.successReg = true;
                    })
                    .catch((error) => {
                        if (error.response && error.response.status === 422) {
                            this.errors = error.response.data.errors;

                            this.failedReg = true;
                        } else {
                            console.log(error);
                        }
                    });
            }
        },
    },
};
</script>

<style lang="scss" scoped></style>
