<template>
    <div class="col-md-7">
        <b-alert dismissible variant="success" v-model="showInfoMsg">{{infoMsg}}</b-alert>
        <b-alert dismissible variant="danger" v-model="showErrorMsg">{{errorMsg}}</b-alert>

        <form @submit.prevent="saveProfile" v-if="userData !== null">
            <div class="profile_detail container-fluid">
                <div class="row mb-3 section_title">
                    <div class="col-md-12">
                        <label>Required *</label>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-9 offset-3">
                        <span class="text-danger">{{errors.first('firstName')}}</span>
                    </div>
                </div>
                <div class="row mb-4">
                    <div class="col-sm-3">
                        <label>First Name</label>
                    </div>
                    <div class="col-sm-9">
                        <div class="input-group">
                            <input type="text" class="form-control"
                                   v-validate="'required|alpha_spaces|min:2'" name="firstName"
                                   v-model="userData.firstName">
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-sm-9 offset-3">
                        <span class="text-danger">{{errors.first('lastName')}}</span>
                    </div>
                </div>
                <div class="row mb-4">
                    <div class="col-sm-3">
                        <label>Last Name</label>
                    </div>
                    <div class="col-sm-9">
                        <div class="input-group">
                            <input type="text" class="form-control"
                                   v-validate="'required|alpha_spaces|min:2'" name="lastName"
                                   v-model="userData.lastName">
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-sm-9 offset-3">
                        <span class="text-danger">{{errors.first('gender')}}</span>
                    </div>
                </div>
                <div class="row mb-4">
                    <div class="col-sm-3">
                        <label>Gender</label>
                    </div>
                    <div class="col-sm-9">
                        <div class="input-group">
                            <select class="custom-select" v-validate="'required|alpha|max:6'" name="gender"
                                    v-model="userData.gender">
                                <option selected>Choose a gender</option>
                                <option value="male" selected>Male</option>
                                <option value="female">Female</option>
                                <option value="other">Other</option>
                            </select>
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-sm-9 offset-3">
                        <span class="text-danger">{{errors.first('birthDate')}}</span>
                    </div>
                </div>
                <div class="row mb-4">
                    <div class="col-sm-3">
                        <label>Birth Date</label>
                    </div>
                    <div class="col-sm-9">
                        <div class="input-group">
                            <input type="text" class="form-control" v-validate="'required|date_format:dd/MM/yyyy'"
                                   name="birthDate" v-model="userData.birthDate">
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-sm-9 offset-3">
                        <span class="text-danger">{{errors.first('phone')}}</span>
                    </div>
                </div>
                <div class="row mb-4">
                    <div class="col-sm-3">
                        <label>Phone Numbers</label>
                    </div>
                    <div class="col-sm-9">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="015754792720"
                                   v-validate="'required|alpha_num|max:12|min:9'" name="phone" v-model="userData.phone">
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-sm-9 offset-3">
                        <span class="text-danger">{{errors.first('governmentId')}}</span>
                    </div>
                </div>
                <div class="row mb-4">
                    <div class="col-sm-3">
                        <label>Government ID</label>
                    </div>
                    <div class="col-sm-9">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Y08CK9MGM"
                                   v-validate="'required|alpha_num|max:9'" name="governmentId"
                                   v-model="userData.governmentId">
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-sm-9 offset-3">
                        <span class="text-danger">{{errors.first('language')}}</span>
                    </div>
                </div>
                <div class="row mb-4">
                    <div class="col-sm-3">
                        <label>Languages</label>
                    </div>
                    <div class="col-sm-9">
                        <div class="input-group">
                            <select class="custom-select" v-validate="'required|alpha|length:2'" name="language"
                                    v-model="userData.language">
                                <option>Please choose a language</option>
                                <option value="en">English</option>
                                <option value="de" selected>German</option>
                                <option value="vi">Tiếng Việt</option>
                            </select>
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-sm-9 offset-3">
                        <span class="text-danger">{{errors.first('currency')}}</span>
                    </div>
                </div>
                <div class="row mb-4">
                    <div class="col-sm-3">
                        <label>Currency</label>
                    </div>
                    <div class="col-sm-9">
                        <div class="input-group">
                            <select class="custom-select" v-validate="'required|alpha|length:3'" name="currency"
                                    v-model="userData.currency">
                                <option>Please choose a currency</option>
                                <option value="eur" selected>EUR</option>
                                <option value="usd">USD</option>
                                <option value="vnd">VND</option>
                            </select>
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-sm-9 offset-3">
                        <span class="text-danger">{{errors.first('address')}}</span>
                    </div>
                </div>
                <div class="row mb-4">
                    <div class="col-sm-3">
                        <label>Address</label>
                    </div>
                    <div class="col-sm-9">
                        <div class="input-group">
                            <input type="text" class="form-control"
                                   placeholder="House Number - Street, Postcode - City, Country"
                                   v-validate="'required'" name="address" v-model="userData.address">
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-sm-9 offset-3">
                        <span class="text-danger">{{errors.first('introduction')}}</span>
                    </div>
                </div>
                <div class="row mb-4">
                    <div class="col-sm-3">
                        <label>Introduction</label>
                    </div>
                    <div class="col-sm-9">
                        <div class="input-group">
                            <textarea class="form-control" v-validate="'required'" name="introduction"
                                      v-model="userData.introduction">a graduate student of Hochschule Heilbronn
                            </textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid mt-3">
                <div class="row">
                    <div class="col-md-12">
                        <b-button type="submit" variant="primary" class="save_btn">Save</b-button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
    // custom validation message
    const dict = {
        custom: {
            firstName: {
                required: 'Kindly enter your first name!',
                min: 'First name should have at least 2 letters!'
            },
            lastName: {
                required: 'Kindly enter your last name!',
                min: 'Last name should have at least 2 letters!'
            },
            gender: {
                required: 'Kindly choose your gender!',
                numeric: 'Kindly choose your gender!',
                max: 'Kindly dont hack our platform!'
            },
            birthDate: {
                required: 'Kindly enter your birth date!',
                date_format: 'Date format is dd/mm/yyyy, such as 20/12/2000'
            },
            phone: {
                required: 'Phone number is required'
            },
            language: {
                required: 'Kindly choose your preferable language!',
                numeric: 'Kindly choose your preferable language!',
                max: 'Kindly dont hack our platform!'
            },
            currency: {
                required: 'Kindly choose your preferable currency!',
                numeric: 'Kindly choose your preferable currency!',
                max: 'Kindly dont hack our platform!'
            },
            address: {
                required: 'Kindly enter your current address!'
            },
            introduction: {
                required: 'Please give a short introduction so other might know you well :)!'
            },
        }
    };

    export default {
        name: "profile_setting",
        components: {},
        data() {
            return {
                userData: null,
                errorMsg: '',
                showErrorMsg: false,
                infoMsg: '',
                showInfoMsg: false,
            };
        },

        methods: {
            saveProfile: function () {
                this.$validator.validateAll().then((result) => {
                    if (result) {
                        this.$http.post('profile/save', this.userData).then(function (res) {
                            if (res.status === 200) {
                                this.infoMsg = "Your information has been saved!";
                                this.showInfoMsg = true;
                            }
                        }).catch(function (res) {
                            if (!res.ok) {
                                this.errorMsg = res.body.message;
                                this.showErrorMsg = true;
                            }
                        });
                    }
                });
            },

            getProfileData: function () {
                this.$http.post('profile/get-profile').then(function (res) {
                    this.userData = res.body.data;
                    this.userData.birthDate = this.convertFrontendDate(this.userData.birthDate);
                }).catch(function (res) {
                    if (!res.ok) {
                        this.errorMsg = res.body.message;
                    }
                });
            },

            convertFrontendDate: function (date) {
                return this.$moment(date, 'YYYY-MM-DD').format('DD/MM/YYYY');
            }
        },
        created: function () {
            // enable custom validation message
            this.$validator.localize('en', dict);
            this.getProfileData();
        }
    };
</script>

<style scoped>

</style>
