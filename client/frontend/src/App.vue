<template>
  <div id="app">
    <div class="header">
      <a href="/"><img src="../static/img/logo.png" class="logo img-responsive"></a>
    </div>
    <div class="line"></div>
    <div class="container">
      <router-view></router-view>
    </div>
  </div>
</template>

<script>
export default {
  name: 'app',
  data() {
    return {
      AJAX_URL: 'http://192.168.0.15/~user11/soap/soap_autoshop/client/index.php',
      assetUrl: 'http://192.168.0.15/~user11/soap/soap_autoshop/server/assets/',
      assetAutoUrl: 'http://192.168.0.15/~user11/soap/soap_autoshop/server/assets/auto/',
    }
  }
}
</script>

<style>

</style>
