<template>
    <div class="section listing min-height-1000">
        <h3 class="section-title text-center m-5">
            Munich <span><i class="fas fa-plane-departure"></i></span> Hanoi,
        </h3>
        <div class="row text-center">
            <div class="col-lg-3 offset-lg-4">
                <div class="input-group">
                    <input type="text" class="form-control"
                           v-validate="'required|alpha_spaces'" name="trackingCode"
                           placeholder="Enter your shipment code"
                           v-model="trackingCode">
                </div>
            </div>
            <div class="col-lg-2 text-left">
                <button type="button" class="btn btn-info block">
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
                alpha: "Tracking code can not be empty!"
            },
        }
    };

    export default {
        name: "tracking",
        components: {
        },
        data() {
            return {
                trackingCode: '',

            };
        },
        methods: {

        },
        created: function () {

        }
    };
</script>

<style scoped>

</style>
