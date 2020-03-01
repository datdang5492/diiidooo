<template>
    <div class="section py-4 min-height-1000">
        <div class="container" v-if="Object.entries(shipment).length !== 0">
            <div class="row mb-5">
                <div class="col-lg-10 offset-lg-1">
                    <div class="row">
                        <div class="col-lg-7">
                            <h2 class="text-center mb-5 mt-3">Comfirm and pay</h2>
                            <div class="row mb-5">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="paymentMethods">Pay with</label>
                                        <select class="form-control form-control-lg" id="paymentMethods">
                                            <option><img class="profile_pic rounded-circle" alt=""
                                                         src="https://content-static.upwork.com/uploads/2014/10/01073427/profilephoto1.jpg">Credit or debit cart</option>
                                            <option><img src="https://cdn.iconscout.com/icon/free/png-256/paypal-54-675727.png">Paypal</option>
                                            <option>Sofortuberweisung</option>
                                            <option>Google Pay</option>
                                            <option>VISA</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-12">
                                    <h6><i class="fas fa-box-open"></i> List of special deliveries</h6>
                                    <p>Laptop Lithium devices Cosmestic</p>
                                    <h6><i class="fas fa-dolly"></i> Lay hang tan nha</h6>
                                    <h6><i class="fas fa-shipping-fast"></i> Giao hang tan nha</h6>
                                    <h6><i class="fas fa-shopping-cart"></i> Mua do ben Duc (max €100)</h6>

                                    <h6 v-if="user.idVerified === true"><i
                                        class="fas fa-user-check text-success"></i> ID verified</h6>
                                    <h6 v-if="user.facebookVerified === true"><i
                                        class="fas fa-check text-success"></i> Facebook Page</h6>
                                    <h6 v-if="user.mobileVerified === true"><i
                                        class="fas fa-check text-success"></i> Mobile verified</h6>
                                </div>
                            </div>
                            <div class="row mt-5">
                                <div class="col-lg-12">List cac hang bi cam van chuyen</div>
                            </div>

                            <div class="row form-group mt-5">
                                <div class="col-lg-12">
                                    <h6>Say hello to {{user.firstName}} (*)</h6>
                                    <textarea
                                        v-validate="'required|alpha_spaces'"
                                        id=""
                                        class="form-control mb-4"
                                        rows="5"
                                        placeholder="Enter your message..."
                                        name="message"
                                    ></textarea>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <span class="text-danger">{{errors.first('flightFrom')}}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-5">
                            <div class="price_info">
                                <p class="font-weight-bold">
                                    <span class="font-size-20">{{shipment.flightFrom}} - {{shipment.flightTo}}</span>
                                </p>

                                <p class="">
                                    Deliver by
                                    <span class="title_huge">{{user.firstName}} {{user.lastName}}</span>
                                    <span><i class="fas fa-star text-danger"></i></span>{{user.rating}}/5
                                </p>
                                <p><i class="fas fa-plane-departure"></i> Flight Date: {{shipment.flightDate |
                                    moment(dateFormats.de)}}</p>
                                <p><i class="far fa-calendar-alt"></i> Delivery Date:
                                    {{shipment.expectedDeliveryDate | moment(dateFormats.de)}}</p>
                                <table class="table price_summary">
                                    <tbody>
                                    <tr>
                                        <td class="text-left">
                                            {{bookedWeight}} x {{currency}}{{shipment.price}}
                                        </td>
                                        <td class="text-right">
                                            {{currency}}{{getShipmentFee()}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Service fee</td>
                                        <td class="text-right">{{currency}}{{getServiceFee()}}</td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold">Total</td>
                                        <td class="text-right font-weight-bold">{{currency}}{{getTotalFee()}}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!--<tr class="">-->
            <!--<td class="text-center" colspan="2">-->
            <!--<button class="btn btn-block btn-success">Continue</button>-->
            <!--</td>-->
            <!--</tr>-->
        </div>
    </div>
</template>

<script>
    export default {
        name: "payment",
        components: {},
        data() {
            return {
                shipment: {},
                user: {},
                reviews: [],

                bookedWeight: 0,
                shipmentFee: 0,
                totalFee: 0,
                serviceFeePercent: 0.3,

                rate: 4.5,
                reviewTotal: 12,

                allowedCurrencies: {
                    eur: '€',
                    usd: '$'
                },
                currency: '',
                dateFormats: {
                    de: "DD.MM.YYYY",
                    vn: "DD/MM/YYYY"
                },

                shippingWeight: 1
            };
        },
        methods: {
            setCurrency: function (code) {
                this.currency = this.allowedCurrencies[code];
            },

            getServiceFee: function () {
                return this.shipmentFee * this.serviceFeePercent;
            },

            getShipmentFee: function () {
                return this.shipment.price * this.bookedWeight;
            },

            getTotalFee: function () {
                return this.getShipmentFee() + this.getServiceFee();
            },

            getShipment: function () {
                let loader = this.$loading.show({
                    container: this.$refs.formContainer,
                });

                let postParam = {
                    uuid: this.uuid
                };

                this.$http.post(`shipment/detail`, postParam).then(function (res) {
                    if (res.status === 200) {
                        this.shipment = res.body.shipment;
                        this.user = res.body.user;
                        this.reviews = res.body.reviews;
                        this.setCurrency(this.shipment.currency);
                    } else {
                        this.errorMsg = res.body.message;
                    }
                    loader.hide();

                }).catch(function (res) {
                    loader.hide();
                    if (!res.ok) {
                        this.showErrorMessage('Something wrong happened!');
                    }
                });

            }
        },
        created: function () {
            this.uuid = this.$route.params.id;
            this.getShipment();
        }
    };
</script>

<style scoped>
    .price_info {
        border: 1px solid #d6d8db;
        padding: 15px;
    }

    .price_info p {
        line-height: 1.1
    }

    .font-size-20 {
        font-size: 20px;
    }


</style>
