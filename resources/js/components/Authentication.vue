<template>
    <div>
        <!-- Log in modal -->
        <b-modal id="loginModal" title="Welcome back :)">
            <form>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Email">
                    <div class="input-group-append">
                  <span class="input-group-text">
                    <i class="fa fa-envelope"></i>
                  </span>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Password">
                    <div class="input-group-append">
                  <span class="input-group-text">
                    <i class="fa fa-lock"></i>
                  </span>
                    </div>
                </div>
                <div class="custom-control custom-checkbox mb-3">
                    <input type="checkbox" class="custom-control-input" id="remember_me">
                    <label class="custom-control-label" for="remember_me">Remember me</label>
                </div>
                <button type="submit" class="btn btn-success btn-block font-weight-bold">Log in</button>
                <a href="#" v-b-modal.forgotPassModal class="font-weight-normal">Forgot password ?</a>
            </form>
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
            <form>
                <!-- Email -->
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Email">
                    <div class="input-group-append">
                  <span class="input-group-text">
                    <i class="far fa-envelope"></i>
                  </span>
                    </div>
                </div>
                <!-- First Name -->
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="First Name">
                    <div class="input-group-append">
                  <span class="input-group-text">
                    <i class="far fa-user"></i>
                  </span>
                    </div>
                </div>
                <!--  Last Name -->
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Last Name">
                    <div class="input-group-append">
                  <span class="input-group-text">
                    <i class="far fa-user"></i>
                  </span>
                    </div>
                </div>
                <!-- Password -->
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Password">
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
                        <i class="fa fa-envelope"></i>
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
            return {};
        },
        methods: {},
        created: function () {
        }
    };
</script>

<style scoped>
</style>
