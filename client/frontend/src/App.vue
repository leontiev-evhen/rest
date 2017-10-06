<template>
  <div id="app">
    <div class="header">
      <div class="col-md-8">
      <a href="/"><img src="../static/img/logo.png" class="logo img-responsive"></a>
      </div>
      <div class="col-md-3">
        <auth-form></auth-form>
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
      assetUrl: 'http://courses.site/rest/server/api/shop/assets/',
      assetAutoUrl: 'http://courses.site/rest/server/api/shop/assets/auto/',
    }
  },
  components: {
    AuthForm
  }
}
</script>

<style>

</style>
