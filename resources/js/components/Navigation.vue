<template>
    <div class="container-fluid navigation border-bottom">
        <nav class="navbar navbar-expand-lg navbar-dark pt-4 px-0">
            <a class="navbar-brand mr-5" href="/">
                <img
                    src="images/dido_logo.png"
                    class="mr-2"
                    style="width: 80px;"
                    alt="Deliver is easy !"
                >
            </a>
            <button
                class="navbar-toggler"
                type="button"
                data-toggle="collapse"
                data-target="#navbarNavDropdown"
                aria-controls="navbarNavDropdown"
                aria-expanded="false"
                aria-label="Toggle navigation"
            >
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav ml-auto font-weight-normal">
                    <li class="nav-item active">
                        <a class="nav-link" href="#">My Deliveries</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Contact</a>
                    </li>
                    <li class="nav-item" v-if="this.$authStatus !== '1'">
                        <a class="nav-link" href="#" v-b-modal.loginModal>Log in</a>
                    </li>
                    <li class="nav-item" v-if="this.$authStatus !== '1'">
                        <b-btn variant="outline-success" v-b-modal.signupModal>Sign up</b-btn>
                    </li>
                    <li class="nav-item" v-if="this.$authStatus === '1'">
                        <a class="nav-link" href="#" @click="handleSignOut()">Sign out</a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</template>

<script>
    export default {
        name: "navigation",
        components: {},
        data() {
            return {

            };
        },
        methods: {
            handleSignOut: function () {
                this.$http.post('logout', {

                }).then(function (data) {
                    window.location.reload();
                });
            },
        },
        created: function () {
            console.log(this.$authStatus);
        }
    };
</script>

<style scoped>
    @media (min-width: 1500px) {
        .navigation {
            padding: 0px 50px 0px 50px;
        }
    }

    .navbar-expand-lg .navbar-nav .nav-link {
        padding-right: 1.625rem;
        padding-left: 0.7rem;
    }

    .navigation .navbar-collapse .nav-item a {
        color: #5A6169
    }

</style>
