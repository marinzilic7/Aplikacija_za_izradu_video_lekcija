<template>
    <div class="container">
        <div class="row d-flex flex-column align-items-center mt-5">
            <form
                class="col-12 col-md-9 col-lg-6 col-sm-12 border p-5 shadow-lg"
            >
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
                    <div class="invalid-feedback ">
                        <span v-if="!form.ime">Ovo polje je obavezno.</span>
                    </div>
                    <div class="invalid-feedback ">
                        Ime mora biti duza od 2 slova.
                    </div>
                </div>
                <div class="mb-3 mt-4">
                    <label for="ulastname" class="form-label x"
                        >Prezime:</label
                    >
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
                    <div class="invalid-feedback ">
                        <span v-if="!form.prezime">Ovo polje je obavezno.</span>
                    </div>
                </div>
                <div class="mb-3 mt-3">
                    <label for="uname" class="form-label ">Email:</label>
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
            </form>
        </div>
    </div>
</template>

<script>
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
            checkNameBool: false,
            checkPassword: false,
            checkPasswordConfiguration: false,
            repeatPw: false,
        };
    },
    mounted() {
        this.checkName();
        this.checkPasswordInput();
        this.checkPasswordConf();
    },
    methods: {
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
    },
};
</script>

<style lang="scss" scoped></style>
