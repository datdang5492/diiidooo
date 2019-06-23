<template>
    <div class="inner-wrapper mt-auto container-fluid mb-5">
        <div class="row">
            <div class="col-lg-8 col-md-10 col-sm-12 offset-lg-2 text-center">
                <h4 class="welcome-heading display-4 mt-auto">Send your packages back home through friends</h4>
                <p class="">SAVE. FAST. SECURED</p>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-8 col-md-10 col-sm-12 offset-lg-2">
                <b-form>
                    <div class="mb-auto mt-5 row">
                        <div class="col-lg-3">
                            <b-input-group>
                                <b-form-input type="text" placeholder="From"></b-form-input>
                            </b-input-group>
                        </div>
                        <div class="col-lg-3">
                            <b-input-group>
                                <b-form-input type="text" placeholder="To"></b-form-input>
                            </b-input-group>
                        </div>
                        <div class="col-lg-3">
                            <date-picker v-model="date"></date-picker>
                        </div>
                        <div class="col-lg-3">
                            <b-input-group>
                                <b-button class="btn btn-success btn-pill align-self-center" block style="max-width: 270px">
                                    <i class="fa fa-search mr-2"></i>Find friends
                                </b-button>
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
        name: "search-section",
        components: {},
        data() {
            return {
                date: new Date()
            };
        },
        methods: {},
        created: function () {
        }
    };
</script>

<style scoped>

</style>
