<template>
    <div class="container">
        <div class="row d-flex flex-column align-items-center mt-5">
            <form class="was-validated col-12 col-md-6 col-sm-12 border p-5 shadow-lg">
                <div class="mb-3 mt-3">
                    <label for="uname" class="form-label">Ime:</label>
                    <input
                        type="text"
                        class="form-control"
                        id="uname"
                        placeholder="Unesite vase ime"
                        name="uname"
                        required
                    />
                    <div class="valid-feedback">Valid.</div>
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
                    />
                    <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback">Obavezno.</div>
                </div>
                <div class="mb-3 mt-3">
                    <label for="uname" class="form-label">Ponovite lozinku:</label>
                    <input
                        type="password"
                        class="form-control"
                        id="uname"
                        placeholder="Ponovite vasu lozinku"
                        name="uname"
                        required
                    />
                    <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback">
                        Obavezno.
                    </div>
                </div>

                <button type="submit" class="btn btn-primary w-100">
                    Registriraj
                </button>
            </form>
        </div>
    </div>
</template>

<script setup></script>

<style lang="scss" scoped></style>
