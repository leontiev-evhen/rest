<template>
  <div id="app">
    <div class="header">
      <div class="col-md-8">
        <a href="/"><img src="../static/img/logo.png" class="logo img-responsive"></a>
      </div>
      <div class="col-md-3">
        <auth-form @login="login" @logout="logout"></auth-form>
      </div>
    </div>
    <div class="line"></div>
    <div class="container">
      <router-view></router-view>
    </div>
  </div>
</template>

<script>
import AuthForm from './components/AuthForm.vue'
export default {
  name: 'app',
  data() {
    return {
      AJAX_URL: 'http://192.168.0.15/~user11',
      assetUrl: 'http://192.168.0.15/~user11/rest/server/api/shop/assets/',
      assetAutoUrl: 'http://192.168.0.15/~user11/rest/server/api/shop/assets/auto/',
      user: null
    }
  },
  methods: {
    login: function() {
      this.user = JSON.parse(localStorage.getItem("profile"))
    },
    logout: function() {
        localStorage.clear()
        location.href = '/';
    }
  },
  created() {
    this.user = JSON.parse(localStorage.getItem("profile"))
  },
  components: {
    AuthForm
  }
}
</script>

<style>

</style>
