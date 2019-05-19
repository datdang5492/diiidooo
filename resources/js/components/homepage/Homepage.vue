<template>
    <div>
        <search-section></search-section>
        <filter-section></filter-section>
        <contact></contact>
    </div>
</template>

<script>
    import SearchSection from "../SearchSection";
    import FilterSection from "../FilterSection";
    import Contact from "../Contact";

    export default {
        name: "homepage",
        components: {
            FilterSection,
            SearchSection,
            Contact,
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
    .shards-app-promo-page--1 .welcome {
        min-height: unset;
    }
</style>
