<template>
    <div class="min-height-1000 m-4">
        <b-alert dismissible variant="danger" v-model="showErrorMsg">{{errorMsg}}</b-alert>
        <b-tabs ref="tabid" v-model="tabIndex" content-class="mt-3" align="center" activate-tab>
            <b-tab title="Step 1: Destination" :title-link-class="linkClass(0)">
                <div class="row" id="add_list_step_1" v-if="shipmentData.step_1 != null && tabIndex === 0">
                    <div class="col-lg-12">
                        <div class="row mb-3 text-center">
                            <div class="col-lg-5 offset-lg-2">
                                <h3>Where are you flying to ?</h3>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-5 offset-lg-2">
                                <b-card bg-variant="light">
                                    <div class="form-group row">
                                        <label for="flight_from" class="col-sm-3 col-form-label text-right">
                                            From: <span style="color: Tomato;"><i
                                            class="fas fa-plane-departure"></i></span>
                                        </label>
                                        <div class="col-sm-9">
                                            <input id="flight_from" name="flightFrom"
                                                   v-model="shipmentData.step_1.flightFrom"
                                                   v-validate="'required|alpha_spaces'" class="form-control">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <span class="text-danger">{{errors.first('flightFrom')}}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="flight_to" class="col-sm-3 col-form-label text-right">
                                            To: <span style="color: Tomato;"><i
                                            class="fas fa-plane-arrival"></i></span>
                                        </label>
                                        <div class="col-sm-9">
                                            <input id="flight_to" name="flightTo"
                                                   v-model="shipmentData.step_1.flightTo"
                                                   v-validate="'required|alpha_spaces'" class="form-control">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <span class="text-danger">{{errors.first('flightTo')}}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label text-right">
                                            Flight date: <span style="color: Tomato;"><i
                                            class="fas fa-calendar-alt"></i></span>
                                        </label>
                                        <div class="col-sm-9">
                                            <date-picker id="flight_date" name="flightDate"
                                                         ref="flightDate"
                                                         v-model="shipmentData.step_1.flightDate"
                                                         :config="dateOptions"
                                                         v-validate="'required|date_format:dd/MM/yyyy'">
                                            </date-picker>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                            <span
                                                                class="text-danger">{{errors.first('flightDate')}}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label text-right">
                                            Expected delivery date: <span style="color: Tomato;"><i
                                            class="fas fa-calendar-alt"></i></span>
                                        </label>
                                        <div class="col-sm-9">
                                            <date-picker id="expected_delivery_date" name="expectedDeliveryDate"
                                                         v-model="shipmentData.step_1.expectedDeliveryDate"
                                                         :config="dateOptions"
                                                         v-validate="'required|date_format:dd/MM/yyyy|after:flightDate'">
                                            </date-picker>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <span
                                                        class="text-danger">{{errors.first('expectedDeliveryDate')}}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </b-card>

                                <div class="mb-auto mt-5 row text-center">
                                    <div class="col-lg-5 text-center py-2">
                                        <b-link href="/" class="back_link">
                                            <i class="fa fa-chevron-left mr-2"></i>Cancel
                                        </b-link>
                                    </div>
                                    <div class="col-lg-7 text-center">
                                        <b-button v-on:click="nextStep()"
                                                  class="btn btn-pill align-self-center" size="lg"
                                                  variant="info">
                                            Next<i class="fa fa-chevron-right ml-2"></i>
                                        </b-button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="col-lg-12 text-center">
                                    <div class="card" style="width: 18rem;">
                                        <div class="card-body">
                                            <h5 class="card-title">Tips <span> <i class="fas fa-info-circle"></i></span>
                                            </h5>
                                            <p class="card-text">Estimate the date you will deliver the package after
                                                you arrive to the
                                                destination city.
                                                This will be very useful for the customer.
                                                I.e: average delivery time in Hanoi is 2-3 days</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </b-tab>

            <b-tab title="Step 2: Shipping Information" :title-link-class="linkClass(1)">
                <div class="row" id="add_list_step_2" v-if="shipmentData.step_2 != null && tabIndex === 1">
                    <div class="col-lg-12">
                        <div class="row mb-3 text-center">
                            <div class="col-lg-5 offset-lg-2">
                                <h3>Shipment setting</h3>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-5 offset-lg-2">
                                <b-card bg-variant="light">
                                    <div class="form-group row">
                                        <label for="available_weight" class="col-sm-4 col-form-label text-right">
                                            Available weight: <span style="color: Tomato;"><i
                                            class="fas fa-balance-scale"></i></span>
                                        </label>
                                        <div class="col-sm-8">
                                            <input id="available_weight" name="availableWeight"
                                                   v-model="shipmentData.step_2.availableWeight"
                                                   v-validate="'required|numeric|max:3'" class="form-control">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <span class="text-danger">{{errors.first('availableWeight')}}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="currency" class="col-sm-4 col-form-label text-right">
                                            Payment currency: <span style="color: Tomato;"><i
                                            class="fas fa-money-bill-wave"></i></span>
                                        </label>
                                        <div class="row col-sm-6">
                                            <div class="col-sm-6">
                                                <b-form-select slot="prepend"
                                                               class="mb-2 mr-sm-2 mb-sm-0"
                                                               :options="allowedCurrency"
                                                               id="currency"
                                                               name="currency"
                                                               v-model="shipmentData.step_2.currency"
                                                               v-validate="'required|alpha|length:3'">

                                                    <option slot="first" :value="null">Currency</option>
                                                </b-form-select>
                                            </div>
                                        </div>
                                        <div class="row col-sm-12">
                                            <div class="col-lg-7 offset-lg-4">
                                                <span class="text-danger">{{errors.first('currency')}}</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label text-right">
                                            Price per kg: <span style="color: Tomato;"><i
                                            class="fas fa-hand-holding-usd"></i></span>
                                        </label>
                                        <div class="col-sm-8">
                                            <b-input-group :append="getCurrencyName(shipmentData.step_2.currency)">
                                                <b-form-input id="price_per_kg" name="price"
                                                              v-model="shipmentData.step_2.price"
                                                              v-validate="'required|numeric'">

                                                </b-form-input>
                                            </b-input-group>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <span class="text-danger">{{errors.first('price')}}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label text-right">
                                            Home pickup: <span style="color: Tomato;"><i
                                            class="fas fa-dolly"></i></span>
                                        </label>
                                        <div class="col-sm-8">
                                            <b-form-radio-group
                                                class="pt-2"
                                                :options="['Yes', 'No']" name="homePickup"
                                                v-model="shipmentData.step_2.homePickup"
                                                v-validate="'required|alpha|max:3'">
                                            </b-form-radio-group>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <span class="text-danger">{{errors.first('homePickup')}}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label text-right">
                                            Deliver document? <br>(<= 1kg): <span style="color: Tomato;"><i
                                            class="fas fa-envelope-open-text"></i></span>
                                        </label>
                                        <div class="col-sm-8">
                                            <b-form-radio-group
                                                class="pt-2"
                                                :options="['Yes', 'No']" name="deliverDocument"
                                                v-validate="'required|alpha|max:3'"
                                                v-model="shipmentData.step_2.deliverDocument">
                                            </b-form-radio-group>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <span class="text-danger">{{errors.first('deliverDocument')}}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label text-right">
                                            Document package price<br>(<= 1kg): <span style="color: Tomato;"><i
                                            class="fas fa-hand-holding-usd"></i></span>
                                        </label>
                                        <div class="col-sm-8">
                                            <div class="input-group">
                                                <input type="text" class="form-control" id="price_per_document"
                                                       name="priceDocument"
                                                       v-model="shipmentData.step_2.priceDocument"
                                                       v-validate="'required|numeric'">

                                                <div class="input-group-append">
                                                    <span class="input-group-text text-uppercase">{{shipmentData.step_2.currency}}</span>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <span class="text-danger">{{errors.first('priceDocument')}}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </b-card>

                                <div class="mb-auto mt-5 row text-center">
                                    <div class="col-lg-5 py-2">
                                        <b-link href="#" class="back_link"
                                                v-on:click="previousStep()">
                                            <i class="fa fa-chevron-left mr-2"></i>Back
                                        </b-link>
                                    </div>
                                    <div class="col-lg-7">
                                        <b-button v-on:click="nextStep()"
                                                  class="btn btn-pill align-self-center" size="lg"
                                                  variant="info">
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
                                            Some customers only want to deliver light weight documents, help them by
                                            offer
                                            delivering documents :)
                                        </b-card-text>
                                    </b-card>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </b-tab>

            <b-tab title="Step 3: Shipment requirement" :title-link-class="linkClass(2)">
                <div class="row" id="add_list_step_3" v-if="shipmentData.step_3 != null && tabIndex === 2">
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
                                            label-cols-sm="3"
                                            label="Discount for customer:"
                                            label-align-sm="right"
                                            label-for="discount"
                                        >
                                            <b-input-group append="%">
                                                <b-form-input id="discount" name="discount"
                                                              v-model="shipmentData.step_3.discount"
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
                                                v-model="shipmentData.step_3.allowedItems"
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
                                            name="shipmentNote" v-model="shipmentData.step_3.shipmentNote">
                                            >
                                        </b-form-textarea>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <span class="text-danger">{{errors.first('shipmentNote')}}</span>
                                            </div>
                                        </div>
                                    </b-card>

                                    <div class="mb-auto mt-5 row text-center">
                                        <div class="col-lg-5 py-2">
                                            <b-link href="#" class="back_link"
                                                    v-on:click="previousStep()">
                                                <i class="fa fa-chevron-left mr-2"></i>Back
                                            </b-link>
                                        </div>
                                        <div class="col-lg-7">
                                            <b-button v-on:click="nextStep()"
                                                      class="btn btn-pill align-self-center" size="lg"
                                                      variant="info">
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
                                            <p>Check out the baggage allowance of your flight brand and the country
                                                you are
                                                traveling to.
                                                It is really helpful to people that you dont deliver those
                                                prohibited
                                                items.</p>

                                            <p>Do you want to give discount to first customer? Specify how many
                                                percent the
                                                will get.</p>
                                        </b-card-text>
                                    </b-card>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </b-tab>

            <b-tab title="Step 4: Baggage law" :title-link-class="linkClass(3)">
                <div class="row" id="add_list_step_4" v-if="tabIndex === 3">
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
                                    We recommend that all portable electronic devices are placed in your carry-on
                                    baggage,
                                    but if you need to place them in your checked baggage, you must make sure that
                                    they are
                                    fully switched off and not in sleep or hibernate mode.

                                    Electronic cigarettes/vapes, spare batteries and portable power supplies (power
                                    banks)
                                    must not be packed in your checked baggage.

                                    Some items such as gas canisters, lighters, fireworks, bleaches etc. cannot be
                                    carried
                                    in checked baggage. If you are concerned that something that you wish to pack
                                    may not be
                                    allowed, check with your airline. Items that are considered to be too dangerous
                                    for
                                    checked baggage will be removed and probably not returned to you.
                                    For additional information please see the Dangerous Goods page.
                                </b-card>
                                <div class="mb-auto mt-5 row text-center">
                                    <div class="col-lg-5 py-2">
                                        <b-link href="#" class="back_link"
                                                v-on:click="previousStep()">
                                            <i class="fa fa-chevron-left mr-2"></i>Back
                                        </b-link>
                                    </div>
                                    <div class="col-lg-7">
                                        <b-button v-on:click="nextStep()"
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
                                            Some people ask to deliver white powder. Some medicine are in form of
                                            white
                                            powder, but it could be drug as well.
                                            If you are not sure, DON'T deliver it.
                                        </b-card-text>
                                    </b-card>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </b-tab>

            <b-tab title="Step 5: Check your advertisement" :title-link-class="linkClass(4)">
                <div class="row" id="add_list_step_5" v-if="tabIndex === 4">
                    <div class="col-lg-8 offset-lg-2 container">
                        <div class="row text-center">
                            <div class="col-lg-12 py-5 text-center">
                                <h2>Lets review your shipment before publishing</h2>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-5 order-md-2 mb-4">
                                <h4 class="d-flex justify-content-between align-items-center mb-3">
                                    <span class="text-muted">Expected Earning</span>
                                </h4>
                                <ul class="list-group mb-3">
                                    <li class="list-group-item d-flex justify-content-between lh-condensed">
                                        <div>
                                            <h6 class="my-0">Shipment price</h6>
                                            <small class="text-muted">Total weight: 5kg</small>
                                        </div>
                                        <span class="text-muted">$7 * 5 = $35</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between lh-condensed">
                                        <div>
                                            <h6 class="my-0">Brief</h6>
                                            <small class="text-muted">Quantity: 2</small>
                                        </div>
                                        <span class="text-muted">$5 * 2 = $10</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between bg-light">
                                        <div class="text-success">
                                            <h6 class="my-0">Redeem code</h6>
                                            <small>black19</small>
                                        </div>
                                        <span class="text-success">-$5</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between">
                                        <span>Total (VAT included)</span>
                                        <strong>$40</strong>
                                    </li>
                                </ul>

                                <form class="card p-2">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Promo code">
                                        <div class="input-group-append">
                                            <button type="submit" class="btn btn-secondary btn-info">Redeem</button>
                                        </div>
                                    </div>

                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="black19">
                                        <div class="input-group-append">
                                            <button type="submit" class="btn btn-secondary btn-default">Remove</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="col-lg-7 order-md-1">
                                <h4 class="mb-3"><span class="text-muted">Shipment detail</span></h4>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="firstName">From</label>
                                        <input type="text" class="form-control" id="firstName" placeholder="Munchen"
                                               disabled>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="lastName">To</label>
                                        <input type="text" class="form-control" id="lastName" placeholder="Hanoi"
                                               disabled>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label>Flight Date</label>
                                        <input type="email" class="form-control" placeholder="15.10.2019" disabled>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label>Expected Delivery Date</label>
                                        <input type="email" class="form-control" placeholder="20.10.2019" disabled>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="address">Street, House Number</label>
                                    <input type="text" class="form-control" id="address" placeholder="Kazbockstrasse 21"
                                           disabled>
                                </div>

                                <div class="row">
                                    <div class="col-md-4 mb-3">
                                        <label for="zip">Zip</label>
                                        <input type="text" class="form-control" placeholder="86157" id="zip" disabled>
                                    </div>

                                    <div class="col-md-8 mb-3">
                                        <label for="country">Country</label>
                                        <input type="text" class="form-control" id="country"
                                               placeholder="Hanoi, Vietnam" disabled>
                                    </div>
                                </div>

                                <hr class="mb-4">

                                <div class="row">
                                    <div class="col-md-6">
                                        <span style="color: Tomato;"><i class="fas fa-drumstick-bite"></i></span>
                                        Allow deliver food
                                        <span style="color: #28a745;"><i class="fas fa-check-square"></i></span>
                                    </div>
                                    <div class="col-md-6">
                                        <span style="color: Tomato;"><i class="fas fa-laptop"></i></span>
                                        Allow deliver laptop
                                        <span style="color: #28a745;"><i class="fas fa-check-square"></i></span>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <span style="color: Tomato;"><i class="fas fa-wine-bottle"></i></span>
                                        Allow deliver alcohol
                                        <span style="color: #28a745;"><i class="fas fa-check-square"></i></span>
                                    </div>

                                    <div class="col-md-6">
                                        <span style="color: Tomato;"><i class="fas fa-tablet"></i></span>
                                        Allow deliver lithium devices
                                        <span style="color: #28a745;"><i class="fas fa-check-square"></i></span>
                                    </div>
                                </div>

                                <hr class="mb-4">

                                <h4 class="mb-3">Accept Payment</h4>

                                <div class="d-block my-3">
                                    <div class="custom-control custom-radio">
                                        <input id="credit" name="paymentMethod" type="radio"
                                               class="custom-control-input" checked="" required="">
                                        <label class="custom-control-label" for="credit">Credit card</label>
                                    </div>
                                    <div class="custom-control custom-radio">
                                        <input id="debit" name="paymentMethod" type="radio"
                                               class="custom-control-input" required="">
                                        <label class="custom-control-label" for="debit">Debit card</label>
                                    </div>
                                    <div class="custom-control custom-radio">
                                        <input id="paypal" name="paymentMethod" type="radio"
                                               class="custom-control-input" required="">
                                        <label class="custom-control-label" for="paypal">Paypal</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="mb-auto row text-center">
                                    <div class="col-lg-5 py-2">
                                        <b-link href="#" class="back_link"
                                                v-on:click="previousStep()">
                                            <i class="fa fa-chevron-left mr-2"></i>Back
                                        </b-link>
                                    </div>
                                    <div class="col-lg-7">
                                        <b-button v-on:click="publish()"
                                                  class="btn btn-pill align-self-center" size="lg" variant="info">
                                            Publish shipment<i class="fa fa-chevron-right ml-2"></i>
                                        </b-button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </b-tab>
        </b-tabs>
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
                shipmentId: '',
                date: new Date(),
                dateOptions: {
                    format: 'YYYY/MM/DD',
                    useCurrent: false,
                },

                allowedSteps: [0, 1, 2, 3, 4],

                allowedCurrency: {
                    usd: 'USD',
                    eur: 'EUR',
                    vnd: 'VND'
                },

                // progressValue: 20,
                progressMax: 100,

                allowedItems: [
                    {value: 'laptop', text: 'Laptop'},
                    {value: 'food', text: 'Food'},
                    {value: 'alcohol', text: 'Alcohol'},
                    {value: 'lithium_devices', text: 'Lithium Devices'}
                ],

                shipmentData: {
                    step_1: null,
                    step_2: null,
                    step_3: null
                },
                errorMsg: '',
                showErrorMsg: false,
                tabIndex: 0
            }
        },
        methods: {
            updateRoute() {
                this.$router.push({path: `/become-a-shipper/step/${this.tabIndex}/ad/${this.shipmentId}`});
            },

            nextStep: function () {
                this.saveCurrentStep();
                this.tabIndex++;
                this.updateRoute();
            },

            previousStep: function () {
                this.tabIndex--;
                this.updateRoute();
            },

            saveCurrentStep: function () {
                if (this.shipmentId === '' || this.shipmentId === undefined) {
                    return;
                }

                var postUrl = `become-a-shipper/save/${this.tabIndex}`;
                var postData = {};
                if (this.tabIndex === 0) {
                    postData = this.shipmentData.step_1;
                } else if (this.tabIndex === 1) {
                    postData = this.shipmentData.step_2;
                } else if (this.tabIndex === 2) {
                    postData = this.shipmentData.step_3;
                } else {
                    return;
                }

                postData.adId = this.shipmentId;

                this.$validator.validateAll().then((validateResult) => {
                    if (validateResult === true) {
                        this.$http.post(postUrl, postData).then(function (res) {
                            // TODO: what to do in this case
                        }).catch(function (res) {
                            if (!res.ok) {
                                this.showErrorMessage('Something wrong happened!');
                            }
                        });
                    }
                });
            },


            // todo: check if this work
            // to display suffix currency Name
            getCurrencyName: function (currencyCode) {
                if (currencyCode in this.allowedCurrency) {
                    return this.allowedCurrency.currencyCode;
                    // return this.allowedCurrency[currencyCode];
                }
                return null;
            },

            getAdData: function (adId) {
                let loader = this.$loading.show({
                    container: this.$refs.formContainer,
                });

                if (adId === undefined || adId === '') {
                    return;
                }
                var postParam = {adId: adId};

                this.$http.post(`get-shipment`, postParam).then(function (res) {
                    if (res.status === 200) {
                        if (res.body.id !== undefined) {
                            this.shipmentId = res.body.id;
                        }
                        this.shipmentData = res.body.data;
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

            getStepOneData: function () {
                let loader = this.$loading.show({
                    container: this.$refs.formContainer,
                });
                this.$http.post(`get-step-one`).then(function (res) {
                    if (res.status === 200) {
                        if (res.body.id !== undefined) {
                            this.shipmentId = res.body.id;
                        }
                        this.shipmentData = res.body.data;
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

            publish: function () {
                let loader = this.$loading.show({
                    container: this.$refs.formContainer,
                });

                if (this.shipmentId === '' || this.shipmentId === undefined) {
                    return;
                }
                var postData = {
                    ...this.shipmentData.step_1,
                    ...this.shipmentData.step_2,
                    ...this.shipmentData.step_3
                };
                postData.adId = this.shipmentId;

                this.$http.post(`become-a-shipper/publish/`, postData).then(function (res) {
                    if (res.status === 200) {
                        this.shipmentData = res.body.data;
                    }
                    loader.hide();
                }).catch(function (res) {
                    loader.hide();
                    if (!res.ok) {
                        this.showErrorMessage('Can not publish shipment!');
                    }
                });
            },

            linkClass(index) {
                this.updateRoute();
                if (this.tabIndex === index) {
                    return ['bg-primary', 'text-white']
                } else {
                    return ['bg-light', 'text-black-50']
                }
            },

            showErrorMessage: function (message) {
                this.showErrorMsg = true;
                this.errorMsg = message;
            }
        },

        created: function () {
            this.shipmentId = this.$route.params.adId;
            this.tabIndex = parseInt(this.$route.params.stepNo);

            // enable custom validation message
            this.$validator.localize('en', dict);

            // get stepone data
            if (this.tabIndex === 0 && this.shipmentId === undefined || this.shipmentId === '') {
                this.getStepOneData();
            }

            // initialize data
            if (this.allowedSteps.includes(this.tabIndex)) {
                this.getAdData(this.shipmentId);
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
