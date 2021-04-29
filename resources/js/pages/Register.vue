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
                <div class="alert alert-danger" v-if="errors.length">
                  <ul class="mb-0">
                    <li v-for="(error, index) in errors" :key="index">
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
                    v-model="name"
                  />
                </div>

                <div class="form-group">
                  <label>Username</label>
                  <input
                    type="text"
                    class="form-control"
                    placeholder="Username"
                    v-model="username"
                  />
                </div>

                <div class="form-group">
                  <label>Password</label>
                  <input
                    type="password"
                    class="form-control"
                    placeholder="Password"
                    v-model="password"
                  />
                </div>

                <div class="form-group">
                  <label>Password Again</label>
                  <input
                    type="password"
                    class="form-control"
                    placeholder="Password Again"
                    v-model="passwordAgain"
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
                <div class="alert alert-danger" v-if="errors.length">
                  <ul class="mb-0">
                    <li v-for="(error, index) in errors" :key="index">
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
                    v-model="name"
                  />
                </div>

                <div class="form-group">
                  <label>Username</label>
                  <input
                    type="text"
                    class="form-control"
                    placeholder="Username"
                    v-model="username"
                  />
                </div>

                <div class="form-group">
                  <label>Password</label>
                  <input
                    type="password"
                    class="form-control"
                    placeholder="Password"
                    v-model="password"
                  />
                </div>

                <div class="form-group">
                  <label>Password Again</label>
                  <input
                    type="password"
                    class="form-control"
                    placeholder="Password Again"
                    v-model="passwordAgain"
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
      name: "",
      username: "",
      password: "",
      passwordAgain: "",
      errors: [],
    };
  },
  methods: {
    onSubmitUser() {
      this.errors = [];

      if (!this.name) {
        this.errors.push("Name is required.");
      }
      if (!this.username) {
        this.errors.push("Username is required.");
      }
      if (!this.password) {
        this.errors.push("Password is required.");
      }
      if (!this.passwordAgain) {
        this.errors.push("Password confirmation is required.");
      }
      if (this.password !== this.passwordAgain) {
        this.errors.push("Passwords dont match");
      }
      if (!this.errors.length) {
        const data = {
          name: this.name,
          username: this.username,
          password: this.password,
        };

        this.app.req
          .post("auth/user/register", data)
          .then((response) => {
            this.app.user = response.data;
            this.$router.push("/");
          })
          .catch((error) => {
            this.errors.push(error.response.data.error);
          });
      }
    },
    onSubmitHospital() {
      this.errors = [];

      if (!this.name) {
        this.errors.push("Name is required.");
      }
      if (!this.username) {
        this.errors.push("Username is required.");
      }
      if (!this.password) {
        this.errors.push("Password is required.");
      }
      if (!this.passwordAgain) {
        this.errors.push("Password confirmation is required.");
      }
      if (this.password !== this.passwordAgain) {
        this.errors.push("Passwords dont match");
      }
      if (!this.errors.length) {
        const data = {
          name: this.name,
          username: this.username,
          password: this.password,
        };

        this.app.req
          .post("auth/hospital/register", data)
          .then((response) => {
            this.app.hospital = response.data;
            this.$router.push("/");
          })
          .catch((error) => {
            this.errors.push(error.response.data.error);
          });
      }
    },
  },
};
</script>

<style>
</style>