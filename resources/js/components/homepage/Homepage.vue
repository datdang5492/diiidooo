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
