<template>
    <div class="min-height-1000">
        <div class="row">
            <div class="col-md-12">
                <b-progress :max="progressMax" show-progress animated>
                    <b-progress-bar variant="info" :value="progressValue"
                                    :label="`${((progressValue / progressMax) * 100).toFixed(2)}%`"></b-progress-bar>
                </b-progress>
            </div>
        </div>
        <!--
            from
            to
            flight date
            expected delivery date


            available weight
            currency                    select/options
            price per kg
            home pick up              ( yes / no)
            deliver document (< 1kg)  ( yes / no)
            price of document (6 eur / package < 1kg)


            list of not-delivered products
                - thuc pham
                - laptop
                - lithium battery devices
                ...
            personal note


            off 10% for first guest

            note on baggage product on international flights

            Display summary of listing

        -->

        <div class="container-fluid m-4">
            <div class="row" id="add_list_step_1" v-if="steps['1']" >
                <div class="col-lg-12">
                    <div class="row mb-3 text-center">
                        <div class="col-lg-5 offset-lg-2">
                            <h3>Where are you flying to ?</h3>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-5 offset-lg-2">
                            <b-form>
                                <b-card bg-variant="light">
                                    <b-form-group
                                        label-cols-lg="2"
                                        label="Step 1: Flight Information"
                                        label-size="lg"
                                        label-class="font-weight-bold pt-0"
                                        class="mb-0"
                                    >
                                        <b-form-group
                                            label-cols-sm="3"
                                            label="From:"
                                            label-align-sm="right"
                                            label-for="flight_from"
                                        >
                                            <b-form-input id="flight_from"></b-form-input>
                                        </b-form-group>

                                        <b-form-group
                                            label-cols-sm="3"
                                            label="To:"
                                            label-align-sm="right"
                                            label-for="flight_to"
                                        >
                                            <b-form-input id="flight_to"></b-form-input>
                                        </b-form-group>

                                        <b-form-group
                                            label-cols-sm="3"
                                            label="Flight date:"
                                            label-align-sm="right"
                                            label-for="flight_date"
                                        >
                                            <date-picker id="flight_date"></date-picker>
                                        </b-form-group>

                                        <b-form-group
                                            label-cols-sm="3"
                                            label="Expected delivery date (After your flight):"
                                            label-align-sm="right"
                                            label-for="expected_delivery_date"
                                        >
                                            <date-picker id="expected_delivery_date"></date-picker>
                                        </b-form-group>
                                    </b-form-group>
                                </b-card>

                                <div class="mb-auto mt-5 row text-center">
                                    <div class="col-lg-5 text-center py-2">
                                        <b-link href="#" class="back_link">
                                            <i class="fa fa-chevron-left mr-2"></i>Back
                                        </b-link>
                                    </div>
                                    <div class="col-lg-7 text-center">
                                        <b-button v-on:click="nextStep(1,2)"
                                            class="btn btn-pill align-self-center" size="lg" variant="info">
                                            Next<i class="fa fa-chevron-right ml-2"></i>
                                        </b-button>
                                    </div>
                                </div>
                            </b-form>
                        </div>
                        <div class="col-lg-4">
                            <div class="col-lg-12">
                                <b-card
                                    title="Tips"
                                    img-src="https://picsum.photos/600/300/?image=25"
                                    img-alt="Image"
                                    img-top
                                    tag="article"
                                    style="max-width: 20rem;"
                                    class="mb-2"
                                >
                                    <b-card-text>
                                        Estimate the date you will deliver the package after you arive to the
                                        destination city.
                                        This will be very useful for the customer.
                                        I.e: average delivery time in Hanoi is 2-3 days
                                    </b-card-text>
                                </b-card>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row" id="add_list_step_2" v-if="steps['2']">
                <div class="col-lg-12">
                    <div class="row mb-3 text-center">
                        <div class="col-lg-5 offset-lg-2">
                            <h3>Shipment setting</h3>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-5 offset-lg-2">
                            <b-form>
                                <b-card bg-variant="light">
                                    <b-form-group
                                        label-cols-lg="2"
                                        label="Step 2: Shipping Information"
                                        label-size="lg"
                                        label-class="font-weight-bold pt-0"
                                        class="mb-0"
                                    >
                                        <b-form-group
                                            label-cols-sm="3"
                                            label="Available weight:"
                                            label-align-sm="right"
                                            label-for="available_weight"
                                        >
                                            <b-input-group append="kg">
                                                <b-form-input id="available_weight"></b-form-input>
                                            </b-input-group>
                                        </b-form-group>

                                        <b-form-group
                                            label-cols-sm="3"
                                            label="Payment currency:"
                                            label-align-sm="right"
                                            label-for="currency"
                                        >
                                            <b-input-group>
                                                <b-form-select slot="prepend"
                                                               class="mb-2 mr-sm-2 mb-sm-0"
                                                               :value="null"
                                                               :options="{ 'usd': 'USD', 'eur': 'EUR', 'vnd': 'VND' }"
                                                               id="currency"
                                                >
                                                    <option slot="first" :value="null">Currency</option>
                                                </b-form-select>
                                            </b-input-group>
                                        </b-form-group>

                                        <b-form-group
                                            label-cols-sm="3"
                                            label="Price per kg:"
                                            label-align-sm="right"
                                            label-for="price_per_kg"
                                        >
                                            <b-input-group append="EUR">
                                                <b-form-input id="price_per_kg"></b-form-input>
                                            </b-input-group>
                                        </b-form-group>

                                        <b-form-group
                                            label-cols-sm="3"
                                            label="Home pickup:"
                                            label-align-sm="right" class="mb-0"
                                        >
                                            <b-form-radio-group
                                                class="pt-2"
                                                :options="['Yes', 'No']"
                                            ></b-form-radio-group>
                                        </b-form-group>

                                        <b-form-group
                                            label-cols-sm="3"
                                            label="Offer deliver document (< 1kg package):"
                                            label-align-sm="right" class="mb-0"
                                        >
                                            <b-form-radio-group
                                                class="pt-2"
                                                :options="['Yes', 'No']"
                                            ></b-form-radio-group>
                                        </b-form-group>

                                        <b-form-group
                                            label-cols-sm="3"
                                            label="Price per document package (< 1kg):"
                                            label-align-sm="right"
                                            label-for="price_per_document"
                                        >
                                            <b-input-group append="EUR">
                                                <b-form-input id="price_per_document"></b-form-input>
                                            </b-input-group>
                                        </b-form-group>
                                    </b-form-group>
                                </b-card>

                                <div class="mb-auto mt-5 row text-center">
                                    <div class="col-lg-5 py-2">
                                        <b-link href="#" class="back_link" v-on:click="previousStep(2,1)">
                                            <i class="fa fa-chevron-left mr-2"></i>Back
                                        </b-link>
                                    </div>
                                    <div class="col-lg-7">
                                        <b-button v-on:click="nextStep(2,3)"
                                            class="btn btn-pill align-self-center" size="lg" variant="info">
                                            Next<i class="fa fa-chevron-right ml-2"></i>
                                        </b-button>
                                    </div>
                                </div>
                            </b-form>
                        </div>
                        <div class="col-lg-4">
                            <div class="col-lg-12 text-center">
                                <b-card
                                    title="Tips"
                                    img-src="https://picsum.photos/600/300/?image=25"
                                    img-alt="Image"
                                    img-top
                                    tag="article"
                                    style="max-width: 20rem;"
                                    class="mb-2"
                                >
                                    <b-card-text>
                                        Some customers only want to deliver light weight documents, help them by offer delivering documents :)
                                    </b-card-text>
                                </b-card>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row" id="add_list_step_3" v-if="steps['3']">
                <div class="col-lg-12">
                    <div class="row mb-3 text-center">
                        <div class="col-lg-5 offset-lg-2">
                            <h3>Shipment requirement</h3>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-5 offset-lg-2">
                            <b-form>
                                <b-card bg-variant="light">
                                    <b-form-group
                                        label-cols-lg="2"
                                        label="Step 3: Note on the shipment"
                                        label-size="lg"
                                        label-class="font-weight-bold pt-0"
                                        class="mb-0"
                                    >
                                    <b-form-group label="Do you accept deliver this kind of items ?">
                                        <b-form-checkbox-group
                                            v-model="selected"
                                            :options="options"
                                            switches
                                        ></b-form-checkbox-group>
                                    </b-form-group>


                                    <b-form-textarea
                                        id="textarea"
                                        v-model="text"
                                        placeholder="Some important note to customer before they contact you..."
                                        rows="15"
                                        max-rows="25"
                                    ></b-form-textarea>
                                    </b-form-group>
                                </b-card>

                                <div class="mb-auto mt-5 row text-center">
                                    <div class="col-lg-5 py-2">
                                        <b-link href="#" class="back_link" v-on:click="previousStep(3,2)">
                                            <i class="fa fa-chevron-left mr-2"></i>Back
                                        </b-link>
                                    </div>
                                    <div class="col-lg-7">
                                        <b-button v-on:click="nextStep(3,4)"
                                            class="btn btn-pill align-self-center" size="lg" variant="info">
                                            Next<i class="fa fa-chevron-right ml-2"></i>
                                        </b-button>
                                    </div>
                                </div>
                            </b-form>
                        </div>
                        <div class="col-lg-4">
                            <div class="col-lg-12 text-center">
                                <b-card
                                    title="Tips"
                                    img-src="https://picsum.photos/600/300/?image=25"
                                    img-alt="Image"
                                    img-top
                                    tag="article"
                                    style="max-width: 20rem;"
                                    class="mb-2"
                                >
                                    <b-card-text>
                                        Some quick example text to build on the card title and make up the bulk of the
                                        card's content.
                                    </b-card-text>
                                </b-card>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row" id="add_list_step_4" v-if="steps['4']">
                <div class="col-lg-12">
                    <div class="row mb-3 text-center">
                        <div class="col-lg-5 offset-lg-2">
                            <h3>Baggage rule on international flight</h3>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-5 offset-lg-2">
                            <b-card bg-variant="light">
                                <h3>Weight, Size and Number</h3>
                                IATA has guidelines for baggage but the number and weight of baggage allowed free of charge can vary by airline, frequent flyer status, routing and fare. To avoid additional costs, please check with your airline before you travel so that you are fully aware of the checked baggage allowance included with your airfare.

                                Each bag should weigh less than 23KG/50LBS. This is an international regulation set for the health and safety of airport workers who have to lift hundreds of bags daily. If your bag weighs more than this, you may be asked to repack, or have it labeled as "heavy luggage".

                                The maximum weight for one bag is 32KG/70LBS in the EU and the US. Some airlines impose lower limits.
                                The "piece concept" is generally in use on flights within, to and from Canada and the United States.  This concept defines the number of bags entitled by the passenger's ticket.  Where the "piece concept" applies, generally, two pieces of checked baggage are allowed per passenger, each piece weighing a maximum of 32 kilos (70 lb) and measuring no more than 158 cm (62 in) when  adding the dimensions: height + width + length.

                                <h3>Identification</h3>
                                Lost baggage is often the consequence of the baggage label having detached from the bag. To allow identification of your bag in all situations, make sure to have your name, telephone number and email address appear outside of your bag and a copy of your travel itinerary inside your bag. When there is no other way to identify your luggage, the airline will have to break it open and this identification piece will be crucial to returning your belongings.

                                <h3>Valuables</h3>
                                We recommend that you do not pack valuable items in checked baggage.

                                <h3>What Not To Pack In Checked Baggage</h3>
                                We recommend that all portable electronic devices are placed in your carry-on baggage, but if you need to place them in your checked baggage, you must make sure that they are fully switched off and not in sleep or hibernate mode.

                                Electronic cigarettes/vapes, spare batteries and portable power supplies (power banks) must not be packed in your checked baggage.

                                Some items such as gas canisters, lighters, fireworks, bleaches etc. cannot be carried in checked baggage.  If you are concerned that something that you wish to pack may not be allowed, check with your airline. Items that are considered to be too dangerous for checked baggage will be removed and probably not returned to you.
                                For additional information please see the Dangerous Goods page.
                            </b-card>
                            <div class="mb-auto mt-5 row text-center">
                                <div class="col-lg-5 py-2">
                                    <b-link href="#" class="back_link" v-on:click="previousStep(4,3)">
                                        <i class="fa fa-chevron-left mr-2"></i>Back
                                    </b-link>
                                </div>
                                <div class="col-lg-7">
                                    <b-button v-on:click="nextStep(4,5)"
                                              class="btn btn-pill align-self-center" size="lg" variant="info">
                                        Next<i class="fa fa-chevron-right ml-2"></i>
                                    </b-button>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="col-lg-12 text-center">
                                <b-card
                                    title="Tips"
                                    img-src="https://picsum.photos/600/300/?image=25"
                                    img-alt="Image"
                                    img-top
                                    tag="article"
                                    style="max-width: 20rem;"
                                    class="mb-2"
                                >
                                    <b-card-text>
                                        Some quick example text to build on the card title and make up the bulk of the
                                        card's content.
                                    </b-card-text>
                                </b-card>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row" id="add_list_step_5" v-if="steps['5']">
                <div class="col-lg-12">
                    <div class="row mb-3 text-center">
                        <div class="col-lg-5 offset-lg-2">
                            <h3>Great, finally, check your shipment information</h3>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-5 offset-lg-2">
                            <b-card bg-variant="light">

                            </b-card>
                            <div class="mb-auto mt-5 row text-center">
                                <div class="col-lg-5 py-2">
                                    <b-link href="#" class="back_link" v-on:click="previousStep(5,4)">
                                        <i class="fa fa-chevron-left mr-2"></i>Back
                                    </b-link>
                                </div>
                                <div class="col-lg-7">
                                    <b-button
                                        class="btn btn-pill align-self-center" size="lg" variant="info">
                                        Next<i class="fa fa-chevron-right ml-2"></i>
                                    </b-button>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="col-lg-12 text-center">
                                <b-card
                                    title="Tips"
                                    img-src="https://picsum.photos/600/300/?image=25"
                                    img-alt="Image"
                                    img-top
                                    tag="article"
                                    style="max-width: 20rem;"
                                    class="mb-2"
                                >
                                    <b-card-text>
                                        Some quick example text to build on the card title and make up the bulk of the
                                        card's content.
                                    </b-card-text>
                                </b-card>
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
        name: "list",
        components: {},
        data() {
            return {
                // 5 steps
                steps: {
                    1 : true,
                    2 : false,
                    3 : false,
                    4 : false,
                    5 : false,
                },

                progressValue: 20,
                progressMax: 100,

                options: [
                    {text: 'Laptop', value: 'laptop'},
                    {text: 'Food', value: 'food'},
                    {text: 'Alcohol', value: 'alcohol'},
                    {text: 'Lithium Devices', value: 'lithium_devices'}
                ]
            }
        },
        methods: {
            nextStep: function(currentStep, nextStep) {
                this.steps[currentStep] = false;
                this.steps[nextStep] = true;
                this.progressValue += 20;
            },

            previousStep: function(currentStep, lastStep) {
                this.steps[currentStep] = false;
                this.steps[lastStep] = true;
                this.progressValue -= 20;
            },
        },
        created: function () {
        }
    };
</script>

<style scoped>
    .listing .card-body {
        padding: 1.5rem;
    }

    .listing .listing_box p {
        margin-bottom: 0px;
    }

    .back_link {
        font-size: 1.25rem;
    }

</style>
