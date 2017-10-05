<template>
	<div class="collapse navbar-collapse" id="navbar-main">
	      <form @submit.prevent="filterAuto">
	      
	        <div class="col-md-4 filter_model">
	          	<v-select :options="params.models" placeholder="Model" v-model="model_id"></v-select>
	        </div>
	        <ul class="lnav col-md-8">
	        <li class="lform"> 
	       		<select v-model="year" v-validate="'required'" :class="{'list lform-control': true, 'is-danger': errors.has('year') }" name="year">
			      	<option value="" disabled selected>Year</option>
			      	<option v-for="year in params.years" :value="year">{{year}}</option>
			    </select>
	        </li>
	        <li class="lform"> 
	        	<select class="lform-control" v-model="engine_capacity">
	            	<option value="" disabled selected>Value</option>
	            	<option v-for="value in params.values" :value="value">{{value}}</option>
	          	</select>
	        </li>
	        <li class="lform"> 
	          	<select class="lform-control" v-model="color">
	           		<option value="" disabled selected>Color</option>
	            	<option v-for="color in params.colors" :value="color">{{color}}</option>
	          	</select>
	        </li>
	        <li class="lform"> 
	        	<p class="value">{{max_speed}} km/h</p>
	         	<range-slider
			    class="slider"
			    min="10"
			    max="350"
			    step="10"
			    v-model="max_speed"
			    >
			  </range-slider>
	        </li>
	        <li class="lform"> 
	        	<p class="value">{{price}} EUR</p>
	         	<range-slider
			    class="slider"
			    min="1000"
			    max="10000"
			    step="10"
			    v-model="price"
			    >
			    </range-slider>
	        </li>
	        <li class="lform"><button id="filter" type="submit">Filter</button></li>
	        <li class="lform"><button id="filter" @click="clearFilter">Clear</button></li>
	    </ul>
	    </form>
	</div>
</template>
<script>
import RangeSlider from 'vue-range-slider'
import 'vue-range-slider/dist/vue-range-slider.css'
import vSelect from "vue-select"
export default {
  name: 'FilterForm',
  data () {
    return {
    	model_id: '',
    	year: '',
    	price: 0,
    	engine_capacity: '',
    	color: '',
    	max_speed: 0,
    	selected: null,
    	options: [{label:'Mercedes-Benz C', value: 1}, {label: 'Mercedes-Benz Z', value: 2}],
    	params: {
			models: [],
			years:  [2010, 2011, 2012,2013, 2014, 2015, 2016, 2017],
			values: [1, 2, 3, 4, 5],
			colors: ['black', 'white', 'red', 'blue', 'grey']
    	},

    }
  },
  methods: {
  		filterAuto: function() {
  			this.$validator.validateAll().then((result) => {
		        if (result) {
					var xhr = new XMLHttpRequest();
				    var params = "action=filter&model_id=" + ((this.model_id.value) ? this.model_id.value : 0) + "&year="+this.year+"&engine_capacity="+this.engine_capacity+"&color="+this.color+"&max_speed="+this.max_speed+"&price="+this.price;
				    xhr.open('POST', this.$parent.$parent.AJAX_URL, false);
				    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
				    xhr.send(params);

				    if (xhr.status != 200) {
				      	console.log( xhr.status + ': ' + xhr.statusText );
				    } else {
				      	var result = JSON.parse(xhr.responseText)
				      	if (result.status) {
							this.$parent.data = result.auto;
							this.$parent.filter_result = true
				      	} else {
				      		this.$parent.filter_result = false

				      	}
				    }
				}
			});
  		},
  		clearFilter: function() {
  			this.model_id = '',
	    	this.year = '',
	    	this.price = 0,
	    	this.engine_capacity = '',
	    	this.color = '',
	    	this.max_speed = 0
	    	this.$parent.data = this.$parent.getAuto()
  		},
  	},
  	created() {

  		var xhr = new XMLHttpRequest()
	    var params = "action=getModel"
	    xhr.open('POST', this.$parent.$parent.AJAX_URL, false)
	    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded")
	    xhr.send(params);

	    if (xhr.status != 200) {
	      	console.log( xhr.status + ': ' + xhr.statusText )
	    } else {
	      	var result = JSON.parse(xhr.responseText)
	      	if (result.status) {
				for (var key in result.model) {
					var obj = {label: result.model[key].name, value: result.model[key].id}
					this.params.models.push(obj)
				}
	      	} else {
	      		console.log(result.message)
	      	}
	    }
  	},

  	components: {
    	RangeSlider, vSelect
  	}
}
</script>


<style>

</style>
