<template>
    <div class="section py-4 min-height-normal">
        <div class="container" v-if="Object.entries(shipment).length !== 0">
            <div class="row mb-5">
                <div class="col-lg-10 offset-lg-1">
                    <div class="row">
                        <div class="col-lg-7 detail_info">
                            <div class="row">
                                <div class="col-lg-5 text-right">
                                    <div class="text-left">
                                        <img class="profile_pic rounded-circle" alt=""
                                             src="https://content-static.upwork.com/uploads/2014/10/01073427/profilephoto1.jpg">
                                        <p>
                                            <span class="mt-3 font-weight-bold title_huge">{{user.firstName}} {{user.lastName}}</span>
                                            <span><i class="fas fa-star text-danger"></i></span>
                                            {{user.rating}}/5
                                        </p>
                                    </div>
                                </div>

                                <div class="col-lg-7">
                                    <h3 class="section-title text-center mb-4">{{shipment.flightFrom}} -
                                        {{shipment.flightTo}}</h3>
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
                                <p class="font-weight-bold"><span class="font-size-20">
                                    {{currency}}{{shipment.price}}</span> per kilogram</p>
                                <p><i class="fas fa-plane-departure"></i> Flight Date: {{shipment.flightDate |
                                    moment(dateFormats.de)}}</p>
                                <p><i class="far fa-calendar-alt"></i> Expected Delivery Date:
                                    {{shipment.expectedDeliveryDate | moment(dateFormats.de)}}</p>
                                <table class="table price_summary">
                                    <tbody>
                                    <tr>
                                        <td>
                                            <input v-model="bookedWeight" class="form-control">
                                        </td>
                                        <td class="text-right font-weight-bold">*
                                            {{currency}}{{shipment.price}} =
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
                                    <tr class="">
                                        <td class="text-center" colspan="2">
                                            <button class="btn btn-block btn-success">Continue</button>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!--REVIEW SECTION-->
            <shipment-review v-bind:reviews="reviews"></shipment-review>
            <!--END OF REVIEW SECTION-->
        </div>
    </div>
</template>

<script>

    import ShipmentReview from "./ShipmentReview";

    export default {
        name: "shipment-detail",
        components: {
            ShipmentReview
        },
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
    .detail_info .profile_pic {
        max-width: 40%;
    }

    .review_section .profile_pic {
        max-width: 100%;
    }

    .review_section .title .name p {
        margin-top: 10px;
        margin-bottom: 10px;
    }

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
