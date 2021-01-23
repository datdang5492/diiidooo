<template>
    <div>
        <search-section></search-section>
        <filter-section></filter-section>
        <can-be-user></can-be-user>
        <can-be-shippper></can-be-shippper>
        <contact></contact>
    </div>
</template>

<script>
    import SearchSection from "../SearchSection";
    import FilterSection from "../FilterSection";
    import CanBeShippper from "../CanBeShippper";
    import CanBeUser from "../CanBeUser";
    import Contact from "../Contact";

    export default {
        name: "homepage",
        components: {
            FilterSection,
            SearchSection,
            Contact,
            CanBeShippper,
            CanBeUser
        },
        data() {
            return {
            };
        },
        methods: {
        },
        created: function () {
        }
    };
</script>

<style scoped>

</style>
