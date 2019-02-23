<template>
    <div class="shards-app-promo-page--1">
        <div class="welcome d-flex justify-content-center flex-column">
            <navigation></navigation>
            <inner-wrapper></inner-wrapper>
        </div>
        <contact></contact>
        <authentication></authentication>
    </div>
</template>

<script>
    import Navigation from "./components/Navigation";
    import InnerWrapper from "./components/InnerWrapper";
    import FeatureSection from "./components/FeatureSection";
    import Contact from "./components/Contact";
    import Authentication from "./components/Authentication";

    export default {
        components: {
            Navigation,
            InnerWrapper,
            FeatureSection,
            Contact,
            Authentication
        },
        data() {
            return {
                title: "dynamic title",
                component: "form-two"
            };
        },
        methods: {
            updateTitle: function (e) {
                this.title = e;
            }
        },
        created: function () {
        }
    };
</script>

<style scoped>

    /*.shards-app-promo-page--1 .welcome {*/
        /*background-color: #37517e;*/
        /*background: none;*/
    /*}*/

    /*.shards-app-promo-page--1 .welcome:before {*/
        /*background: #37518e;*/
    /*}*/
</style>
