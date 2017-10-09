<template>
	<div class="form col-md-6 mt-30">
		<h4>Pre-order</h4>
		<div class="success" v-if="result_form">Success send</div>
		<div v-else>
			<form @submit.prevent="validForm">

				<p :class="{ 'control': true }"><select v-model="payment_id" v-validate="'required'" :class="{'list form-control': true, 'is-danger': errors.has('payment_id') }" name="payment_id">
			      		<option value="" disabled selected>Choose payment</option>
			      		<option value="1">card</option>
			      		<option value="2">cash</option>
			    </select>
			    </p>
			    <span v-show="errors.has('payment')" class="help is-danger">{{ errors.first('payment') }}</span>

				<p><button type="submit" class="btn btn-primary">Submit</button></p>
			</form>
		</div>
	</div>

</template>

<script>
	export default {
  	name: 'PreOrderForm',
  	data() {
  		return {
			payment_id: '',
			result_form: false
  		}
  	},
  	methods: {
  		validForm: function() {
  			var self = this
			this.$validator.validateAll().then((result) => {
		        if (result) {
		        	let config = {
					  headers: {
					    'Content-Type' : 'application/x-www-form-urlencoded'
					  }
					}
	    	
				    this.axios.post(this.$parent.$parent.AJAX_URL + '/rest/client/api/orders', {
				    	auto_id: +this.$route.params.id,
				    	user_id: +this.$parent.$parent.user.id,
				    	payment_id: +this.payment_id
				    }, config)  
				    .then(function (response) {
				    	self.result_form = true
					})
					.catch(function (error) {
					    console.log(error);
					});
			    	
		        }
     		});
		}
  	}
}
</script>
<style>

</style>
