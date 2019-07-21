<template>
    <div class="contact section-invert py-4">
        <h3 class="section-title text-center m-5">Contact Us</h3>
        <div class="container py-4">
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
                            <div class="col">
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
                        <input
                            class="btn btn-success btn-pill d-flex ml-auto mr-auto"
                            type="submit"
                            value="Send Your Message"
                        >
                    </form>
                </div>
            </div>
        </div>
        <h3 class="section-title text-center m-5">Have a question? Don't hesitate to call us (+49)157 5479 2720</h3>
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
