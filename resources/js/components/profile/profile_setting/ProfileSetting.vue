<template>
    <div class="col-md-7">
        <form @submit.prevent="saveProfile">
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
                                   v-validate="'required|alpha_spaces|min:2'" name="firstName">
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
                                   v-validate="'required|alpha_spaces|min:2'" name="lastName">
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
                            <select class="custom-select" v-validate="'required|numeric|max:1'" name="gender">
                                <option selected>Choose a gender</option>
                                <option value="1" selected>Male</option>
                                <option value="2">Female</option>
                                <option value="3">Other</option>
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
                                   name="birthDate">
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
                                   v-validate="'required|numeric|max:12|min:9'" name="phone">
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
                                   v-validate="'required|alpha_num|max:9'" name="governmentId">
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
                            <select class="custom-select" v-validate="'required|numeric|max:2'" name="language">
                                <option>Please choose a language</option>
                                <option value="1">English</option>
                                <option value="2" selected>German</option>
                                <option value="3">Tiếng Việt</option>
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
                            <select class="custom-select" v-validate="'required|numeric|max:2'" name="currency">
                                <option>Please choose a currency</option>
                                <option value="1" selected>EUR</option>
                                <option value="2">USD</option>
                                <option value="3">VND</option>
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
                                   v-validate="'required'" name="address">
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
                            <textarea class="form-control" v-validate="'required'" name="introduction">a graduate student of Hochschule Heilbronn
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
            return {};
        },
        methods: {
            saveProfile: function () {
                this.$http.post('profile/save', {
                    firstName: 'dat',
                    lastName: 'dat',
                    gender: 'dat',
                    birthDate: 'dat',
                    phone: 'dat',
                    governmentId: 'dat',
                    language: 'dat',
                    currency: 'dat',
                    address: 'dat',
                    introduction: 'dat',
                }).then(function (data) {
                    return;
                });
                return;

                // this.$validator.validateAll().then((result) => {
                //     if (result) {
                //         this.$http.post('profile/save', {
                //
                //         }).then(function (data) {
                //             return;
                //         });
                //         return;
                //     }
                // });
            }
        },
        created: function () {
            this.$validator.localize('en', dict);
        }
    };
</script>

<style scoped>

</style>
