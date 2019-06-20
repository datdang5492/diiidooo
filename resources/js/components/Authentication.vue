<template>
    <div>
        <!-- Log in modal -->
        <b-modal id="loginModal" title="Welcome back :)">
            <form class="mb-3" @submit.prevent="handleLogin">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Email" v-model="user.email">
                    <div class="input-group-append">
                  <span class="input-group-text">
                    <i class="far fa-envelope"></i>
                  </span>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" :type="'password'" placeholder="Password"
                           v-model="user.password">
                    <div class="input-group-append">
                  <span class="input-group-text">
                    <i class="fa fa-lock"></i>
                  </span>
                    </div>
                </div>
                <div class="custom-control custom-checkbox mb-3">
                    <input type="checkbox" class="custom-control-input" id="remember_me" v-model="user.remember_me">
                    <label class="custom-control-label" for="remember_me">Remember me</label>
                </div>
                <button type="submit" class="btn btn-success btn-block font-weight-bold mb-3">Log in</button>
                <a href="#" v-b-modal.forgotPassModal class="font-weight-normal float-right mb-3">Forgot password ?</a>
            </form>

            <div>
                <a href="#" class="fb btn btn-outline">
                    <fa :icon="{ prefix: 'fab', iconName: 'facebook' }" class="float-left"/>
                    <span>Login with Facebook</span>

                </a>
                <a href="#" class="google btn btn-outline">
                    <fa :icon="{ prefix: 'fab', iconName: 'google' }" class="float-left"/>
                    <span>Login with Google</span>
                </a>
            </div>

            <div slot="modal-footer">
                <p>
                    Don't have an account yet?
                    <a href="#" v-b-modal.signupModal class="font-weight-bold">Sign up</a>
                </p>
            </div>
        </b-modal>
        <!-- End of Login Modal -->


        <!-- Sign up modal -->
        <b-modal id="signupModal" title="Become a member!">
            <form @submit.prevent="handleSignUp">
                <!-- Email -->
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Email" v-model="guest.email">
                    <div class="input-group-append">
                  <span class="input-group-text">
                    <i class="far fa-envelope"></i>
                  </span>
                    </div>
                </div>
                <!-- First Name -->
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="First Name" v-model="guest.name">
                    <div class="input-group-append">
                  <span class="input-group-text">
                    <i class="far fa-user"></i>
                  </span>
                    </div>
                </div>
                <!--  Last Name -->
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Last Name"
                           v-model="guest.password_confirmation">
                    <div class="input-group-append">
                  <span class="input-group-text">
                    <i class="far fa-user"></i>
                  </span>
                    </div>
                </div>
                <!-- Password -->
                <div class="input-group mb-3">
                    <input type="text" class="form-control" :type="'password'" placeholder="Password"
                           v-model="guest.password">
                    <div class="input-group-append">
                  <span class="input-group-text">
                    <i class="fa fa-lock"></i>
                  </span>
                    </div>
                </div>

                <!-- Password Confirmation-->
                <div class="input-group mb-3">
                    <input type="text" class="form-control" :type="'password'" placeholder="Password"
                           v-model="guest.password_confirmation">
                    <div class="input-group-append">
                  <span class="input-group-text">
                    <i class="fa fa-lock"></i>
                  </span>
                    </div>
                </div>
                <div class="custom-control custom-checkbox mb-3">
                    <input type="checkbox" class="custom-control-input" id="confirmation">
                    <label class="custom-control-label" for="confirmation">By continuing you accept our <a
                        href="">Terms of Use</a></label>
                </div>
                <button type="submit" class="btn btn-success btn-block font-weight-bold">Sign up</button>
            </form>
            <div class="text-center">Or</div>
            <div>
                <a href="#" class="fb btn btn-outline">
                    <fa :icon="{ prefix: 'fab', iconName: 'facebook' }" class="float-left"/>
                    <span>Connect with Facebook</span>

                </a>
                <a href="#" class="google btn btn-outline">
                    <fa :icon="{ prefix: 'fab', iconName: 'google' }" class="float-left"/>
                    <span>Connect with Google</span>
                </a>
            </div>

            <div slot="modal-footer">
                <p>
                    Already have an account?
                    <a href="#" v-b-modal.loginModal class="font-weight-bold">Log In</a>
                </p>
            </div>
        </b-modal>
        <!-- End of Sign up Modal -->

        <!--Forgot password modal-->
        <b-modal id="forgotPassModal" title="Reset Password">
            <form>
                <div class="input-group mb-3">
                    <p>Enter your registered email, we will send you the link to reset your password. </p>
                    <input type="text" class="form-control" placeholder="Email">
                    <div class="input-group-append">
                      <span class="input-group-text">
                        <i class="far fa-envelope"></i>
                      </span>
                    </div>
                </div>
                <button type="submit" class="btn btn-success btn-block font-weight-bold">Send</button>
            </form>
            <div slot="modal-footer">
                <p>
                    Already have an account?
                    <a href="#" v-b-modal.loginModal class="font-weight-bold">Back to Login</a>
                </p>
            </div>
        </b-modal>
        <!--End of forgot password modal-->
    </div>
</template>

<script>
    export default {
        name: "authentication",
        components: {},
        data() {
            return {
                guest: {
                    email: '',
                    name: '',
                    password: '',
                    password_confirmation: ''
                },

                user: {
                    email: '',
                    password: '',
                    remember_me: false
                }
            };
        },
        methods: {
            handleLogin: function () {
                this.$http.post('login', {
                    email: this.user.email,
                    password: this.user.password,
                    remember_me: this.user.remember_me
                }).then(function (data) {
                    window.location.reload();
                });
            },

            handleSignUp: function () {
                this.$http.post('register', {
                    email: this.guest.email,
                    name: this.guest.name,
                    password: this.guest.password,
                    password_confirmation: this.guest.password
                }).then(function (data) {
                    window.location.reload();
                });
            }


        },
        created: function () {
        }
    };
</script>

<style scoped>
    .btn {
        width: 100%;
        padding: 12px;
        border: none;
        border-radius: 4px;
        margin: 5px 0;
        opacity: 0.85;
        display: inline-block;
        font-size: 17px;
        line-height: 20px;
        text-decoration: none;
    }

    .fb {
        background-color: #3B5998;
        color: white;
    }

    .google {
        background-color: #dd4b39;
        color: white;
    }
</style>
