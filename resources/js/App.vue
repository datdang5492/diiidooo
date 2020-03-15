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
