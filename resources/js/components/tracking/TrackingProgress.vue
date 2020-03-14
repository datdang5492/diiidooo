<template>
    <div class="section listing min-height-1000 justify-content-center">
        <div class="px-2 row">
            <div class="col-lg-8 offset-lg-2">
                <div class="card-header bg-white">
                    <div class="row justify-content-between">
                        <div class="col">
                            <p class="text-muted"> Shipment ID <span
                                class="font-weight-bold text-dark">1222528743</span>
                            </p>
                            <p class="text-muted"> Place On <span
                                class="font-weight-bold text-dark">12,March 2019</span>
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
                            <p class="text-muted"> Weight: 4 kg</p>
                            <h6 class="mt-3 mb-4 bold">Total price: <span class="mt-5">EUR</span> 4 <span
                                class="small text-muted">via Paypal </span>
                            </h6>
                            <p class="text-muted">Last update on: <span class="Today">11:30pm, Today</span></p>
                            <!--<button type="button" class="btn some-btn d-flex">Reached Hub, Delhi</button>-->
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
                            <li class="step1 active" id="step1">Shippment placed</li>
                            <li class="step2 active" id="step2">On the way to Shipper</li>
                            <li class="step3 active" id="step3">Shipper received</li>
                            <li class="step4 active" id="step4">On flight</li>
                            <li class="step5 active" id="step5">Out for delivery in Vietnam</li>
                            <li class="step6 active" id="step6">Delivered</li>
                        </ul>
                    </div>
                </div>
                <div class="card-footer bg-white px-sm-3 pt-sm-4 px-0">
                    <div class="row text-center ">
                        <div class="col my-auto border-line ">
                            <a>
                                <h5><i class="fas fa-chevron-left"></i> Back</h5>
                            </a>
                        </div>
                        <div class="col my-auto border-line ">
                            <a>
                                <h5>Go to Homepage</h5>
                            </a>
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
                userData: null,
                errorMsg: '',
                showErrorMsg: false,
                infoMsg: '',
                showInfoMsg: false,
            };
        },

        methods: {},
        created: function () {
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

    .Today {
        color: rgb(83, 83, 83)
    }

    .some-btn {
        background-color: #fff !important;
        color: #4bb8a9 !important;
        border: 1.3px solid #4bb8a9;
        font-size: 12px;
        border-radius: 0.4em !important
    }

    .some-btn:hover {
        background-color: #4bb8a9 !important;
        color: #fff !important;
        border: 1.3px solid #4bb8a9
    }

    .some-btn:focus,
    .some-btn:active {
        outline: none !important;
        box-shadow: none !important;
        border-color: #42A5F5 !important
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

    #progressbar #step1:before {
        content: "1";
        color: #fff;
        width: 29px;
        /*margin-left: 15px !important;*/
    }

    #progressbar #step2:before {
        content: "2";
        color: #fff;
        width: 29px
    }

    #progressbar #step3:before {
        content: "3";
        color: #fff;
        width: 29px
    }

    #progressbar #step4:before {
        content: "4";
        color: #fff;
        width: 29px
    }

    #progressbar #step5:before {
        content: "5";
        color: #fff;
        width: 29px
    }

    #progressbar #step6:before {
        content: "6";
        color: #fff;
        width: 29px;
        /*margin-right: 15px !important;*/
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

    small {
        font-size: 12px !important
    }

    .border-line {
        border-right: 1px solid rgb(226, 206, 226)
    }

    .card-footer img {
        opacity: 0.3
    }

    /*.card-footer h5 {*/
        /*font-size: 1.1em;*/
        /*color: #5c85d6;*/
        /*cursor: pointer*/
    /*}*/
</style>
