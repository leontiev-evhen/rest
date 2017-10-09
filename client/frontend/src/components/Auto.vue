<template>
	<div class="" v-if="result">
		<div class="col-md-6 center">
			<img :src="this.$parent.assetAutoUrl+data.image">
			<div class="price">
				Price: {{data.price}} <span class="glyphicon glyphicon-eur"></span>
			</div>
		</div>
		<div class="col-md-6">
			<h4><span class="glyphicon glyphicon-arrow-right"></span> {{data.MODEL_NAME}}</h4>
			<hr>
			<ul class="description">
				<li><span class="glyphicon glyphicon-tint"></span>Color: {{data.color}}</li>
				<li><span class="glyphicon glyphicon-chevron-right"></span>Year: {{data.year}}</li>
				<li><span class="glyphicon glyphicon-info-sign"></span>Engine capacity: {{data.engine_capacity}} L</li>
				<li><span class="glyphicon glyphicon-plane"></span>Max speed: {{data.max_speed}} km/h</li>
			</ul>
			<hr>
			<div v-if="this.$parent.user">
				<pre-order-form></pre-order-form>
			</div>
		</div>
	</div>
	<div v-else>
		{{error}}
	</div>
</template>

<script>
	import PreOrderForm from './PreOrderForm.vue'
	export default {
  	name: 'Auto',
  	data() {
  		return {
  			data: [],
  			result: true,
  			error: '',
  		}
  	},
  	created() {
	    this.axios.get(this.$parent.AJAX_URL + '/rest/client/api/auto/' + this.$route.params.id).then((response) => {
          
          if (response.status == 200) {
            if (response.data.status) {
              this.data = response.data.data
            } else {
              	this.result = false
	      		this.error = response.data.message;
            }
          } else {
            console.log(response.statusText)
          }
    	})
  	},
  	components: {
  		PreOrderForm
 	}
}
</script>
<style>

</style>
