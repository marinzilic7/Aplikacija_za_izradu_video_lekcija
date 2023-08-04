<template>
    <div v-if="imaKolegij">
        <h1 class="text-center mt-5">Trenutno nema kolegija.</h1>
    </div>
    <div v-else class="container">
        <div class="row">
            <table class="table shadow-lg mt-5">
                <thead>
                    <tr>
                        <th scope="col">ID KOLEGIJA</th>
                        <th scope="col">Naziv</th>
                        <th scope="col">Napravljen</th>
                        <th scope="col">Akcije</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="kolegij in kolegiji">
                        <th scope="row">{{ kolegij.id }}</th>
                        <td>{{ kolegij.naziv }}</td>
                        <td>{{ kolegij.created_at }}</td>
                        <td>
                            <button
                                @click="izbrisiKolegij(kolegij.id)"
                                class="btn btn-sm bg-danger text-light"
                            >
                                Izbrisi
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            kolegiji: [],
            brojKolegija: null,
            imaKolegij: false,
        };
    },
    created() {
        this.getKolegij();
        this.getNumberKolegij();
    },
    methods: {
         getKolegij() {
             axios
                .get("/getKolegij")
                .then((response) => {
                    this.kolegiji = response.data.map((kolegij) => ({
                        ...kolegij,
                        created_at: new Date(
                            kolegij.created_at
                        ).toLocaleDateString("hr-HR", {
                            day: "numeric",
                            month: "long",
                            year: "numeric",
                        }),
                    }));

                    console.log(this.brojKolegija);
                    console.log(response.data);
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        izbrisiKolegij(id) {
            axios.defaults.headers.common["X-CSRF-TOKEN"] = this.csrfToken;
            axios
                .post(`/deleteKolegij/${id} `)
                .then((response) => {
                    this.poruka = response.data.poruka;
                    this.izbirsano = true;
                    setTimeout(() => {
                        this.izbrisano = false;
                    }, 3000);
                    this.kolegiji = this.kolegiji.filter(
                        (kolegijaa) => kolegijaa.id !== id
                    );
                    this.getNumberKolegij();
                })
                .catch((error) => {
                    console.log(error);
                });
        },
         getNumberKolegij() {
             axios
                .get("/getNumberKolegij")
                .then((response) => {
                    this.brojKolegija = response.data;

                    if (this.brojKolegija > 0) {
                        this.imaKolegij = false;
                    } else {
                        this.imaKolegij = true;
                    }
                })
                .catch((error) => {
                    console.log(error);
                });
        },
    },
};
</script>

<style lang="scss" scoped></style>
