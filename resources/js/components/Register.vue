<template>
    <div class="container">
        <div class="row d-flex flex-column align-items-center mt-5">
            <form
                class="was-validated col-12 col-md-6 col-sm-12 border p-5 shadow-lg"
            >
                <div class="mb-3 mt-3">
                    <label for="uname" class="form-label">Ime:</label>
                    <input
                        type="text"
                        class="form-control"
                        id="uname"
                        placeholder="Unesite vase ime"
                        name="uname"
                        required
                        v-model="form.ime"
                        @input="checkName"

                    />
                    <div v-if="checkIme" class="invalid-feedback">
                        Ime mora biti duze od dva slova.
                    </div>
                    <div v-else class="valid-feedback">
                        Unijeli ste vise od 2 znaka.
                    </div>
                    <div class="invalid-feedback">Obavezno.</div>
                </div>
                <div class="mb-3 mt-3">
                    <label for="uname" class="form-label">Prezime:</label>
                    <input
                        type="text"
                        class="form-control"
                        id="uname"
                        placeholder="Unesite vase prezime"
                        name="uname"
                        required
                        v-model="form.prezime"
                    />
                    <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback">Obavezno.</div>
                </div>
                <div class="mb-3 mt-3">
                    <label for="uname" class="form-label">Email:</label>
                    <input
                        type="email"
                        class="form-control"
                        id="uname"
                        placeholder="Unesite vas email"
                        name="uname"
                        required
                        v-model="form.email"
                    />
                    <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback">Obavezno.</div>
                </div>
                <div class="mb-3">
                    <label for="pwd" class="form-label">Lozinka:</label>
                    <input
                        type="password"
                        class="form-control"
                        id="pwd"
                        placeholder="Unesite vasu lozinku"
                        name="pswd"
                        required
                        v-model="form.password"
                        @input="passwordLenght"

                    />
                    <div v-if="!pwDuzina" class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback">Obavezno.</div>
                    <div v-if="pwDuzina" class="invalid-feedback">
                        Vaza lozinka mora imati minimalno 5 slova
                    </div>
                </div>
                <div class="mb-3 mt-3">
                    <label for="uname" class="form-label"
                        >Ponovite lozinku:</label
                    >
                    <input
                        type="password"
                        class="form-control"
                        id="uname"
                        placeholder="Ponovite vasu lozinku"
                        name="uname"
                        required
                        v-model="form.confPassword"
                    />
                    <div class="valid-feedback">Valid.</div>

                    <div class="invalid-feedback">Obavezno.</div>
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
            pwDuzina: false,
            checkIme: false,
        };
    },
    methods: {
        passwordLenght() {
            if (this.form.password.length < 5) {
                this.pwDuzina = true;
            } else {
                this.pwDuzina = false;
            }
        },

        checkName() {
            if (this.form.ime.length < 3) {
                this.checkIme = true;
            } else {
                this.checkIme = false;
            }
        },

    },
};
</script>

<style lang="scss" scoped></style>
