<template>
    <div id="can_be_shipper" class="section py-4">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-4 col-md-12 col-sm-12 offset-lg-2 py-5 image">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12">
                                <img
                                    class="mt-auto mb-auto my-5"
                                    src="images/1.png"
                                >
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-sm-12 py-5 ml-4">
                    <div class="row">
                        <h2 class="section-title mb-4">How can I be a shipper?</h2>
                    </div>

                    <div class="row">
                        <div class="feature py-2 d-flex">
                            <i class="fa fa-check-square mr-5 checkbox-style"></i>
                            <div>
                                <h5>You are going to have a flight</h5>
                            </div>
                        </div>

                        <div class="py-2 d-flex">
                            <i class="fa fa-check-square mr-5 checkbox-style"></i>
                            <div>
                                <h5>You have free space in your suitcase</h5>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-lg-8">
                            <b-button class="btn btn-pill align-self-center" size="lg" variant="primary">
                                <i class="fa fa-hand-point-right mr-2"></i>Share it to friends and earn money
                            </b-button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "can-be-shipper",
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
    .image {
        display: inline-block;
    }

    .image img {
        width: 100%;
        object-fit: contain
    }

    .checkbox-style {
        font-size: 30px;
    }

    /*.info {*/
        /*padding: 10% 0;*/
    /*}*/

</style>
