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

        <div class="container-fluid m-4">
            <div class="row" id="add_list_step_1" v-if="steps['1']">
                <div class="col-lg-12">
                    <div class="row mb-3 text-center">
                        <div class="col-lg-5 offset-lg-2">
                            <h3>Where are you flying to ?</h3>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-5 offset-lg-2">
                            <b-form ref="stepOneForm">
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
                                            <b-form-input id="flight_from" name="flightFrom"
                                                          v-model="stepOne.flightFrom"
                                                          v-validate="'required|alpha_spaces'">
                                            </b-form-input>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <span class="text-danger">{{errors.first('flightFrom')}}</span>
                                                </div>
                                            </div>
                                        </b-form-group>

                                        <b-form-group
                                            label-cols-sm="3"
                                            label="To:"
                                            label-align-sm="right"
                                            label-for="flight_to"
                                        >
                                            <b-form-input id="flight_to" name="flightTo" v-model="stepOne.flightTo"
                                                          v-validate="'required|alpha_spaces'">>
                                            </b-form-input>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <span class="text-danger">{{errors.first('flightTo')}}</span>
                                                </div>
                                            </div>
                                        </b-form-group>

                                        <b-form-group
                                            label-cols-sm="3"
                                            label="Flight date:"
                                            label-align-sm="right"
                                            label-for="flight_date"
                                        >
                                            <date-picker id="flight_date" name="flightDate"
                                                         v-model="stepOne.flightDate" :config="dateOptions"
                                                         v-validate="'required|date_format:dd/MM/yyyy|before:expectedDeliveryDate'">
                                            </date-picker>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <span class="text-danger">{{errors.first('flightDate')}}</span>
                                                </div>
                                            </div>
                                        </b-form-group>

                                        <b-form-group
                                            label-cols-sm="3"
                                            label="Expected delivery date (After your flight):"
                                            label-align-sm="right"
                                            label-for="expected_delivery_date"
                                        >
                                            <date-picker id="expected_delivery_date" name="expectedDeliveryDate"
                                                         ref="expectedDeliveryDate"
                                                         v-model="stepOne.expectedDeliveryDate" :config="dateOptions"
                                                         v-validate="'required|date_format:dd/MM/yyyy'">
                                            </date-picker>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <span
                                                        class="text-danger">{{errors.first('expectedDeliveryDate')}}</span>
                                                </div>
                                            </div>
                                        </b-form-group>
                                    </b-form-group>
                                </b-card>

                                <div class="mb-auto mt-5 row text-center">
                                    <div class="col-lg-5 text-center py-2">
                                        <b-link href="/" class="back_link">
                                            <i class="fa fa-chevron-left mr-2"></i>Cancel
                                        </b-link>
                                    </div>
                                    <div class="col-lg-7 text-center">
                                        <b-button v-on:click="saveCurrentStep(1,2)"
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
                                        Estimate the date you will deliver the package after you arrive to the
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
                            <b-form ref="stepTwoForm">
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
                                                <b-form-input id="available_weight" name="availableWeight"
                                                              v-model="stepTwo.availableWeight"
                                                              v-validate="'required|numeric|max:3'">>
                                                </b-form-input>
                                            </b-input-group>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <span
                                                        class="text-danger">{{errors.first('availableWeight')}}</span>
                                                </div>
                                            </div>
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
                                                               :options="allowedCurrency"
                                                               id="currency"
                                                               name="currency" v-model="stepTwo.currency"
                                                               v-validate="'required|alpha|length:3'">

                                                    <option slot="first" :value="null">Currency</option>
                                                </b-form-select>
                                            </b-input-group>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <span
                                                        class="text-danger">{{errors.first('currency')}}</span>
                                                </div>
                                            </div>
                                        </b-form-group>

                                        <b-form-group
                                            label-cols-sm="3"
                                            label="Price per kg:"
                                            label-align-sm="right"
                                            label-for="price_per_kg"
                                        >
                                            <b-input-group :append="getCurrencyName(stepTwo.currency)">
                                                <b-form-input id="price_per_kg" name="price" v-model="stepTwo.price"
                                                              v-validate="'required|numeric'">

                                                </b-form-input>
                                            </b-input-group>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <span
                                                        class="text-danger">{{errors.first('price')}}</span>
                                                </div>
                                            </div>
                                        </b-form-group>

                                        <b-form-group
                                            label-cols-sm="3"
                                            label="Home pickup:"
                                            label-align-sm="right" class="mb-0"
                                        >
                                            <b-form-radio-group
                                                class="pt-2"
                                                :options="['Yes', 'No']" name="homePickup" v-model="stepTwo.homePickup"
                                                v-validate="'required|alpha|max:3'">
                                            </b-form-radio-group>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <span
                                                        class="text-danger">{{errors.first('homePickup')}}</span>
                                                </div>
                                            </div>
                                        </b-form-group>

                                        <b-form-group
                                            label-cols-sm="3"
                                            label="Offer deliver document (< 1kg package):"
                                            label-align-sm="right" class="mb-0"
                                        >
                                            <b-form-radio-group
                                                class="pt-2"
                                                :options="['Yes', 'No']" name="deliverDocument"
                                                v-validate="'required|alpha|max:3'"
                                                v-model="stepTwo.deliverDocument">
                                            </b-form-radio-group>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <span
                                                        class="text-danger">{{errors.first('deliverDocument')}}</span>
                                                </div>
                                            </div>
                                        </b-form-group>

                                        <b-form-group
                                            label-cols-sm="3"
                                            label="Price per document package (< 1kg):"
                                            label-align-sm="right"
                                            label-for="price_per_document"
                                        >
                                            <b-input-group append="EUR">
                                                <b-form-input id="price_per_document" name="priceDocument"
                                                              v-model="stepTwo.priceDocument"
                                                              v-validate="'required|numeric'">
                                                </b-form-input>
                                            </b-input-group>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <span
                                                        class="text-danger">{{errors.first('priceDocument')}}</span>
                                                </div>
                                            </div>
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
                                        <b-button v-on:click="saveCurrentStep(2,3)"
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
                                        Some customers only want to deliver light weight documents, help them by offer
                                        delivering documents :)
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

                                        <b-form-group
                                            label-cols-sm="3"
                                            label="Discount for customer:"
                                            label-align-sm="right"
                                            label-for="discount"
                                        >
                                            <b-input-group append="%">
                                                <b-form-input id="discount" name="discount"
                                                              v-model="stepThree.discount"
                                                              v-validate="'numeric'">
                                                </b-form-input>
                                            </b-input-group>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <span
                                                        class="text-danger">{{errors.first('discount')}}</span>
                                                </div>
                                            </div>
                                        </b-form-group>


                                        <b-form-group label="Do you accept deliver this kind of items ?">
                                            <b-form-checkbox-group
                                                :options="allowedItems"
                                                v-model="stepThree.allowedItems"
                                                switches
                                            ></b-form-checkbox-group>
                                        </b-form-group>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <span class="text-danger">{{errors.first('allowedItem')}}</span>
                                            </div>
                                        </div>
                                        <b-form-textarea
                                            id="textarea"
                                            placeholder="Some important note to customer before they contact you..."
                                            rows="15"
                                            max-rows="25"
                                            v-validate="'required'"
                                            name="shipmentNote" v-model="stepThree.shipmentNote">
                                            >
                                        </b-form-textarea>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <span class="text-danger">{{errors.first('shipmentNote')}}</span>
                                            </div>
                                        </div>
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
                                    <b-card-text class="text-left">
                                        <p>Check out the baggage allowance of your flight brand and the country you are
                                            traveling to.
                                            It is really helpful to people that you dont deliver those prohibited
                                            items.</p>

                                        <p>Do you want to give discount to first customer? Specify how many percent the
                                            will get.</p>
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
                                <h3>Valuables</h3>
                                We recommend that you do not pack valuable items in checked baggage.

                                <h3>What Not To Pack In Checked Baggage</h3>
                                We recommend that all portable electronic devices are placed in your carry-on baggage,
                                but if you need to place them in your checked baggage, you must make sure that they are
                                fully switched off and not in sleep or hibernate mode.

                                Electronic cigarettes/vapes, spare batteries and portable power supplies (power banks)
                                must not be packed in your checked baggage.

                                Some items such as gas canisters, lighters, fireworks, bleaches etc. cannot be carried
                                in checked baggage. If you are concerned that something that you wish to pack may not be
                                allowed, check with your airline. Items that are considered to be too dangerous for
                                checked baggage will be removed and probably not returned to you.
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
                                        Some people ask to deliver white powder. Some medicine are in form of white
                                        powder, but it could be drug as well.
                                        If you are not sure, DON'T deliver it.
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
                                        Publish shipment<i class="fa fa-chevron-right ml-2"></i>
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
                                        Review your shipment information before publishing.
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
    // custom validation message
    const dict = {
        custom: {
            flightFrom: {
                required: 'Where are your flight from?',
                min: 'First name should have at least 2 letters!'
            },
            flightTo: {
                required: 'Where are you flying to?',
                min: 'Last name should have at least 2 letters!'
            },
            flightDate: {
                required: 'Kindly choose your flight date!',
                date_format: 'Date format is dd/mm/yyyy, such as 20/12/2000',
                before: 'The flight date must before the delivery date'
            },
            expectedDeliveryDate: {
                required: 'Kindly enter your expected delivery date!',
                date_format: 'Date format is dd/mm/yyyy, such as 20/12/2000'
            },
            availableWeight: {
                required: 'How much free space you can share with other friends ?',
                numeric: 'This should be number',
                max: 'It is unreasonable that you can deliver >= 1000 kg',
            },
            currency: {
                required: 'Kindly choose your preferable currency!',
                alpha: 'Kindly choose your supported currency!',
                length: 'Kindly choose your supported currency!',
            },
            price: {
                required: 'How much do you charge per 1 kg ?',
                numeric: 'Price should be number',
            },
            homePickup: {
                required: 'Please choose yes or no :)',
                alpha: 'This field should be letter only!',
                length: 'This field should not exceed 3 characters!'
            },
            deliverDocument: {
                required: 'Please choose yes or no :)',
                alpha: 'This field should be letter only!',
                length: 'This field should not exceed 3 characters!'
            },
            priceDocument: {
                required: 'How much do you charge per package < 1 kg ?',
                numeric: 'Price should be number',
            },

            discount: {
                numeric: 'Discount should be number',
            },
            shipmentNote: {
                required: 'Please tell something about your shipment ( requirement,...)'
            },
        }
    };

    export default {
        name: "list",
        components: {},
        data() {
            return {
                date: new Date(),
                dateOptions: {
                    format: 'DD/MM/YYYY',
                    useCurrent: false,
                },

                allowedCurrency: {
                    usd: 'USD',
                    eur: 'EUR',
                    vnd: 'VND'
                },
                // 5 steps
                steps: {
                    1: true,
                    2: false,
                    3: false,
                    4: false,
                    5: false,
                },

                progressValue: 20,
                progressMax: 100,

                allowedItems: [
                    {value: 'laptop', text: 'Laptop'},
                    {value: 'food', text: 'Food'},
                    {value: 'alcohol', text: 'Alcohol'},
                    {value: 'lithium_devices', text: 'Lithium Devices'}
                ],

                stepOne: {
                    flightFrom: 'Munich',
                    flightTo: 'Hanoi',
                    flightDate: '',
                    expectedDeliveryDate: '',
                },

                stepTwo: {
                    availableWeight: null,
                    currency: 'eur',
                    price: 7,
                    homePickup: '',
                    deliverDocument: '',
                    priceDocument: 5
                },
                stepThree: {
                    discount: 20,
                    allowedItems: [],
                    shipmentNote: 'some note'
                },
            }
        },
        methods: {
            nextStep: function (currentStep, nextStep) {
                this.steps[currentStep] = false;
                this.steps[nextStep] = true;
                this.progressValue += 20;
            },

            previousStep: function (currentStep, lastStep) {
                this.steps[currentStep] = false;
                this.steps[lastStep] = true;
                this.progressValue -= 20;
            },

            saveCurrentStep: function (currentStep, nextStep) {
                if (currentStep === 1) {
                    let postUrl = 'shipment/add-step-one';
                    let postData = this.stepOne;
                }

                if (currentStep === 2) {
                    let postUrl = 'shipment/add-step-two';
                    let postData = this.stepTwo;
                }

                if (currentStep === 3) {
                    let postUrl = 'shipment/add-step-three';
                    let postData = this.stepThree;
                }

                // stepOneForm
                this.$validator.validateAll().then((result) => {
                    if (result == true) {
                        this.$http.post(postUrl, postData).then(function (data) {
                            this.nextStep(currentStep, nextStep);
                            return;
                        }).catch(function (res) {
                            if (!res.ok) {
                                this.errorMsg = res.body.message;
                            }
                        });
                    }
                });
            },

            // to display suffix currency Name
            getCurrencyName: function (currencyCode) {
                if (currencyCode in this.allowedCurrency) {
                    return this.allowedCurrency.currencyCode
                }
                return null
            }
        },
        created: function () {
            // enable custom validation message
            this.$validator.localize('en', dict);
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
