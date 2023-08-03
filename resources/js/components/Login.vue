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
                    />
                </div>

                <button type="submit" class="btn btn-primary w-100">
                    Prijava
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
            POST: "",
            csrfToken: "",
        };
    },
};
</script>

<style lang="scss" scoped></style>
