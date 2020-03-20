<template>
    <div class="section listing min-height-normal justify-content-center">
        <div class="px-2 row" v-if="shipment !== null">
            <div class="col-lg-8 offset-lg-2">
                <div class="card-header bg-white">
                    <div class="row justify-content-between">
                        <div class="col">
                            <p class="text-muted"> Shipment ID <span
                                class="font-weight-bold text-dark">{{shipmentId}}</span>
                            </p>
                            <p class="text-muted"> Place On
                                <span class="font-weight-bold text-dark">12,March 2019</span>
                                <!--<span class="font-weight-bold text-dark">{{shipment.orderDate}}</span>-->
                            </p>
                        </div>
                        <div class="flex-col my-auto">
                            <h6 class="ml-auto mr-3"><a href="#">View Details</a></h6>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="media flex-column flex-sm-row">
                        <div class="media-body ">
                            <h5 class="bold">Munich - Hanoi</h5>
                            <h6 class="mt-3 mb-4 bold">Total price:
                                <span class="mt-5">EUR</span> 4
                                <!--<span class="mt-5">{{shipment.currency}}</span> 4-->
                                <span class="small text-muted">via </span>
                                <i class="title-size1 fab fa-paypal text-primary"></i>
                                <span class="small text-muted"> Paypal</span>
                                <!--<span class="small text-muted"> {{shipment.paymentMethod}}</span>-->
                            </h6>
                            <p class="text-muted"> Weight: 4 kg</p>
                            <!--<p class="text-muted"> Weight: {{this.shipment.totalWeight}} kg</p>-->
                            <p class="text-muted">Last update on:
                                <span class="today">11:30pm, March 15, 2020</span>
                                <!--<span class="today">{{shipment.lastUpdate}}</span>-->
                            </p>
                        </div>
                        <img class="align-self-center img-fluid"
                             src="/images/dido_box.jpg"
                             width="180 "
                             height="180">
                    </div>
                </div>
                <div class="row px-3">
                    <div class="col">
                        <ul id="progressbar">
                            <li v-for="(item, index) in shipment.progress" class="active"
                            v-bind:class="getStepClass(index)">
                                {{item.status}}
                            </li>

                            <!--<li class="step active">Shipment placed</li>-->
                            <!--<li class="step active">On the way to Shipper</li>-->
                            <!--<li class="step active">Shipper received</li>-->
                            <!--<li class="step active">On flight</li>-->
                            <!--<li class="step active">Out for delivery in Vietnam</li>-->
                            <!--<li class="step active">Delivered</li>-->
                        </ul>
                    </div>
                </div>
                <div class="card-footer bg-white px-sm-3 pt-sm-4 px-0">
                    <div class="row text-center ">
                        <div class="col my-auto border-line ">
                            <router-link class="nav-link active title_size2 font_common" to="/tracking">
                                <h5><i class="fas fa-chevron-left"></i> Back</h5>
                            </router-link>
                        </div>
                        <div class="col my-auto border-line ">
                            <router-link class="nav-link active title_size2 font_common" to="/">
                                <h5>Go to Homepage</h5>
                            </router-link>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "tracking-progress",
        components: {},
        data() {
            return {
                shipmentId: '',
                userData: null,
                errorMsg: '',
                showErrorMsg: false,
                infoMsg: '',
                showInfoMsg: false,
                shipment: {
                }
            };
        },

        methods: {
            getStepClass: function (index){
                const classNo = index + 1;
                return "step" + classNo;
            },

            showErrorMessage: function (message) {
                this.showErrorMsg = true;
                this.errorMsg = message;
            },

            trackShipment: function () {
                let loader = this.$loading.show({
                    container: this.$refs.formContainer,
                });

                var postData = {
                    shipmentId: this.shipmentId
                };

                this.$http.post(`shipment/tracking`, postData).then(function (res) {
                    if (res.status === 200) {
                        this.shipment = res.body;
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

            },
        },
        created: function () {
            this.shipmentId = this.$route.params.id;
            this.trackShipment();
        }
    };
</script>

<style scoped>
    p {
        font-size: 14px;
        margin-bottom: 7px
    }

    a {
        text-decoration: none !important;
        color: #2b67ff !important;
        cursor: pointer;
    }

    .bold {
        font-weight: 600
    }

    .small {
        font-size: 12px !important;
        letter-spacing: 0.5px !important
    }

    .today {
        color: rgb(83, 83, 83)
    }

    #progressbar {
        margin-bottom: 30px;
        overflow: hidden;
        color: #455A64;
        padding-left: 0px;
        margin-top: 30px
    }

    #progressbar li {
        list-style-type: none;
        font-size: 13px;
        width: 16%;
        float: left;
        position: relative;
        font-weight: 400;
        color: #455A64 !important;
        text-align: center;
    }

    #progressbar .step:before {
        content: "1";
        color: #fff;
        width: 29px;
    }

    #progressbar .step1:before {
        content: "1";
        color: #fff;
        width: 29px;
    }

    #progressbar .step2:before {
        content: "2";
        color: #fff;
        width: 29px;
    }

    #progressbar .step3:before {
        content: "3";
        color: #fff;
        width: 29px;
    }

    #progressbar .step4:before {
        content: "4";
        color: #fff;
        width: 29px;
    }

    #progressbar .step5:before {
        content: "5";
        color: #fff;
        width: 29px;
    }

    #progressbar .step6:before {
        content: "6";
        color: #fff;
        width: 29px;
    }

    #progressbar li:before {
        line-height: 29px;
        display: block;
        font-size: 12px;
        background: #455A64;
        border-radius: 50%;
        margin: auto
    }

    #progressbar li:after {
        content: '';
        width: 121%;
        height: 2px;
        background: #455A64;
        position: absolute;
        right: 0%;
        top: 15px;
        z-index: -1
    }

    #progressbar li:nth-child(1):after {
        left: 45%;
    }

    #progressbar li:nth-child(6):after {
        left: 0% !important;
        width: 50% !important
    }

    #progressbar li.active:before,
    #progressbar li.active:after {
        background: #4bb8a9
    }

    .border-line {
        border-right: 1px solid rgb(226, 206, 226)
    }

    .card-footer img {
        opacity: 0.3
    }
</style>
