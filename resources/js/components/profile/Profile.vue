<template>
    <div class="section py-4 min-height-normal profile">
        <div class="container">
            <div class="row">
                <div class="col-md-3 offset-lg-1">
                    <nav class="nav flex-column">
                        <router-link class="nav-link active title_size2 font_common" to="/profile">
                            Edit Profile
                        </router-link>

                        <router-link class="nav-link title_size2 font_common" to="/profile/photo">Photo</router-link>

                        <router-link class="nav-link title_size2 font_common" to="/profile/my-deliveries">
                            My Deliveries
                        </router-link>

                        <router-link class="nav-link title_size2 font_common" to="/profile/my-shipments">
                            My Shipments
                        </router-link>

                        <router-link class="nav-link title_size2 font_common" to="/profile/reviews-about-you">
                            Reviews about you
                        </router-link>

                        <router-link class="nav-link title_size2 font_common" to="/profile/reviews-by-you">
                            Reviews by you
                        </router-link>
                    </nav>
                </div>
                <router-view></router-view>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "profile",
        components: {},
        data() {
            return {};
        },
        methods: {

        },
        created: function () {

        }
    };
</script>

<style scoped>
    .font_common {
        font-family: "Poppins", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
        color: #212529;
    }

</style>
