<template>
    <div class="inner-wrapper mt-auto mb-auto container-fluid">
        <div class="row">
            <div class="col-lg-3 col-md-4 col-sm-12 mt-auto mb-auto ml-5">
                <h3 class="welcome-heading display-4 text-white">Send your stuff back home through friends</h3>
                <p class="text-muted">
                    SAVE. FAST. SECURED
                </p>
            </div>

            <div class="col-lg-8 col-md-7 col-sm-12">
                <b-form @submit="onSubmit" @reset="onReset">
                    <div class="mb-auto mt-5 row">
                        <div class="col-lg-3">
                            <b-input-group>
                                <b-form-input size="lg" type="text" placeholder="From"/>
                            </b-input-group>
                        </div>
                        <div class="col-lg-3">
                            <b-input-group>
                                <b-form-input size="lg" type="text" placeholder="To"/>
                            </b-input-group>
                        </div>
                        <div class="col-lg-3">
                            <b-input-group>
                                <b-input-group-text slot="prepend">
                                    <span class="input-group-text">
                                        <i class="fa fa-calendar"></i>
                                    </span>
                                </b-input-group-text>
                                <b-form-input size="lg" type="text" placeholder="Date"/>
                            </b-input-group>
                        </div>
                        <div class="col-lg-3">
                            <b-input-group>
                                <b-btn block class="btn btn-lg btn-success btn-pill align-self-center">
                                    <i class="fa fa-start mr-2"></i>Start
                                </b-btn>
                            </b-input-group>
                        </div>
                    </div>
                </b-form>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "inner-wrapper",
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
    .search-btn {

    }

</style>
