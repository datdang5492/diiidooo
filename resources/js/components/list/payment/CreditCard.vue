<template>
    <div class="row mt-5 creditcard" v-if="chosenPayment === this.paymentCode ">
        <div class="col-lg-12">
            <div class="row mt-1">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label>First Name</label>
                        <input type="text" class="form-control">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label>Last Name</label>
                        <input type="text" class="form-control">
                    </div>
                </div>
            </div>

            <div class="row mt-1">
                <div class="col-lg-12">
                    <div class="row mt-1">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Card Number</label>
                                <input type="text" class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="row mt-1">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Expiration</label>
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>CVV</label>
                                <input type="text" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-1">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label>ZIP code</label>
                        <input type="text" class="form-control">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label>Region</label>
                        <input type="text" class="form-control">
                    </div>
                </div>
            </div>

            <div class="row mt-1">
                <div class="col-lg-12">
                    <div class="form-group">
                        <label>Voucher code</label>
                        <input type="text" class="form-control">
                    </div>
                </div>
            </div>

            <div class="row mt-1">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-12">
                            <p>{{warningText}}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-5">
                            <button type="button" class="btn btn-danger btn-lg btn-block">
                                Confirm and Pay
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        name: "credit-card",
        components: {},
        props: {
            chosenPayment: String
        },
        data() {
            return {
                paymentCode: 'creditcard',
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
