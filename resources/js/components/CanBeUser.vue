<template>
    <div id="can_be_user" class="section py-4">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3 col-md-4 col-sm-12 info offset-lg-3 py-5">
                    <div class="row">
                        <div class="col-lg-12">
                            <h2 class="section-title mb-4">Why do I deliver with dido?</h2>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="feature py-2 d-flex">
                                <i class="fa fa-check-square mr-5 checkbox-style"></i>
                                <div>
                                    <h5>You save 40% fee compare to traditional shipping method</h5>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="py-2 d-flex">
                                <i class="fa fa-check-square mr-5 checkbox-style"></i>
                                <div>
                                    <h5>Your package reach home faster compare to other traditional shipping methods</h5>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="py-2 d-flex">
                                <i class="fa fa-check-square mr-5 checkbox-style"></i>
                                <div>
                                    <h5>Secure payment</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-lg-8">
                            <b-button class="btn btn-pill align-self-center" size="lg" variant="success">
                                <i class="fa fa-search mr-2"></i>Find friends
                            </b-button>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-4 col-sm-12 py-5 image">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12">
                                <img
                                    class="mt-auto mb-auto my-5"
                                    src="images/student_deliver.jpg"
                                >
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "can-be-user",
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
