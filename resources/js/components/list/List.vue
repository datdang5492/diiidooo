<template>
    <div class="section listing min-height-1000">
        <h3 class="section-title text-center m-5">
            Munich <span><i class="fas fa-plane-departure"></i></span> Hanoi, 19.03.2019
        </h3>
        <div class="container text-center">
            <b-dropdown id="dropdown-1" text="Sort" class="m-md-2" pill variant="outline-secondary">
                <b-dropdown-item>Price (low - high)</b-dropdown-item>
                <b-dropdown-item>Price (high - low)</b-dropdown-item>
                <b-dropdown-item>Available Weight (high - low)</b-dropdown-item>
                <b-dropdown-item>Available Weight (low - high)</b-dropdown-item>
            </b-dropdown>

            <b-button v-b-toggle.collapse-1 variant="outline-secondary">
                <span><i class="fas fa-calendar-alt"></i></span> Expected delivery date
            </b-button>

            <b-dropdown variant="success" ref="dropdown">
                <template v-slot:button-content>
                    <span><i class="fas fa-money-bill"></i></span> Price (< 15 eur)
                </template>
                <b-dropdown-form style="width: 440px;">
                    <div class="row">
                        <div class="col-lg-6">
                            <label>Min price</label>
                            <b-input-group prepend="$">
                                <b-input id="dropdown-form-email"></b-input>
                            </b-input-group>
                        </div>
                        <div class="col-lg-6">
                            <label>Max price</label>
                            <b-input-group prepend="$">
                                <b-input id="dropdown-form-password"></b-input>
                            </b-input-group>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-lg-12 text-right">
                            <b-button>Apply</b-button>
                        </div>
                    </div>
                </b-dropdown-form>
            </b-dropdown>


            <b-button pill variant="outline-danger">
                <span><i class="fas fa-trash-alt"></i></span> Reset all filters
            </b-button>
        </div>
        <div class="container text-center">
            <b-collapse id="collapse-1" class="mt-2">
                <b-card>
                    <div class="mb-auto mt-4 row">
                        <div class="col-lg-8 offset-lg-2">
                            <date-picker v-model="date" :config="dateOptions"></date-picker>
                        </div>
                    </div>
                </b-card>
            </b-collapse>
        </div>

        <div class="container py-5">
            <div class="row listing_row mb-5">
                <div class="col-lg-6">
                    <div class="card card-body listing_box">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="">
                                    <h5 class="card-title">Linh Chi</h5>
                                    <p class="card-subtitle mb-2">
                                        <span><i class="fas fa-star text-danger"></i></span> 4.5 (25 reviews)
                                    </p>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="text-right">
                                    <h5 class="card-title"><span class="badge badge-pill badge-info">7 kg</span></h5>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-5">
                                <img src="images/profile_pics/profile_pic_1.png"
                                     class="card-img-top rounded-circle profile_pic">
                            </div>
                            <div class="col-lg-7">
                                <div class="">
                                    <p class="">
                                        <span class="font-weight-bold listing_price">7.5 EUR</span> / kg
                                    </p>
                                    <p class="">
                                        <span><i class="fas fa-calendar-alt"></i></span> Expected delivery date:
                                        23.03.2019
                                    </p>
                                    <p class="card-text">
                                        <span><i class="fas fa-dolly"></i></span> Delivery to end target
                                    </p>
                                    <p class="card-text">
                                        <span><i class="fas fa-check-square text-success"></i></span> ID verified
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card card-body listing_box">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="">
                                    <h5 class="card-title">Linh Chi</h5>
                                    <p class="card-subtitle mb-2">
                                        <span><i class="fas fa-star text-danger"></i></span> 4.5 (25 reviews)
                                    </p>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="text-right">
                                    <h5 class="card-title"><span class="badge badge-pill badge-info">7 kg</span></h5>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-5">
                                <img src="images/profile_pics/profile_pic_2.png"
                                     class="card-img-top rounded-circle profile_pic">
                            </div>
                            <div class="col-lg-7">
                                <div class="">
                                    <p class="">
                                        <span class="font-weight-bold listing_price">7.5 EUR</span> / kg
                                    </p>
                                    <p class="">
                                        <span><i class="fas fa-calendar-alt"></i></span> Expected delivery date:
                                        23.03.2019
                                    </p>
                                    <p class="card-text">
                                        <span><i class="fas fa-dolly"></i></span> Delivery to end target
                                    </p>
                                    <p class="card-text">
                                        <span><i class="fas fa-check-square text-success"></i></span> ID verified
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row listing_row mb-5">
                <div class="col-lg-6">
                    <div class="card card-body listing_box">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="">
                                    <h5 class="card-title">Linh Chi</h5>
                                    <p class="card-subtitle mb-2">
                                        <span><i class="fas fa-star text-danger"></i></span> 4.5 (25 reviews)
                                    </p>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="text-right">
                                    <h5 class="card-title"><span class="badge badge-pill badge-info">7 kg</span></h5>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-5">
                                <img src="images/profile_pics/profile_pic_1.png"
                                     class="card-img-top rounded-circle profile_pic">
                            </div>
                            <div class="col-lg-7">
                                <div class="">
                                    <p class="">
                                        <span class="font-weight-bold listing_price">7.5 EUR</span> / kg
                                    </p>
                                    <p class="">
                                        <span><i class="fas fa-calendar-alt"></i></span> Expected delivery date:
                                        23.03.2019
                                    </p>
                                    <p class="card-text">
                                        <span><i class="fas fa-dolly"></i></span> Delivery to end target
                                    </p>
                                    <p class="card-text">
                                        <span><i class="fas fa-check-square text-success"></i></span> ID verified
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card card-body listing_box">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="">
                                    <h5 class="card-title">Linh Chi</h5>
                                    <p class="card-subtitle mb-2">
                                        <span><i class="fas fa-star text-danger"></i></span> 4.5 (25 reviews)
                                    </p>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="text-right">
                                    <h5 class="card-title"><span class="badge badge-pill badge-info">7 kg</span></h5>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-5">
                                <img src="images/profile_pics/profile_pic_2.png"
                                     class="card-img-top rounded-circle profile_pic">
                            </div>
                            <div class="col-lg-7">
                                <div class="">
                                    <p class="">
                                        <span class="font-weight-bold listing_price">7.5 EUR</span> / kg
                                    </p>
                                    <p class="">
                                        <span><i class="fas fa-calendar-alt"></i></span> Expected delivery date:
                                        23.03.2019
                                    </p>
                                    <p class="card-text">
                                        <span><i class="fas fa-dolly"></i></span> Delivery to end target
                                    </p>
                                    <p class="card-text">
                                        <span><i class="fas fa-check-square text-success"></i></span> ID verified
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row listing_row mb-5">
                <div class="col-lg-6">
                    <div class="card card-body listing_box">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="">
                                    <h5 class="card-title">Linh Chi</h5>
                                    <p class="card-subtitle mb-2">
                                        <span><i class="fas fa-star text-danger"></i></span> 4.5 (25 reviews)
                                    </p>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="text-right">
                                    <h5 class="card-title"><span class="badge badge-pill badge-info">7 kg</span></h5>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-5">
                                <img src="images/profile_pics/profile_pic_1.png"
                                     class="card-img-top rounded-circle profile_pic">
                            </div>
                            <div class="col-lg-7">
                                <div class="">
                                    <p class="">
                                        <span class="font-weight-bold listing_price">7.5 EUR</span> / kg
                                    </p>
                                    <p class="">
                                        <span><i class="fas fa-calendar-alt"></i></span> Expected delivery date:
                                        23.03.2019
                                    </p>
                                    <p class="card-text">
                                        <span><i class="fas fa-dolly"></i></span> Delivery to end target
                                    </p>
                                    <p class="card-text">
                                        <span><i class="fas fa-check-square text-success"></i></span> ID verified
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card card-body listing_box">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="">
                                    <h5 class="card-title">Linh Chi</h5>
                                    <p class="card-subtitle mb-2">
                                        <span><i class="fas fa-star text-danger"></i></span> 4.5 (25 reviews)
                                    </p>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="text-right">
                                    <h5 class="card-title"><span class="badge badge-pill badge-info">7 kg</span></h5>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-5">
                                <img src="images/profile_pics/profile_pic_2.png"
                                     class="card-img-top rounded-circle profile_pic">
                            </div>
                            <div class="col-lg-7">
                                <div class="">
                                    <p class="">
                                        <span class="font-weight-bold listing_price">7.5 EUR</span> / kg
                                    </p>
                                    <p class="">
                                        <span><i class="fas fa-calendar-alt"></i></span> Expected delivery date:
                                        23.03.2019
                                    </p>
                                    <p class="card-text">
                                        <span><i class="fas fa-dolly"></i></span> Delivery to end target
                                    </p>
                                    <p class="card-text">
                                        <span><i class="fas fa-check-square text-success"></i></span> ID verified
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="row listing_row mb-5">
                <div class="col-lg-4">
                    <div class="card card-body listing_box">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="">
                                    <h5 class="card-title">Linh Chi</h5>
                                    <p class="card-subtitle mb-2">
                                        <span><i class="fas fa-star text-danger"></i></span> 4.5 (25 reviews)
                                    </p>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="text-right">
                                    <h5 class="card-title"><span class="badge badge-pill badge-info">€7/kg</span>
                                    </h5>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-5">
                                <img src="images/profile_pics/profile_pic_1.png"
                                     class="card-img-top rounded-circle profile_pic">
                            </div>
                            <div class="col-lg-7">
                                <div class="">
                                    <p class="">Flight Date: 20.03.2019</p>
                                    <p class="card-text">Home pickup</p>
                                    <p class="card-text">End delivery</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card card-body listing_box">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="">
                                    <h5 class="card-title">Linh Chi</h5>
                                    <p class="card-subtitle mb-2">
                                        <span><i class="fas fa-star text-danger"></i></span> 4.5 (25 reviews)
                                    </p>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="text-right">
                                    <h5 class="card-title"><span class="badge badge-pill badge-info">€7/kg</span>
                                    </h5>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-5">
                                <img src="images/profile_pics/profile_pic_2.png"
                                     class="card-img-top rounded-circle profile_pic">
                            </div>
                            <div class="col-lg-7">
                                <div class="">
                                    <p class="">Flight Date: 20.03.2019</p>
                                    <p class="card-text">Home pickup</p>
                                    <p class="card-text">End delivery</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card card-body listing_box">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="">
                                    <h5 class="card-title">Linh Chi</h5>
                                    <p class="card-subtitle mb-2">
                                        <span><i class="fas fa-star text-danger"></i></span> 4.5 (25 reviews)
                                    </p>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="text-right">
                                    <h5 class="card-title"><span class="badge badge-pill badge-info">€7/kg</span></h5>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-5">
                                <img src="images/profile_pics/profile_pic_3.png"
                                     class="card-img-top rounded-circle profile_pic">
                            </div>
                            <div class="col-lg-7">
                                <div class="">
                                    <p class="">Flight Date: 20.03.2019</p>
                                    <p class="card-text">Home pickup</p>
                                    <p class="card-text">End delivery</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row listing_row mb-5">
                <div class="col-lg-4">
                    <div class="card card-body listing_box">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="">
                                    <h5 class="card-title">Linh Chi</h5>
                                    <p class="card-subtitle mb-2">
                                        <span><i class="fas fa-star text-danger"></i></span> 4.5 (25 reviews)
                                    </p>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="text-right">
                                    <h5 class="card-title"><span class="badge badge-pill badge-info">€7/kg</span>
                                    </h5>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-5">
                                <img src="images/profile_pics/profile_pic_1.png"
                                     class="card-img-top rounded-circle profile_pic">
                            </div>
                            <div class="col-lg-7">
                                <div class="">
                                    <p class="">Flight Date: 20.03.2019</p>
                                    <p class="card-text">Home pickup</p>
                                    <p class="card-text">End delivery</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card card-body listing_box">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="">
                                    <h5 class="card-title">Linh Chi</h5>
                                    <p class="card-subtitle mb-2">
                                        <span><i class="fas fa-star text-danger"></i></span> 4.5 (25 reviews)
                                    </p>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="text-right">
                                    <h5 class="card-title"><span class="badge badge-pill badge-info">€7/kg</span>
                                    </h5>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-5">
                                <img src="images/profile_pics/profile_pic_2.png"
                                     class="card-img-top rounded-circle profile_pic">
                            </div>
                            <div class="col-lg-7">
                                <div class="">
                                    <p class="">Flight Date: 20.03.2019</p>
                                    <p class="card-text">Home pickup</p>
                                    <p class="card-text">End delivery</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card card-body listing_box">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="">
                                    <h5 class="card-title">Linh Chi</h5>
                                    <p class="card-subtitle mb-2">
                                        <span><i class="fas fa-star text-danger"></i></span> 4.5 (25 reviews)
                                    </p>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="text-right">
                                    <h5 class="card-title"><span class="badge badge-pill badge-info">€7/kg</span>
                                    </h5>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-5">
                                <img src="images/profile_pics/profile_pic_3.png"
                                     class="card-img-top rounded-circle profile_pic">
                            </div>
                            <div class="col-lg-7">
                                <div class="">
                                    <p class="">Flight Date: 20.03.2019</p>
                                    <p class="card-text">Home pickup</p>
                                    <p class="card-text">End delivery</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row listing_row mb-5">
                <div class="col-lg-4">
                    <div class="card card-body listing_box">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="">
                                    <h5 class="card-title">Linh Chi</h5>
                                    <h6 class="card-subtitle mb-2 text-muted">Ratings</h6>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="text-right">
                                    <h5 class="card-title"><span class="badge badge-pill badge-info">€7/kg</span>
                                    </h5>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-5">
                                <img src="images/profile_pics/profile_pic_1.png"
                                     class="card-img-top rounded-circle profile_pic">
                            </div>
                            <div class="col-lg-7">
                                <div class="">
                                    <p class="">Flight Date: 20.03.2019</p>
                                    <p class="card-text">Home pickup</p>
                                    <p class="card-text">End delivery</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card card-body listing_box">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="">
                                    <h5 class="card-title">Linh Chi</h5>
                                    <h6 class="card-subtitle mb-2 text-muted">Ratings</h6>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="text-right">
                                    <h5 class="card-title"><span class="badge badge-pill badge-info">€7/kg</span>
                                    </h5>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-5">
                                <img src="images/profile_pics/profile_pic_2.png"
                                     class="card-img-top rounded-circle profile_pic">
                            </div>
                            <div class="col-lg-7">
                                <div class="">
                                    <p class="">Flight Date: 20.03.2019</p>
                                    <p class="card-text">Home pickup</p>
                                    <p class="card-text">End delivery</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <a href="google.com">
                        <div class="card card-body listing_box">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="">
                                        <h5 class="card-title">Linh Chi</h5>
                                        <h6 class="card-subtitle mb-2 text-muted">Ratings</h6>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="text-right">
                                        <h5 class="card-title"><span class="badge badge-pill badge-info">€7/kg</span>
                                        </h5>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-5">
                                    <img src="images/profile_pics/profile_pic_3.png"
                                         class="card-img-top rounded-circle profile_pic">
                                </div>
                                <div class="col-lg-7">
                                    <div class="">
                                        <p class="">Flight Date: 20.03.2019</p>
                                        <p class="card-text">Home pickup</p>
                                        <p class="card-text">End delivery</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "list",
        components: {},
        data() {
            return {
                date: new Date(),
                dateOptions: {
                    format: 'DD/MM/YYYY',
                    useCurrent: false,
                    inline: true
                },
                sort: [
                    {
                        low_to_high: true,
                        high_to_low: false,
                        earliest: true,
                        latest: false
                    }
                ],
                filter: [
                    {
                        from: '',
                        to: '',
                        expected_delivery_date: '',
                        document: true,
                        price: [
                            '< 5eur',
                            '5 - 10 eur',
                            '> 10 eur'
                        ]

                    }
                ],
                total_result: 10,
                shipmentList: [
                    {
                        name: '',
                        profile_pic: '',
                        flight_date: '',
                        flight_from: '',
                        flight_to: '',
                        expected_delivery_date: '',
                        available_weight: 5,
                        rating: 4,
                        home_pickup: true,
                    }
                ]
            };
        },
        methods: {},
        created: function () {
        }
    };
</script>

<style scoped>
    .profile_pic {
        max-width: 65%;
        max-height: 70%;
    }

    .listing .listing_box {
        padding: 1.5rem;
    }

    .listing .listing_box p {
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

</style>
