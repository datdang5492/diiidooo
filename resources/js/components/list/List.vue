<template>
    <div class="section listing min-height-normal">
        <h3 class="section-title text-center m-5">
            Munich <span><i class="fas fa-plane-departure"></i></span> Hanoi,
            {{filter.expected_delivery_date | moment("DD.MM.YYYY")}}
        </h3>
        <div class="container text-center">
            <b-dropdown v-on:click="sortShipment(0)" id="datetimeDropdown" text="Sort" class="m-md-2" pill
                        variant="outline-secondary">
                <b-dropdown-item v-for="option of sortOptions"
                                 v-bind:key="option.key"
                                 v-on:click="sortShipment(option.key)"
                                 :active="option.key === activeSort">
                    {{option.value}}
                </b-dropdown-item>
            </b-dropdown>

            <b-button v-b-toggle.expectedDeliveryDate variant="outline-secondary">
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
                                <input class="form-control" name="minPrice" v-validate="'numeric'"
                                       v-model="filter.min_price">
                            </b-input-group>
                            <div class="row">
                                <div class="col-lg-12">
                                    <span class="text-danger">{{errors.first('minPrice')}}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <label>Max price</label>
                            <b-input-group prepend="$">
                                <input class="form-control" name="maxPrice" v-validate="'numeric'"
                                       v-model="filter.max_price">
                            </b-input-group>
                            <div class="row">
                                <div class="col-lg-12">
                                    <span class="text-danger">{{errors.first('maxPrice')}}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-4" v-show="this.filter.min_price || this.filter.max_price">
                        <div class="col-lg-12 text-right">
                            <b-button v-on:click="submitPriceFilter()" variant="outline-success">Apply</b-button>
                        </div>
                    </div>
                </b-dropdown-form>
            </b-dropdown>


            <b-button pill variant="outline-danger" v-on:click="resetFilter()">
                <span><i class="fas fa-trash-alt"></i></span> Reset all filters
            </b-button>
        </div>

        <div class="container text-center">
            <b-collapse id="expectedDeliveryDate" class="mt-2">
                <b-card>
                    <div class="mb-auto mt-4 row">
                        <div class="col-lg-8 offset-lg-2">
                            <date-picker v-model="filter.expected_delivery_date" :config="dateOptions"></date-picker>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-lg-12 text-center">
                            <b-button v-on:click="filterWhenDateChange()" size="lg" variant="outline-success">Apply</b-button>
                        </div>
                    </div>
                </b-card>
            </b-collapse>
        </div>
        <div class="container py-5">
            <list-item v-for="(shipmentChunk, index) in shipmentChunks" v-bind:key="index"
                       :shipmentChunk="shipmentChunk">
            </list-item>
        </div>
    </div>
</template>

<script>
    import ListItem from "./ListItem";

    const dict = {
        custom: {
            minPrice: {
                numeric: "Price must be a number"
            },
            maxPrice: {
                numeric: "Price must be a number"
            },
        }
    };
    export default {
        name: "list",
        components: {
            ListItem
        },
        data() {
            return {
                fromCity: '',
                toCity: '',
                showPriceApplyBtn: false,
                dateOptions: {
                    format: 'YYYY/MM/DD',
                    useCurrent: false,
                    inline: true
                },
                sortOptions: [
                    {
                        key: 0,
                        value: "Price (low - high)"
                    },
                    {
                        key: 1,
                        value: "Price (high - low)"
                    },
                    {
                        key: 2,
                        value: "Weight (low - high)"
                    },
                    {
                        key: 3,
                        value: "Weight (high - low)"
                    }
                ],
                activeSort: null,
                sort: null,
                filter: {
                    expected_delivery_date: new Date(),
                    document: true,
                    min_price: null,
                    max_price: null
                },
                total_result: 10,
                shipmentList: [],
                shipmentChunks: []
            };
        },
        methods: {
            resetFilter: function () {
                this.sort = null;
                this.filter = {
                    expected_delivery_date: new Date(),
                    document: true,
                    min_price: null,
                    max_price: null
                };
            },
            submitPriceFilter: function () {
                this.$validator.validateAll().then((validateResult) => {
                    if (validateResult === true) {
                        this.filterShipment()
                    }
                });
            },
            sortShipment: function (sortOrder) {
                this.activeSort = sortOrder;
                this.sort = sortOrder;
                this.filterShipment();
            },

            filterWhenDateChange: function () {
                // close expectedDelivery datepicker dropdown
                this.$root.$emit('bv::toggle::collapse', 'expectedDeliveryDate');
                this.filterShipment();
            },

            validateBeforePosting: function (field) {
                if (field === null || field === '' || field === undefined) {
                    return false;
                }
                return true;
            },

            filterShipment: function () {
                let loader = this.$loading.show({
                    container: this.$refs.formContainer,
                });

                // todo: improve filter performance
                let postParam = {
                    fromCity: this.fromCity,
                    toCity: this.toCity
                };

                if (this.validateBeforePosting(this.filter.expected_delivery_date) === true) {
                    postParam.expected_delivery_date = this.filter.expected_delivery_date;
                }

                if (this.validateBeforePosting(this.document) === true) {
                    postParam.document = this.document;
                }

                if (this.validateBeforePosting(this.filter.min_price) === true) {
                    postParam.min_price = this.filter.min_price;
                }

                if (this.validateBeforePosting(this.filter.max_price) === true) {
                    postParam.max_price = this.filter.max_price;
                }

                if (this.validateBeforePosting(this.sort) === true) {
                    postParam.sort = this.sort;
                }

                this.$http.post(`shipment/filter`, postParam).then(function (res) {
                    if (res.status === 200) {
                        this.shipmentChunks = this.chunk(res.body, 2);
                    } else {
                        this.errorMsg = res.body.message;
                    }
                    this.$root.$emit('bv::toggle::collapse::false', 'expectedDeliveryDate');
                    loader.hide();
                }).catch(function (res) {
                    loader.hide();
                    if (!res.ok) {
                        this.showErrorMessage('Something wrong happened!');
                    }
                });

            },

            // split array into chunks
            chunk: function (arr, size) {
                return Array.from({length: Math.ceil(arr.length / size)}, (v, i) =>
                    arr.slice(i * size, i * size + size)
                );
            }
        },
        created: function () {
            this.fromCity = this.$route.params.fromCity;
            this.toCity = this.$route.params.toCity;

            // enable custom validation message
            this.$validator.localize('en', dict);
            this.filterShipment();
        }
    };
</script>

<style scoped>

</style>
