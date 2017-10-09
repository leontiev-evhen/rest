<template>
  <div class="row">
    <div class="col-md-12">
        <div class="pblock pblock-primary filterable">
            <div class="pblock-heading">
                <h3 class="panel-title">
                    {{msg}}
                </h3>
            </div>
            <filter-form></filter-form>
        </div>
        <div id="content">
          <div v-if="filter_result">
            <auto-home v-for="item in data" :item="item"></auto-home>
          </div>
          <div class="notfind" v-else>nothing found</div>
        </div>
    </div>
  </div>
</template>


<script>
import AutoHome from './AutoHome.vue'
import FilterForm from './FilterForm.vue'
export default {
  name: 'home',
  data () {
    return {
      msg: 'Auto shop',
      data: [],
      auto: [],
      filter_result: true
    }
  },
  created() {
    this.axios.get(this.$parent.AJAX_URL + '/rest/client/api/auto').then((response) => {

          if (response.status == 200) {
            if (response.data.status) {
              this.auto = response.data.data
              this.data = response.data.data
            } else {
              console.log(response.data.message)
            }
          } else {
            console.log(response.data.message)
          }
    })
  },
  methods: {
      getAuto: function() {
          return this.auto
      }
  },
  components:{
    AutoHome, FilterForm
  }
}
</script>


<style>

</style>
