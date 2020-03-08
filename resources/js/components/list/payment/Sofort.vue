<template>
    <div class="row mt-5 sofort" v-if="chosenPayment === this.paymentCode ">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-12">
                    <p>{{warningText}}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-5">
                    <button type="button" class="btn btn-warning btn-lg btn-block">
                        Confirm and Pay
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        name: "sofort",
        components: {},
        props: {
            chosenPayment: String
        },
        data() {
            return {
                paymentCode: 'sofort',
                warningText: 'By selecting the button below, I agree to the House Rules, Cancellation\n' +
                    '                            Policy,\n' +
                    '                            and the Guest Refund Policy.\n' +
                    '                            I also agree to pay the total amount shown, which includes Service Fees.\n' +
                    '                            Payment Terms between you and Airbnb Payments UK Ltd.'
            };
        },
        methods: {},
        created: function () {
        }
    };
</script>

<style scoped>

</style>
