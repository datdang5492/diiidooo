<template>
    <div class="contact section-invert py-4">
        <h3 class="section-title text-center m-5">Ask us ANY question at (+49)157 5479 2720 or email</h3>
        <div class="container">
            <div class="row justify-content-md-center px-4">
                <div class="contact-form col-sm-12 col-md-10 col-lg-7 p-4 mb-4 card">
                    <form>
                        <div class="row">
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="contactFormFullName">Full Name</label>
                                    <input
                                        type="email"
                                        class="form-control"
                                        id="contactFormFullName"
                                        placeholder="Enter your full name"
                                    >
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="contactFormEmail">Email address</label>
                                    <input
                                        type="email"
                                        class="form-control"
                                        id="contactFormEmail"
                                        placeholder="Enter your email address"
                                    >
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Message</label>
                                    <textarea
                                        id="exampleInputEmail1"
                                        class="form-control mb-4"
                                        rows="10"
                                        placeholder="Enter your message..."
                                        name="message"
                                    ></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 text-center">
                                <b-button class="btn-pill align-self-center ml-auto mr-auto" size="lg"
                                          variant="success">
                                    <i class="fa fa-paper-plane mr-2"></i><span>Send your message</span>
                                </b-button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "contact",
        components: {},
        data() {
            return {};
        },
        methods: {},
        created: function () {
        }
    };
</script>

<style scoped>


</style>
