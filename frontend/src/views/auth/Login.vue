<template>
  <div class="container-fluid mt-5">
    <div class="row justify-content-center">
      <div class="col-md-4">
        <div
            v-if="loginFailed"
            class="alert alert-danger">
          Your email or password is wrong.
        </div>
        <div class="card border-0 rounded shadow">
          <div class="card-body">
            <h4>TestWork-71440</h4>
            <hr>
            <form @submit.prevent="login">
              <div class="form-group">
                <label>E-mail:</label>
                <input
                    type="email"
                    v-model="user.email"
                    class="form-control"
                    placeholder="e-mail address">
              </div>

              <div
                  v-if="validation.email"
                  class="mt-2 alert alert-danger">
                {{ validation.email[0] }}
              </div>

              <div class="form-group">
                <label>Password</label>
                <input
                    type="password"
                    v-model="user.password"
                    class="form-control"
                    placeholder="Password">
              </div>
              <div
                  v-if="validation.password"
                  class="mt-2 alert alert-danger">
                {{ validation.password[0] }}
              </div>
              <div class="col-md-12 text-center">
                <button
                    type="submit"
                    class="m-1 btn btn-primary btn-block">
                  Enter
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>

import { reactive, ref } from 'vue'
import { useRouter } from 'vue-router'
import axios from 'axios'

export default {
  setup() {
    const router = useRouter()
    const user = reactive({
      email: 'foo.bar@example.com',
      password: 'abcd',
    })

    const validation = ref([])
    const loginFailed = ref(null)

    function login() {
      let email = user.email
      let password = user.password

      axios.post('http://localhost:8000/api/login', {
        email,
        password
      }).then(res => {
        if (res.data.success) {
          localStorage.setItem('token', res.data.data.token)
          return router.push({
            name: 'notes'
          })
        }
        loginFailed.value = true
      }).catch(error => {
        validation.value = error.response.data
      })
    }
    return {
      user,
      validation,
      loginFailed,
      login
    }
  }
}
</script>