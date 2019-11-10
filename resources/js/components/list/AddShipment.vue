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
            <b-alert dismissible variant="danger" v-model="showErrorMsg">{{errorMsg}}</b-alert>

            <div class="row" id="add_list_step_1" v-if="stepone != null && steps['stepone']">
                <div class="col-lg-12">
                    <div class="row mb-3 text-center">
                        <div class="col-lg-5 offset-lg-2">
                            <h3>Where are you flying to ?</h3>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-5 offset-lg-2">
                            <b-form ref="steponeForm">
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
                                                          v-model="stepone.flightFrom"
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
                                            <b-form-input id="flight_to" name="flightTo" v-model="stepone.flightTo"
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
                                                         ref="flightDate"
                                                         v-model="stepone.flightDate" :config="dateOptions"
                                                         v-validate="'required|date_format:dd/MM/yyyy'">
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
                                                         v-model="stepone.expectedDeliveryDate" :config="dateOptions"
                                                         v-validate="'required|date_format:dd/MM/yyyy|after:flightDate'">
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
                                        <b-button v-on:click="saveCurrentStep('stepone','steptwo')"
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

            <div class="row" id="add_list_step_2" v-if="steptwo != null && steps['steptwo']">
                <div class="col-lg-12">
                    <div class="row mb-3 text-center">
                        <div class="col-lg-5 offset-lg-2">
                            <h3>Shipment setting</h3>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-5 offset-lg-2">
                            <b-form ref="steptwoForm">
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
                                                              v-model="steptwo.availableWeight"
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
                                                               name="currency" v-model="steptwo.currency"
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
                                            <b-input-group :append="getCurrencyName(steptwo.currency)">
                                                <b-form-input id="price_per_kg" name="price" v-model="steptwo.price"
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
                                                :options="['Yes', 'No']" name="homePickup" v-model="steptwo.homePickup"
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
                                                v-model="steptwo.deliverDocument">
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
                                                              v-model="steptwo.priceDocument"
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
                                        <b-link href="#" class="back_link"
                                                v-on:click="previousStep('steptwo','stepone')">
                                            <i class="fa fa-chevron-left mr-2"></i>Back
                                        </b-link>
                                    </div>
                                    <div class="col-lg-7">
                                        <b-button v-on:click="saveCurrentStep('steptwo','stepthree')"
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

            <div class="row" id="add_list_step_3" v-if="stepthree != null && steps['stepthree']">
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
                                                              v-model="stepthree.discount"
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
                                                v-model="stepthree.allowedItems"
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
                                            name="shipmentNote" v-model="stepthree.shipmentNote">
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
                                        <b-link href="#" class="back_link"
                                                v-on:click="previousStep('stepthree', 'steptwo')">
                                            <i class="fa fa-chevron-left mr-2"></i>Back
                                        </b-link>
                                    </div>
                                    <div class="col-lg-7">
                                        <b-button v-on:click="saveCurrentStep('stepthree', 'stepfour')"
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

            <div class="row" id="add_list_step_4" v-if="steps['stepfour']">
                <div class="col-lg-12">
                    <div class="row mb-3 text-center">
                        <div class="col-lg-5 offset-lg-2">
                            <h3>Baggage rule on international flight</h3>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-5 offset-lg-2">
                            <b-card bg-variant="light">
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
                                    <b-link href="#" class="back_link"
                                            v-on:click="previousStep('stepfour', 'stepthree')">
                                        <i class="fa fa-chevron-left mr-2"></i>Back
                                    </b-link>
                                </div>
                                <div class="col-lg-7">
                                    <b-button v-on:click="nextStep('stepfour', 'stepfive')"
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

            <div class="row" id="add_list_step_5" v-if="steps['stepfive']">
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
                                    <b-link href="#" class="back_link"
                                            v-on:click="previousStep('stepfive', 'stepfour')">
                                        <i class="fa fa-chevron-left mr-2"></i>Back
                                    </b-link>
                                </div>
                                <div class="col-lg-7">
                                    <b-button  v-on:click="publish()"
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
    import * as router from "vue-router";

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

            /*TODO : ALLOWED ITEMS VALIDATION*/

            discount: {
                numeric: 'Discount should be number',
            },
            shipmentNote: {
                required: 'Please tell something about your shipment ( requirement,...)'
            },
        }
    };

    export default {
        name: "add-shipment",
        components: {},
        data() {
            return {
                // shipmentId: this.$route.params.id,
                shipmentId: '',
                date: new Date(),
                dateOptions: {
                    format: 'DD/MM/YYYY',
                    useCurrent: false,
                },

                allowedSteps: ["stepone", "steptwo", "stepthree", "stepfive"],

                allowedCurrency: {
                    usd: 'USD',
                    eur: 'EUR',
                    vnd: 'VND'
                },
                // 5 steps
                steps: {
                    'stepone': false,
                    'steptwo': false,
                    'stepthree': false,
                    'stepfour': false,
                    'stepfive': false,
                },

                progressValue: 20,
                progressMax: 100,

                allowedItems: [
                    {value: 'laptop', text: 'Laptop'},
                    {value: 'food', text: 'Food'},
                    {value: 'alcohol', text: 'Alcohol'},
                    {value: 'lithium_devices', text: 'Lithium Devices'}
                ],

                stepone: null,
                steptwo: null,
                stepthree: null,
                shipmentData: null,
                errorMsg: '',
                showErrorMsg: false,
            }
        },
        methods: {
            nextStep: function (currentStep, nextStep) {
                if (nextStep !== 'stepfour' || nextStep !== 'stepfive') {
                    if (this.stepone === null || this.steptwo === null || this.stepthree === null) {
                        this.getStepXData(nextStep, this.shipmentId);
                    }
                }

                this.steps[currentStep] = false;
                this.steps[nextStep] = true;
                this.progressValue += 20;
                this.$router.push({path: `/become-a-shipper/${nextStep}/ad/${this.shipmentId}`});
            },

            previousStep: function (currentStep, lastStep) {
                this.steps[currentStep] = false;
                this.steps[lastStep] = true;
                this.progressValue -= 20;
                this.$router.push({path: `/become-a-shipper/${lastStep}/ad/${this.shipmentId}`});
            },

            saveCurrentStep: function (currentStep, nextStep) {
                const postUrl = `become-a-shipper/${currentStep}`;
                const postData = this[currentStep];
                if (this.shipmentId !== '') {
                    postData.adId = this.shipmentId
                }

                this.$validator.validateAll().then((validateResult) => {
                    if (validateResult === true) {
                        this.$http.post(postUrl, postData).then(function (res) {
                            if (res.status === 200) {
                                this.shipmentId = res.body.id;
                                this.nextStep(currentStep, nextStep);
                            }
                        }).catch(function (res) {
                            if (!res.ok) {
                                this.errorMsg = 'Something wrong happened!'
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
                return null;
            },

            getStepXData: function (stepNo, adId) {
                var postParam = {};
                if (adId !== undefined) {
                    postParam = {adId: adId};
                }

                if (postParam !== undefined) {
                    postParam.step = stepNo;
                }

                if (stepNo === 'stepfive') {
                    this.getFinalStep();
                } else {
                    this.$http.post(`get-shipment/${stepNo}/`, postParam).then(function (res) {
                        if (res.status === 200) {
                            if (res.body.id !== undefined) {
                                this.shipmentId = res.body.id;
                                this.$router.push({path: `/become-a-shipper/${stepNo}/ad/${this.shipmentId}`});
                            }
                            this[stepNo] = res.body.data;
                        } else {
                            this.errorMsg = res.body.msg;
                        }
                    }).catch(function (res) {
                        if (!res.ok) {
                            this.errorMsg = 'Something wrong happened!';
                        }
                    });
                }

            },

            getFinalStep: function () {
                var postParam = {
                    adId: this.shipmentId,
                    step: 'stepfive'
                };

                this.$http.post(`get-shipment/stepfive/`, postParam).then(function (res) {
                    if (res.status === 200) {
                        this.shipmentData = res.body.data;
                    } else {
                        this.errorMsg = res.body.msg;
                    }
                }).catch(function (res) {
                    if (!res.ok) {
                        this.errorMsg = 'Something wrong happened!';
                    }
                });
            },

            publish: function () {
                var postParam = {adId: this.shipmentId};

                this.$http.post(`get-shipment/publish/`, postParam).then(function (res) {
                    if (res.status === 200) {
                        this.shipmentData = res.body.data;
                    }
                }).catch(function (res) {
                    if (!res.ok) {
                        this.showErrorMsg = true;
                        this.errorMsg = res.body.msg;
                    }
                });
            },
        },
        created: function () {
            this.shipmentId = this.$route.params.adId;
            let stepNo = this.$route.params.stepNo;     // step id is string

            // toggle to display step page
            this.steps = _.mapValues(this.steps, () => false);
            this.steps[stepNo] = true;

            // enable custom validation message
            this.$validator.localize('en', dict);
            if (this.allowedSteps.includes(stepNo)) {
                this.getStepXData(stepNo, this.shipmentId);
            }

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
