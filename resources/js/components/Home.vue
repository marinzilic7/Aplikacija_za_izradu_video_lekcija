<template>
    <div class="container">
        <div class="row">
            <div class="accordion accordion-flush" id="accordionFlushExample">
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button
                            class="accordion-button collapsed bg-primary text-light"
                            type="button"
                            data-bs-toggle="collapse"
                            data-bs-target="#flush-collapseOne"
                            aria-expanded="false"
                            aria-controls="flush-collapseOne"
                        >
                            Dodaj kolegij
                        </button>
                    </h2>
                    <div
                        id="flush-collapseOne"
                        class="accordion-collapse collapse"
                        data-bs-parent="#accordionFlushExample"
                    >
                        <div
                            class="accordion-body d-flex flex-column align-items-center"
                        >
                            <form
                                class="border p-5 shadow-lg col-lg-6"
                                @submit.prevent="dodajKolegij"
                                method="POST"
                            >
                                <input type="hidden" v-model="this.POST" />
                                <input
                                    type="hidden"
                                    name=""
                                    v-model="this.csrfToken"
                                />
                                <div class="mb-3">
                                    <label
                                        for="exampleInputEmail1"
                                        class="form-label"
                                        >Naziv kolegija</label
                                    >
                                    <input
                                        type="text"
                                        class="form-control"
                                        id="exampleInputEmail1"
                                        aria-describedby="emailHelp"
                                        required
                                        v-model="course.naziv"
                                    />
                                </div>
                                <div class="mb-3">
                                    <label
                                        for="exampleInputPassword1"
                                        class="form-label"
                                        >Opis kolegija</label
                                    >
                                    <div class="form-floating">
                                        <textarea
                                            class="form-control"
                                            placeholder="Leave a comment here"
                                            id="floatingTextarea2"
                                            style="height: 100px"
                                            v-model="course.opis"
                                        ></textarea>
                                    </div>
                                </div>
                                <button
                                    type="submit"
                                    class="btn btn-primary w-100"
                                >
                                    Dodaj kolegij
                                </button>
                                <p
                                    v-if="successKolegij"
                                    class="alert alert-success mt-3"
                                >
                                    Kolegij dodan!
                                </p>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button
                            class="accordion-button collapsed bg-primary text-light"
                            type="button"
                            data-bs-toggle="collapse"
                            data-bs-target="#flush-collapseTwo"
                            aria-expanded="false"
                            aria-controls="flush-collapseTwo"
                        >
                            Dodaj video lekciju
                        </button>
                    </h2>
                    <div
                        id="flush-collapseTwo"
                        class="accordion-collapse collapse"
                        data-bs-parent="#accordionFlushExample"
                    >
                        <div
                            class="accordion-body d-flex flex-column align-items-center"
                        >
                            <form
                                class="border p-5 shadow-lg col-lg-9"
                                @submit.prevent="dodajVideo"
                                method="POST"
                            >
                                <input type="hidden" v-model="this.POST" />
                                <input
                                    type="hidden"
                                    name=""
                                    v-model="this.csrfToken"
                                />
                                <div class="mb-3">
                                    <label
                                        for="exampleInputEmail1"
                                        class="form-label"
                                        >Naslov video lekcije</label
                                    >
                                    <input
                                        type="text"
                                        class="form-control"
                                        id="exampleInputEmail1"
                                        aria-describedby="emailHelp"
                                        v-model="lesson.naslov"
                                    />
                                    <div class="mb-3">
                                        <label
                                            for="exampleInputPassword1"
                                            class="form-label"
                                            >Opis video lekcije</label
                                        >
                                        <div class="form-floating">
                                            <textarea
                                                class="form-control"
                                                placeholder="Leave a comment here"
                                                id="floatingTextarea2"
                                                style="height: 100px"
                                                v-model="lesson.opis"
                                            ></textarea>
                                        </div>
                                        <div class="mt-3">
                                            <label
                                                for="formFile"
                                                class="form-label"
                                                >Dodaj video lekciju</label
                                            >
                                            <input
                                                class="form-control"
                                                type="file"
                                                id="formFile"
                                                @change="videoChange"
                                            />
                                        </div>
                                        <div class="input-group mt-3">
                                            <select
                                                class="form-select"
                                                id="inputGroupSelect02"
                                                v-model="lesson.course_id"
                                            >
                                                <option selected>
                                                    Odaberi kolegij
                                                </option>
                                                <option

                                                    v-for="kolegij in kolegiji"
                                                    :value="kolegij.id"
                                                    :key="kolegij.id"
                                                >
                                                    {{ kolegij.naziv }}
                                                </option>
                                            </select>
                                            <label
                                                class="input-group-text"
                                                for="inputGroupSelect02"
                                                >Kolegij</label
                                            >
                                        </div>
                                    </div>
                                </div>

                                <button
                                    type="submit"
                                    class="btn btn-primary w-100"
                                >
                                    Submit
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";
export default {
    data() {
        return {
            course: {
                naziv: "",
                opis: "",
            },
            kolegiji: [],
            POST: "",
            csrfToken: "",
            successKolegij: false,

            lesson: {
                naslov: "",
                opis: "",
                video: "",
                course_id: "",
            },
        };
    },
    created() {
        this.getKolegij2();
    },
    mounted() {
        this.fetchCsrfToken();
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

        dodajKolegij() {
            const Kolegij = {
                naziv: this.course.naziv,
                opis: this.course.opis,
            };
            axios.defaults.headers.common["X-CSRF-TOKEN"] = this.csrfToken;
            axios
                .post("/dodajKolegij", Kolegij)
                .then((response) => {
                    this.poruka = response.data.poruka;
                    this.successKolegij = true;
                    this.kolegiji.push(this.course);
                    this.getKolegij2();
                })
                .catch((error) => {
                    if (error.response && error.response.status === 422) {
                        this.errors = error.response.data.errors;
                        this.failedReg = true;
                    } else {
                        console.log(error);
                    }
                });
        },
        getKolegij2() {
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

        videoChange(event) {
            this.lesson.video = event.target.files[0];
        },

        dodajVideo() {

            let lesson = new FormData();
            lesson.append("naslov",this.lesson.naslov);
            lesson.append("opis",this.lesson.opis);
            lesson.append("video",this.lesson.video);
            lesson.append("course_id",this.lesson.course_id);
           /*  const Video = {
                naziv: this.lesson.naziv,
                opis: this.lesson.opis,
                video: this.lesson.video,
                course_id: this.lesson.course_id,
            }; */
            axios.defaults.headers.common["X-CSRF-TOKEN"] = this.csrfToken;

            axios
                .post("/dodajVideo", lesson)
                .then((response) => {
                    this.poruka = response.data.poruka;
                })
                .catch((error) => {
                    console.log(error);
                });
        },
    },
};
</script>

<style lang="scss" scoped></style>
