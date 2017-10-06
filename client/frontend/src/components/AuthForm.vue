<template>
	<div class="auth_form">
		<form @submit.prevent="validForm">
			<p :class="{ 'control': true }"><input v-model="email" v-validate="'required|email'" :class="{'input form-control': true, 'is-danger': errors.has('email') }" type="text" name="email" placeholder="Email"></p>
			<span v-show="errors.has('email')" class="help is-danger">{{ errors.first('email') }}</span>

			<p :class="{ 'control': true }"><input v-model="password" v-validate="'required|alpha'" :class="{'input form-control': true, 'is-danger': errors.has('password') }"type="password" name="password" placeholder="Password"></p>
			<span v-show="errors.has('password')" class="help is-danger">{{ errors.first('password') }}</span>
			
			<p><button type="submit" class="btn btn-primary">Submit</button>
			<a class="register_link" href="#/register">Register</a></p>
		</form>
	</div>
</template>

<script>
	export default {
  	name: 'PreOrderForm',
  	data() {
  		return {
			email: '',
			password: '',
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
	    
				    this.axios.post('http://courses.site/rest/client/api/orders', {
				    	auto_id: +this.$route.params.id,
				    	user_id: 1,
				    	name: this.name,
				    	surname: this.surname,
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
