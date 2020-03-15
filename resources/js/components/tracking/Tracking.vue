<template>
    <div class="section listing min-height-1000">
        <b-alert variant="danger" :show="showErrorMsg">{{errors.first('trackingCode')}}</b-alert>
        <h3 class="section-title text-center m-5">
            Munich <span><i class="fas fa-plane-departure"></i></span> Hanoi,
        </h3>
        <div class="row text-center">
            <div class="col-lg-3 offset-lg-4">
                <div class="input-group">
                    <input type="text" class="form-control"
                           name="trackingCode"
                           placeholder="Enter your shipment code"
                           v-validate="'required|alpha_num|length:8'"
                           v-model="trackingCode">
                </div>
            </div>
            <div class="col-lg-2 text-left">
                <button type="button" class="btn btn-info block" v-on:click="showTrackingProgress()">
                    <i class="fas fa-search"></i> Track
                </button>
            </div>
        </div>
    </div>
</template>

<script>
    const dict = {
        custom: {
            trackingCode: {
                required: "Tracking code can not be empty!",
                alpha_num: "Invalid tracking code!",
                length: "Invalid tracking code!",
            },
        }
    };

    export default {
        name: "tracking",
        components: {},
        data() {
            return {
                trackingCode: '',
                errorMsg: '',
                showErrorMsg: false,
            };
        },
        methods: {
            showTrackingProgress: function () {
                this.$validator.validateAll().then((validateResult) => {
                    if (validateResult === true) {
                        const trackingSubUrl = 'tracking/progress/';
                        this.$router.push(trackingSubUrl + this.trackingCode);
                    } else {
                        this.showErrorMsg = true;
                    }
                });

            },
        },
        created: function () {
            // enable custom validation message
            this.$validator.localize('en', dict);

        }
    };
</script>

<style scoped>

</style>
