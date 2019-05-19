<template>
    <div class="col-md-7 profile_detail">
        <div class="row mb-3 section_title">
            <div class="col-md-12">
                <label>Required *</label>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-sm-2">
                <label>First Name</label>
            </div>
            <div class="col-sm-10">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Dat">
                </div>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-sm-2">
                <label>Last Name</label>
            </div>
            <div class="col-sm-10">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Dang Ba">
                </div>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-sm-2">
                <label>Gender</label>
            </div>
            <div class="col-sm-4">
                <div class="input-group">
                    <select class="custom-select">
                        <option selected>Choose</option>
                        <option value="1" selected>Male</option>
                        <option value="2">Female</option>
                        <option value="3">Other</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-sm-2">
                <label>Birth Date</label>
            </div>
            <div class="col-sm-10">
                <div class="input-group">
                    <label>05/04/1992</label>
                </div>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-sm-2">
                <label>Email Address</label>
            </div>
            <div class="col-sm-10">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="dangbadat5492@gmail.com">
                </div>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-sm-2">
                <label>Phone Numbers</label>
            </div>
            <div class="col-sm-10">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="dangbadat5492@gmail.com">
                </div>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-sm-2">
                <label>Government ID</label>
            </div>
            <div class="col-sm-10">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="dangbadat5492@gmail.com">
                </div>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-sm-2">
                <label>Languages</label>
            </div>
            <div class="col-sm-4">
                <div class="input-group">
                    <select class="custom-select">
                        <option selected>Tiếng Việt</option>
                        <option value="1">English</option>
                        <option value="2">German</option>
                        <option value="3">Tiếng Việt</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-sm-2">
                <label>Currency</label>
            </div>
            <div class="col-sm-4">
                <div class="input-group">
                    <select class="custom-select">
                        <option selected>EUR</option>
                        <option value="1">EUR</option>
                        <option value="2">USD</option>
                        <option value="3">VND</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-sm-2">
                <label>Address</label>
            </div>
            <div class="col-sm-10">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Augsburg, Bavaria, Germany">
                </div>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-sm-2">
                <label>Introduction</label>
            </div>
            <div class="col-sm-10">
                <div class="input-group">
                    <textarea class="form-control">a graduate student of Hochschule Heilbronn</textarea>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "profile_setting",
        components: {
        },
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
