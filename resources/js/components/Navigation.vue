<template>
  <div class="container">
    <nav class="navbar navbar-expand-lg navbar-dark pt-4 px-0">
      <a class="navbar-brand mr-5" href="#">
        <img
          src="../images/app-promo/dido_logo.png"
          class="mr-2"
          style="width: 80px;"
          alt="Shards - Agency Landing Page"
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
            <a class="nav-link" href="#">
              How it works
              <span class="sr-only">(current)</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Contact</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#" data-toggle="modal" data-target="#log_in">Log In</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#" data-toggle="modal" data-target="#sign_up">Sign Up</a>
          </li>
        </ul>
      </div>
    </nav>

    <!-- Log in modal -->
    <div
      class="modal fade"
      id="log_in"
      tabindex="-1"
      role="dialog"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Welcome back :)</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
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
              <button type="submit" class="btn btn-primary btn-block font-weight-bold">Log In</button>
              <a href class="font-weight-normal">Forgot password ?</a>
            </form>
          </div>
          <div class="modal-footer">
            <p>
              Don't have an account?
              <a href class="font-weight-bold">Sign up</a>
            </p>
          </div>
        </div>
      </div>
    </div>
    <!-- End of Login Modal -->

    <!-- Sign up modal -->
    <div
      class="modal fade"
      id="sign_up"
      tabindex="-1"
      role="dialog"
      aria-labelledby="sign_up_label"
      aria-hidden="true"
    >
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="sign_up_label">Start to deliver thing with Dido!</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
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
                <label class="custom-control-label" for="confirmation">By continuing you accept our <a href="" >Terms of Use</a></label>
              </div>
              <button type="submit" class="btn btn-success btn-block font-weight-bold">Sign Up</button>
            </form>
          </div>
          <div class="modal-footer">
            <p>
              Already have an account?
              <a href="" class="font-weight-bold" >Log In</a>
            </p>
          </div>
        </div>
      </div>
    </div>
    <!-- End of Sign up Modal -->
  </div>
</template>

<script>
export default {
  name: "navigation",
  components: {},
  data() {
    return {};
  },
  methods: {},
  created: function() {}
};
</script>

<style scoped>
</style>
