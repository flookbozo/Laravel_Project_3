<template>
  <div class="container">
    <nav class="nav nav-pills nav-justified" id="pills-tab" role="tablist">
      <a
        class="nav-item nav-link active"
        id="pills-hospital-tab"
        data-toggle="pill"
        href="#pills-hospital"
        role="tab"
        aria-controls="pills-hospital"
        aria-selected="true"
        >Hospital</a
      >
      <a
        class="nav-item nav-link"
        id="pills-user-tab"
        data-toggle="pill"
        href="#pills-user"
        role="tab"
        aria-controls="pills-user"
        aria-selected="false"
        >User</a
      >
    </nav>
    <div class="tab-content" id="pills-tabContent">
      <div
        class="tab-pane fade show active"
        id="pills-hospital"
        role="tabpanel"
        aria-labelledby="pills-hospital-tab"
      >
        <div class="card">
          <div class="card-header">Register</div>
          <div class="card-body">
            <div class="col-md-6 offset-md-3">
              <form v-on:submit.prevent="onSubmitHospital">
                <div class="alert alert-danger" v-if="hospital.errors.length">
                  <ul class="mb-0">
                    <li v-for="(error, index) in hospital.errors" :key="index">
                      {{ error }}
                    </li>
                  </ul>
                </div>
                <div class="form-group">
                  <label>Name</label>
                  <input
                    type="text"
                    class="form-control"
                    placeholder="Name"
                    v-model="hospital.name"
                  />
                </div>

                <div class="form-group">
                  <label>Username</label>
                  <input
                    type="text"
                    class="form-control"
                    placeholder="Username"
                    v-model="hospital.username"
                  />
                </div>

                <div class="form-group">
                  <label>Password</label>
                  <input
                    type="password"
                    class="form-control"
                    placeholder="Password"
                    v-model="hospital.password"
                  />
                </div>

                <div class="form-group">
                  <label>Password Again</label>
                  <input
                    type="password"
                    class="form-control"
                    placeholder="Password Again"
                    v-model="hospital.passwordAgain"
                  />
                </div>

                <div class="form-group">
                  <label>Hospital Name</label>
                  <input
                    type="text"
                    class="form-control"
                    placeholder="Hospital Name"
                    v-model="hospital.hospitalname"
                  />
                </div>

                <div class="form-group">
                  <label>Email</label>
                  <input
                    type="text"
                    class="form-control"
                    placeholder="Email"
                    v-model="hospital.email"
                  />
                </div>

                <button class="btn btn-success">Register</button>
              </form>
            </div>
          </div>
        </div>
      </div>
      <div
        class="tab-pane fade"
        id="pills-user"
        role="tabpanel"
        aria-labelledby="pills-user-tab"
      >
        <div class="card">
          <div class="card-header">Register</div>
          <div class="card-body">
            <div class="col-md-6 offset-md-3">
              <form v-on:submit.prevent="onSubmitUser">
                <div class="alert alert-danger" v-if="user.errors.length">
                  <ul class="mb-0">
                    <li v-for="(error, index) in user.errors" :key="index">
                      {{ error }}
                    </li>
                  </ul>
                </div>
                <div class="form-group">
                  <label>Name</label>
                  <input
                    type="text"
                    class="form-control"
                    placeholder="Name"
                    v-model="user.name"
                  />
                </div>

                <div class="form-group">
                  <label>LastName</label>
                  <input
                    type="text"
                    class="form-control"
                    placeholder="Name"
                    v-model="user.lastname"
                  />
                </div>

                <div class="form-group">
                  <label>Username</label>
                  <input
                    type="text"
                    class="form-control"
                    placeholder="Username"
                    v-model="user.username"
                  />
                </div>

                <div class="form-group">
                  <label>Password</label>
                  <input
                    type="password"
                    class="form-control"
                    placeholder="Password"
                    v-model="user.password"
                  />
                </div>

                <div class="form-group">
                  <label>Password Again</label>
                  <input
                    type="password"
                    class="form-control"
                    placeholder="Password Again"
                    v-model="user.passwordAgain"
                  />
                </div>

                <div class="form-group">
                  <label>Tel.</label>
                  <input
                    type="text"
                    class="form-control"
                    placeholder="Tel."
                    v-model="user.user_tel"
                  />
                </div>

                <button class="btn btn-success">Register</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "register",
  props: ["app"],
  data() {
    return {
      user: {
        name: "",
        lastname: "",
        username: "",
        password: "",
        passwordAgain: "",
        user_tel: "",
        errors: [],
      },
      hospital: {
        name: "",
        username: "",
        password: "",
        hospitalname: "",
        email: "",
        errors: [],
      }
      
    };
  },
  methods: {
    onSubmitUser() {
      this.user.errors = [];

      if (!this.user.name) {
        this.user.errors.push("Name is required.");
      }
      if (!this.user.lastname) {
        this.user.errors.push("Lastname is required.");
      }
      if (!this.user.username) {
        this.user.errors.push("Username is required.");
      }
      if (!this.user.password) {
        this.user.errors.push("Password is required.");
      }
      if (!this.user.passwordAgain) {
        this.user.errors.push("Password confirmation is required.");
      }
      if (this.user.password !== this.user.passwordAgain) {
        this.user.errors.push("Passwords dont match");
      }
      if (!this.user.user_tel) {
        this.user.errors.push("Tel. is required.");
      }
      if (!this.user.errors.length) {
        const data = {
          name: this.user.name,
          lastname: this.user.lastname,
          username: this.user.username,
          password: this.user.password,
          user_tel: this.user.user_tel,
        };

        this.app.req
          .post("auth/user/register", this.user)
          .then((response) => {
            this.app.user = response.data.user;
            this.$router.push("/");
          })
          .catch((error) => {
            this.user.errors.push(error.response.data.error);
          });
      }
    },
    onSubmitHospital() {
      this.hospital.errors = [];

      if (!this.hospital.name) {
        this.hospital.errors.push("Name is required.");
      }
      if (!this.hospital.username) {
        this.hospital.errors.push("Username is required.");
      }
      if (!this.hospital.password) {
        this.hospital.errors.push("Password is required.");
      }
      if (!this.hospital.passwordAgain) {
        this.hospital.errors.push("Password confirmation is required.");
      }
      if (this.hospital.password !== this.hospital.passwordAgain) {
        this.hospital.errors.push("Passwords dont match");
      }
      if (!this.hospital.hospitalname) {
        this.hospital.errors.push("Hospital Name is required.");
      }
      if (!this.hospital.email) {
        this.hospital.errors.push("Email is required.");
      }
      if (!this.hospital.errors.length) {
        const data = {
          name: this.hospital.name,
          username: this.hospital.username,
          password: this.hospital.password,
          hospitalname: this.hospital.hospitalname,
          email: this.hospital.email,
        };

        this.app.req
          .post("auth/hospital/register", this.hospital)
          .then((response) => {
            this.app.hospital = response.data.hospital;
            this.$router.push("/");
          })
          .catch((error) => {
            this.hospital.errors.push(error.response.data.error);
          });
      }
    },
  },
};
</script>

<style>
</style>