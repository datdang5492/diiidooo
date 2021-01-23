<template>
    <div class="section py-4 min-height-normal">
        <div class="container" v-if="Object.entries(shipment).length !== 0">
            <div class="row mb-5">
                <div class="col-lg-10 offset-lg-1">
                    <div class="row">
                        <div class="col-lg-7">
                            <h2 class="text-center mb-3 mt-3">Comfirm and pay</h2>
                            <div class="row mb-5">
                                <div class="col-lg-12">
                                    <b-dropdown
                                        id="paymentOptions"
                                        size="lg"
                                        :text="paymentTitle"
                                        variant="outline-secondary"
                                        block
                                        class="m-2 big_dropdown"
                                    >
                                        <b-dropdown-item v-for="(payment, code) in this.paymentOptions" :key="code"
                                                         class="big_dropdown_option border-bottom"
                                                         v-on:click=" choosePayment(code)">
                                            <div class="row" @mouseover="handleHover(code)">
                                                <div class="col-lg-8">
                                                    <img class="icon_small"
                                                         :src="payment.icon">
                                                    <span class="payment_method_name"
                                                          :class="hoveredPayment === code ? 'text-primary' : ''">
                                                        {{payment.name}}</span>
                                                </div>
                                                <div class="col-lg-4 text-right">
                                                    <i v-if="chosenPayment === code"
                                                       class="fas fa-check text-success text-right"></i>
                                                </div>
                                            </div>
                                        </b-dropdown-item>
                                    </b-dropdown>
                                </div>
                            </div>

                            <credit-card v-bind:chosenPayment="this.chosenPayment"></credit-card>
                            <paypal v-bind:chosenPayment="this.chosenPayment"></paypal>
                            <gpay v-bind:chosenPayment="this.chosenPayment"></gpay>
                            <sofort v-bind:chosenPayment="this.chosenPayment"></sofort>

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
                                        <td class="font-weight-bold">Total ({{currency}})</td>
                                        <td class="text-right font-weight-bold">{{currency}}{{getTotalFee()}}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import Paypal from "./Paypal";
    import Gpay from "./Gpay";
    import Sofort from "./Sofort";
    import CreditCard from "./CreditCard";

    export default {
        name: "payment",
        components: {
            CreditCard, Paypal, Gpay, Sofort
        },
        data() {
            return {
                paymentTitle: 'Payment Methods',
                chosenPayment: '',
                hoveredPayment: '',
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

                shippingWeight: 1,

                paymentOptions: {
                    creditcard: {
                        icon: 'https://cdn1.iconfinder.com/data/icons/cash-card-add-on/48/v-24-512.png',
                        name: 'Credit or debit cart',
                    },
                    paypal: {
                        icon: 'https://cdn.iconscout.com/icon/free/png-256/paypal-54-675727.png',
                        name: 'Paypal',
                    },
                    sofort: {
                        icon: 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRKhV6hKEvCjJqfLiZNdCxB4wVnilipNHLYdQLKADMtxaLvUbbx3Q&s',
                        name: 'Sofortuberweisung',
                    },
                    gpay: {
                        icon: 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTjDZzsoOR0Xfehz6EBu28CZaDVyFqBCAwDmTeRaZCtxSEm_z5P8A&s',
                        name: 'Google Pay',
                    },
                    visa: {
                        icon: 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT8IVX6hAaBdtXRDUiyB9ojZRtIIRJ43mhUJJ3Z-B601tBJxKTm&s',
                        name: 'VISA',
                    },
                }
            };
        },
        methods: {
            handleHover: function (paymentCode) {
                this.hoveredPayment = paymentCode;
            },
            choosePayment: function (paymentCode) {
                this.chosenPayment = paymentCode;
                this.paymentTitle = this.paymentOptions[paymentCode].name;
            },
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
    .payment_method_name {
        margin-left: 10px;
    }

    .big_dropdown {
        height: 40px;
    }

    .big_dropdown_option {
        line-height: 2.7;
    }

    .icon_small {
        max-width: 7%;
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
