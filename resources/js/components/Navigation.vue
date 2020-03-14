<template>
    <div class="container-fluid navigation border-bottom">
        <nav class="navbar navbar-expand-lg navbar-dark pt-4 px-0">
            <a class="navbar-brand mr-5" href="/">
                <img
                    :src="'/images/dido_logo.png'"
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
                    <li class="nav-item">
                        <b-form-select v-model="selected_language" :options="languages" size="sm"
                                       class="mr-4 mt-1 lang_select"></b-form-select>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">How it works</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="/tracking">Track Shipment</a>
                    </li>
                    <li class="nav-item" v-if="this.$authStatus === '1'">
                        <a class="nav-link" href="/profile">My Account</a>
                    </li>
                    <li class="nav-item" v-if="this.$authStatus !== '1'">
                        <a class="nav-link" href="#" v-b-modal.loginModal>Log in</a>
                    </li>
                    <li class="nav-item" v-if="this.$authStatus !== '1'">
                        <b-btn variant="outline-success" v-b-modal.signupModal><i class="fa fa-user-edit mr-2"></i>Sign
                            up
                        </b-btn>
                    </li>
                    <li class="nav-item" v-if="this.$authStatus === '1'">
                        <a class="nav-link" href="#" @click="handleSignOut()"><i class="fa fa-times mr-2"></i>Sign
                            out</a>
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
                selected_language: null,
                languages: [
                    {value: null, text: 'Languages'},
                    {value: 'en', text: 'English'},
                    {value: 'de', text: 'Deutsch'},
                    {value: 'vi', text: 'Tiếng Việt'},
                ]
            };
        },
        methods: {
            handleSignOut: function () {
                let loader = this.$loading.show({
                    container: this.$refs.formContainer,
                });

                this.$http.post('logout', {}).then(function (data) {
                    loader.hide();
                    window.location.reload();
                });
            },
        },
        created: function () {
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

    .lang_select {
        width: 82%;
    }

</style>
