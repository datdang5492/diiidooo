<template>
    <div class="inner-wrapper mt-auto container-fluid mb-5">
        <div class="row">
            <div class="col-lg-6 ">
                <div class="row">
                    <div class="col-lg-9 col-md-10 col-sm-12 offset-lg-1 text-center">
                        <h4 class="welcome-heading display-4 mt-auto">Send your packages back home through friends</h4>
                        <p class="font-weight-bold">SAVE. FAST. SECURED</p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-9 col-md-10 col-sm-12 offset-lg-1">
                        <b-form>
                            <div class="mb-auto mt-4 row">
                                <div class="col-lg-8 offset-lg-2">
                                    <b-input-group>
                                        <b-form-input type="text" placeholder="From"></b-form-input>
                                    </b-input-group>
                                </div>
                            </div>

                            <div class="mb-auto mt-4 row">
                                <div class="col-lg-8 offset-lg-2">
                                    <b-input-group>
                                        <b-form-input type="text" placeholder="To"></b-form-input>
                                    </b-input-group>
                                </div>
                            </div>

                            <div class="mb-auto mt-4 row">
                                <div class="col-lg-8 offset-lg-2">
                                    <date-picker v-model="date" :config="dateOptions"></date-picker>
                                </div>
                            </div>

                            <div class="mb-auto mt-4 row">
                                <div class="col-lg-8 offset-lg-2 text-center">
                                    <b-button class="btn btn-pill align-self-center" size="lg" variant="outline-success"
                                              block>
                                        <i class="fa fa-search mr-2"></i>Find friends
                                    </b-button>
                                </div>
                            </div>
                        </b-form>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div v-if="this.$authStatus === '1'">
                    <div class="row">
                        <div class="col-lg-10 col-md-10 col-sm-12 offset-lg-1 text-center">
                            <h4 class="welcome-heading display-4 mt-auto">Have a free space on your next flight? </h4>
                            <h4 class="welcome-heading display-4 mt-auto">Let share it with friends</h4>
                            <p class="">EARNING POTENTIAL PER FLIGHT <span class="font-weight-bold">$110</span></p>
                        </div>
                    </div>

                    <div class="row mt-auto">
                        <div class="col-lg-10 col-md-10 col-sm-12 offset-lg-1 text-center">
                            <b-link href="/become-a-shipper/stepone">
                                <b-button class="btn btn-pill align-self-center" size="lg" variant="outline-primary">
                                    <i class="fa fa-hand-point-right mr-2"></i>Add shipment
                                </b-button>
                            </b-link>
                        </div>
                    </div>
                </div>

                <div v-if="this.$authStatus !== '1'">
                    <div class="row">
                        <div class="col-lg-8 col-md-10 col-sm-12 offset-lg-2 text-center">
                            <h4 class="welcome-heading display-4 mt-auto">Help friend send their package back home</h4>
                            <p class="">EARNING POTENTIAL PER FLIGHT <span class="font-weight-bold">$110</span></p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-8 col-md-10 col-sm-12 offset-lg-2 text-center">
                            <b-button class="btn btn-pill align-self-center" v-b-modal.signupModal
                                      size="lg" variant="outline-primary">
                                <i class="fa fa-hand-point-right mr-2"></i>Join our community
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
        name: "search-section",
        components: {},
        data() {
            return {
                date: new Date(),
                dateOptions: {
                    format: 'DD/MM/YYYY',
                    useCurrent: false,
                }
            };
        },
        methods: {},
        created: function () {
        }
    };
</script>

<style scoped>

</style>
