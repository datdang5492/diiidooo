<template>
    <div class="inner-wrapper mb-auto mt-auto container-fluid">
        <div class="row">
            <div class="col-lg-8 col-md-10 col-sm-12 offset-lg-2 text-center">
                <h3 class="welcome-heading display-5 text-white mt-auto">Send your packages back home through
                    friends</h3>
                <p class="text-white">
                    SAVE. FAST. SECURED
                </p>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-8 col-md-10 col-sm-12 offset-lg-2">
                <b-form>
                    <div class="mb-auto mt-5 row">
                        <div class="col-lg-3">
                            <d-input-group>
                                <d-form-input type="text" placeholder="From"></d-form-input>
                            </d-input-group>
                        </div>
                        <div class="col-lg-3">
                            <d-input-group>
                                <d-form-input type="text" placeholder="To"></d-form-input>
                            </d-input-group>
                        </div>
                        <div class="col-lg-3">
                            <d-datepicker v-model="date"/>
                        </div>
                        <div class="col-lg-3">
                            <d-input-group>
                                <d-button block-level class="btn btn-success btn-pill align-self-center">
                                    <i class="fa fa-start mr-2"></i>Find friends
                                </d-button>
                            </d-input-group>
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
    .display-5 {
        font-size: 3.815rem;
        line-height: 1.4;
    }

</style>
