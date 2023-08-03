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
                        <div class="accordion-body d-flex flex-column align-items-center">
                            <form class=" border p-5 shadow-lg col-lg-6 ">
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
                                    />

                                </div>
                                <div class="mb-3">
                                    <label
                                        for="exampleInputPassword1"
                                        class="form-label"
                                        >Opis kolegija</label
                                    >
                                    <input
                                        type="text"
                                        class="form-control"
                                        id="exampleInputPassword1"
                                        required
                                    />
                                </div>
                                <button type="submit" class="btn btn-primary w-100">
                                    Dodaj kolegij
                                </button>
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
                        <div class="accordion-body">
                            Placeholder content for this accordion, which is
                            intended to demonstrate the
                            <code>.accordion-flush</code> class. This is the
                            second item's accordion body. Let's imagine this
                            being filled with some actual content.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup></script>

<style lang="scss" scoped></style>
