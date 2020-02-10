<template>
    <div class="row listing_row mb-5" v-if="Array.isArray(shipmentChunk) && shipmentChunk.length !== 0">
        <div class="col-lg-6" v-for="shipment of shipmentChunk" v-bind:key="shipment.uuid">
            <a v-bind:href="'/list/item/detail/' + shipment.adId">
                <div class="card card-body listing_box">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="">
                                <h5 class="card-title">{{shipment.first_name}} {{shipment.last_name}}</h5>
                                <p class="card-subtitle mb-2">
                                    <span><i class="fas fa-star text-danger"></i></span> {{shipment.rating}} 4.5/5 (25
                                    reviews)
                                </p>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="text-right">
                                <h5 class="card-title">
                                    <span class="badge badge-pill badge-info">{{shipment.availableWeight}} kg</span>
                                </h5>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-5">
                            <img :src="'/images/profile_pics/profile_pic_1.png'"
                                 class="card-img-top profile_pic rounded-circle">
                        </div>
                        <div class="col-lg-7">
                            <div class="">
                                <p class="">
                                    <span class="font-weight-bold listing_price">{{shipment.price}} EUR</span> / kg
                                </p>
                                <p class="">
                                    <span><i class="fas fa-calendar-alt"></i></span> Expected delivery date:
                                    {{shipment.expectedDeliveryDate}}
                                </p>
                                <p class="card-text">
                                    <span><i class="fas fa-dolly"></i></span> Delivery to end target
                                </p>
                                <p class="card-text" v-if="shipment.is_verified === true">
                                    <span><i class="fas fa-check-square text-success"></i></span> Verified
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>
</template>

<script>
    export default {
        name: "list-item",
        components: {},
        props: {
            shipmentChunk: Array,
            index: Number,
        },
        data() {
            return {};
        },
        methods: {},
        created: function () {
        }
    };
</script>

<style scoped>
    .profile_pic {
        max-width: 65%;
    }

    .listing_box {
        padding: 1.5rem;
    }

    .listing_box p {
        margin-bottom: 0px;
    }

    .listing_box .badge-info {
        height: 2.5rem;
        padding: 10px;
        width: 5rem;
        font-size: large;
    }

    .listing_box .listing_price {
        font-size: large;
    }

    .listing_row a{
        color: #484848;
        text-decoration: none;
    }

</style>
