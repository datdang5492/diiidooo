<template>
    <div class="filter-section justify-content-center flex-column mb-auto mt-auto container-fluid py-4 text-center">
        <div class="row mb-4">
            <div class="col-lg-10 col-md-10 col-sm-10 offset-sm-2 offset-lg-2 offset-md-2">
                <h3 class="text-white mt-auto text-left">Frequent delivery trips!</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-2 col-md-2 col-sm-12 offset-sm-2 offset-lg-2 offset-md-2">
                <b-link href="list/from/munich/to/hanoi">
                    <b-card title="Munich - Hanoi" img-alt="Image" img-top tag="article" style="max-width: 270px"
                            class="mb-2 card-link">
                        <b-card-text><i class="fa fa-dolly mr-2"></i>from <span class="font-weight-bold">€5</span> / kg</b-card-text>
                    </b-card>
                </b-link>
            </div>

            <div class="col-lg-2 col-md-3 col-sm-12">
                <b-link href="list/from/frankfurt/to/hanoi">
                    <b-card title="Frankfurt - Hanoi" img-alt="Image" img-top tag="article" style="max-width: 270px"
                            class="mb-2">
                        <b-card-text><i class="fa fa-dolly mr-2"></i>from <span class="font-weight-bold">€5</span> / kg</b-card-text>
                    </b-card>
                </b-link>
            </div>

            <div class="col-lg-2 col-md-3 col-sm-12">
                <b-link href="list/from/berlin/to/hanoi">
                    <b-card title="Berlin - Hanoi" img-alt="Image" img-top tag="article" style="max-width: 270px"
                            class="mb-2">
                        <b-card-text><i class="fa fa-dolly mr-2"></i>from <span class="font-weight-bold">€5</span> / kg</b-card-text>
                    </b-card>
                </b-link>
            </div>

            <div class="col-lg-2 col-md-3 col-sm-12">
                <b-link href="list/from/hamburg/to/hanoi">
                    <b-card title="Hamburg - Hanoi" img-alt="Image" img-top tag="article" style="max-width: 270px"
                            class="mb-2">
                        <b-card-text><i class="fa fa-dolly mr-2"></i>from <span class="font-weight-bold">€5</span> / kg</b-card-text>
                    </b-card>
                </b-link>
            </div>
        </div>

        <div class="row mt-5">
            <div class="col-lg-2 col-md-2 col-sm-12 offset-sm-2 offset-lg-2 offset-md-2">
                <b-link href="list/from/munich/to/tphcm">
                    <b-card title="Munich - Tp. HCM" img-alt="Image" img-top tag="article" style="max-width: 270px"
                            class="mb-2">
                        <b-card-text><i class="fa fa-dolly mr-2"></i>from <span class="font-weight-bold">€5</span> / kg</b-card-text>
                    </b-card>
                </b-link>
            </div>

            <div class="col-lg-2 col-md-3 col-sm-12">
                <b-link href="list/from/frankfurt/to/tphcm">
                    <b-card title="Frankfurt - Tp. HCM" img-alt="Image" img-top tag="article" style="max-width: 270px"
                            class="mb-2">
                        <b-card-text><i class="fa fa-dolly mr-2"></i>from <span class="font-weight-bold">€5</span> / kg</b-card-text>
                    </b-card>
                </b-link>
            </div>

            <div class="col-lg-2 col-md-3 col-sm-12">
                <b-link href="list/from/berlin/to/tphcm">
                    <b-card title="Berlin - Tp. HCM" img-alt="Image" img-top tag="article" style="max-width: 270px"
                            class="mb-2">
                        <b-card-text><i class="fa fa-dolly mr-2"></i>from <span class="font-weight-bold">€5</span> / kg</b-card-text>
                    </b-card>
                </b-link>
            </div>

            <div class="col-lg-2 col-md-3 col-sm-12">
                <b-link href="list/from/hamburg/to/tphcm">
                    <b-card title="Hamburg - Tp.HCM" img-alt="Image" img-top tag="article" style="max-width: 270px"
                            class="mb-2">
                        <b-card-text><i class="fa fa-dolly mr-2"></i>from <span class="font-weight-bold">€5</span> / kg</b-card-text>
                    </b-card>
                </b-link>
            </div>
        </div>

    </div>
</template>

<script>
    export default {
        name: "filter-section",
        components: {},
        data() {
            return {};
        },
        methods: {},
        created: function () {
        }
    };
</script>

<style scoped>
    .filter-section {
        background-color: #17a2b8;
    }

    a {
        color: #212529;
        text-decoration: none !important;
    }

    .card-body {
        padding: 0;
    }

    .card-title {
        font-weight: 400;
    }
</style>
