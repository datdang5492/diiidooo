<template>
    <div class="section py-4 min-height-1000">
        <div class="container">
            <div class="row">
                <div class="col-md-10 offset-lg-1">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="detail_info">
                                <div class="row">
                                    <div class="col-md-5 text-right">
                                        <div class="text-left">
                                            <img class="profile_pic rounded-circle" alt=""
                                                 src="https://content-static.upwork.com/uploads/2014/10/01073427/profilephoto1.jpg">
                                            <p>Lai Linh Chi</p>
                                        </div>
                                    </div>

                                    <div class="col-md-7">
                                        <h3 class="section-title text-center mb-5">Munchen - Hanoi</h3>
                                    </div>
                                </div>

                                <div class="">
                                    <h6><i class="fas fa-box-open"></i> List of special deliveries</h6>
                                    <p>Laptop Lithium devices Cosmestic</p>
                                    <h6><i class="fas fa-dolly"></i> Lay hang tan nha</h6>
                                    <h6><i class="fas fa-shipping-fast"></i> Giao hang tan nha</h6>
                                    <h6><i class="fas fa-shopping-cart"></i> Mua do ben Duc (max €100)</h6>

                                    <h6><i class="fas fa-user-check"></i> ID verified?</h6>
                                    <h6><i class="fas fa-check"></i> Facebook Page</h6>
                                    <h6><i class="fas fa-check"></i> Mobile verified</h6>

                                </div>
                                <div class="row">List cac hang bi cam van chuyen</div>
                                <hr>

                                <!--REVIEW SECTION-->
                                <div class="row reviews">
                                    <div class="row customer-feedback">
                                        <div class="row title">
                                            <div class="col-md-2">
                                                <img class="profile_pic rounded-circle" alt=""
                                                     src="http://www.personalbrandingblog.com/wp-content/uploads/2017/08/blank-profile-picture-973460_640.png">
                                            </div>
                                            <div class="col-md-3 name">
                                                <p class="font-weight-bold">Gerry</p>
                                                <p>January 2019</p>
                                            </div>
                                        </div>
                                        <div class="row content">
                                            <div class="col-md-12">
                                                <p>Dat was a great shipper, he did delivery on time.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row shipper-comment">
                                        <div class="row title">
                                            <div class="col-md-2 offset-md-2">
                                                <img class="profile_pic rounded-circle" alt=""
                                                     src="https://content-static.upwork.com/uploads/2014/10/01073427/profilephoto1.jpg">
                                            </div>
                                            <div class="col-md-3 name">
                                                <p class="font-weight-bold">Dat Dang</p>
                                                <p>January 2019</p>
                                            </div>
                                        </div>
                                        <div class="row content">
                                            <div class="col-md-12 offset-md-4">
                                                <p>Thanks, Gerry. Hopefully I can help you next time.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row reviews">
                                    <div class="row customer-feedback">
                                        <div class="row title">
                                            <div class="col-md-2">
                                                <img class="profile_pic rounded-circle" alt=""
                                                     src="https://content-static.upwork.com/uploads/2014/10/01073427/profilephoto1.jpg">
                                            </div>
                                            <div class="col-md-3 name">
                                                <p class="font-weight-bold">Gerry</p>
                                                <p>January 2019</p>
                                            </div>
                                        </div>
                                        <div class="row content">
                                            <div class="col-md-12">
                                                <p>Dat was a great shipper, he did delivery on time.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row shipper-comment">
                                        <div class="row title">
                                            <div class="col-md-2 offset-md-2">
                                                <img class="profile_pic rounded-circle" alt=""
                                                     src="https://content-static.upwork.com/uploads/2014/10/01073427/profilephoto1.jpg">
                                            </div>
                                            <div class="col-md-3 name">
                                                <p class="font-weight-bold">Dat Dang</p>
                                                <p>January 2019</p>
                                            </div>
                                        </div>
                                        <div class="row content">
                                            <div class="col-md-12 offset-md-4">
                                                <p>Thanks, Gerry. Hopefully I can help you next time.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--END OF REVIEW SECTION-->
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="price_info">
                                <p class="font-weight-bold"><span class="font-size-20">€7</span> per kilogram</p>
                                <p>
                                    <i class="far fa-star"></i>
                                    <i class="far fa-star"></i>
                                    <i class="far fa-star"></i>
                                    <i class="far fa-star"></i>
                                    <i class="far fa-star-half"></i>
                                    (15 rates)
                                </p>
                                <p><i class="fas fa-plane-departure"></i> Flight Date: 01.01.2019</p>
                                <p><i class="far fa-calendar-alt"></i> Expected Delivery Date: 06.01.2019</p>
                                <d-form-select v-model="selected" :options="options"/>
                                <table class="table price_summary">
                                    <tbody>
                                    <tr>
                                        <td>€7 * 2</td>
                                        <td class="text-right">€14</td>
                                    </tr>
                                    <tr>
                                        <td>Service fee</td>
                                        <td class="text-right">€3</td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold">Total</td>
                                        <td class="text-right font-weight-bold">€17</td>
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
        </div>
    </div>
</template>

<script>
    export default {
        name: "detail",
        components: {},
        data() {
            return {
                options: {
                    "first": "1kg",
                    "second": "1.5kg",
                    "third": "2kg",
                    "fourth": "2.5kg"
                },
                selected: "dat"
            };
        },
        methods: {},
        created: function () {
        }
    };
</script>

<style scoped>
    .detail_info .profile_pic {
        max-width: 40%;
    }

    .reviews .profile_pic {
        max-width: 100%;
    }

    .reviews .title .name p {
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
