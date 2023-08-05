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
                        data-bs-parent="#accordionFlushExamplee"
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
                                        required
                                    />
                                    <p v-if="errors.naslov" class="text-danger">
                                        {{ errors.naslov[0] }}
                                    </p>
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
                                                required
                                            ></textarea>
                                            <p
                                                v-if="errors.opis"
                                                class="text-danger"
                                            >
                                                {{ errors.opis[0] }}
                                            </p>
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
                                                required
                                                @change="videoChange"
                                            />
                                            <p
                                                v-if="errors.video"
                                                class="text-danger"
                                            >
                                                {{ errors.video[0] }}
                                            </p>
                                        </div>
                                        <div class="input-group mt-3">
                                            <select
                                                class="form-select"
                                                id="inputGroupSelect02"
                                                v-model="lesson.course_id"
                                                required
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
                                            <p
                                                v-if="errors.course_id"
                                                class="text-danger"
                                            >
                                                {{ errors.course_id[0] }}
                                            </p>
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
        <div
            class="d-flex flex-column align-items-center justify-content-center"
        >
            <div class="card mt-5 col-lg-8" v-for="lekcija in lekcije">
                <video class="card-img-top" controls>
                    <source :src="'/videos/' + lekcija.video" />
                    Your browser does not support the video tag.
                </video>
                <div class="card-body">
                    <h5 class="card-title">{{ lekcija.naslov }}</h5>
                    <p class="card-text">
                        {{ lekcija.opis }}
                    </p>
                    <p class="card-text">
                        <small class="text-muted"
                            >{{ lekcija.created_at }}</small
                        >
                    </p>
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
                video: null,
                course_id: "",
            },
            lekcije: [],
            errors: {},

        };
    },
    created() {
        this.getKolegij2();
        this.getLekcije();
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


            let lessonFormData = new FormData();
            lessonFormData.append("naslov", this.lesson.naslov);
            lessonFormData.append("opis", this.lesson.opis);
            lessonFormData.append("video", this.lesson.video);
            lessonFormData.append("course_id", this.lesson.course_id);


            axios.defaults.headers.common["X-CSRF-TOKEN"] = this.csrfToken;

            axios
                .post("/dodajVideo", lessonFormData)
                .then((response) => {
                    this.video = response.data.video;
                    $("#flush-collapseTwo").collapse("hide");
                    if(this.video){
                        alert('Video uspjesno dodan')
                    }
                    this.getLekcije();

                })
                .catch((error) => {
                    console.log(error);
                });
        },

        getLekcije() {
            axios
                .get("/getLekcije")
                .then((response) => {
                    this.lekcije = response.data.map((lekcija) => ({
                        ...lekcija,
                        created_at: new Date(
                            lekcija.created_at
                        ).toLocaleDateString("hr-HR", {
                            day: "numeric",
                            month: "long",
                            year: "numeric",
                        }),
                    }));
                })
                .catch((error) => {
                    console.log(error);
                });
        },
    },
};
</script>

<style lang="scss" scoped></style>
