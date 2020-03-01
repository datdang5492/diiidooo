<template>
    <div class="">
        <authentication></authentication>
        <navigation></navigation>
        <router-view></router-view>
    </div>
</template>

<script>
    import Navigation from "./components/Navigation";
    import SearchSection from "./components/SearchSection";
    import Authentication from "./components/Authentication";
    import FilterSection from "./components/FilterSection";

    export default {
        name: "app",
        components: {
            FilterSection,
            Navigation,
            SearchSection,
            Authentication
        },
        data() {
            return {};
        },
        methods: {},
        created: function () {
        }
    };
</script>

<style>
    body {
        color: #484848 !important;
    }

    .mt-6 {
        margin-top: 4.5rem !important;
    }

    .mt-7 {
        margin-top: 6rem !important;
    }

    .mt-8 {
        margin-top: 7.5rem !important;
    }

    .min-height-1000 {
        min-height: 1000px;
    }

    .title_size1 {
        font-size: 1.25rem;
    }

    .title_size2 {
        font-size: 1.1rem;
    }

    .title_size3 {
        font-size: 1rem;
    }

    .title_huge {
        font-size: 20px;
        font-weight: bold;
    }

    .title_big {
        font-size: 18px;
        font-weight: bold;
    }

    .title_small {
        font-size: 16px;
        font-weight: bold;
    }

    .pd5 {
        padding: 5px
    }

    .pd10 {
        padding: 10px
    }

    .pd15 {
        padding: 15px
    }

    .pd20 {
        padding: 20px
    }

    .profile .profile_detail {
        border: 1px solid rgb(220, 224, 224);
    }

    .profile .section_title {
        background-color: rgb(220, 224, 224);
        border-bottom: 1px solid rgb(220, 224, 224);
        min-height: 45px;
        padding: 6px;
        font-size: 20px;
    }

    .border {
        border: 1px solid rgb(220, 224, 224) !important;
    }

    .bd_bottom {
        border-bottom: 1px solid rgb(220, 224, 224) !important;
    }

    .bd_left {
        border-left: 1px solid rgb(220, 224, 224) !important;
    }

    .bd_top {
        border-top: 1px solid rgb(220, 224, 224) !important;
    }

    .bd_right {
        border-right: 1px solid rgb(220, 224, 224) !important;
    }

    .save_btn {
        width: 100px !important;
        height: 45px !important;
    }

    input:valid {
        /*border-color: deepskyblue;*/
    }

    input:invalid {
        border-color: red;
    }

    select:invalid {
        border-color: red;
    }

</style>
