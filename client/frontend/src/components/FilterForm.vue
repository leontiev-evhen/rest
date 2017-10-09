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

					var filterModel = (el) => {
						if (el.model_id == this.model_id.value || this.model_id == '') {
							return true
						}
						return false
					}

					var filterYear = (el) => {
						if (el.year == this.year || this.year == '') {
							return true
						}
						return false
					}

					var filterEngineCapacity = (el) => {
						if (el.engine_capacity == this.engine_capacity || this.engine_capacity == ''){
							return true
						}
						return false
					}

					var filterColor = (el) => {
						if (el.color == this.color || this.color == '') {
							return true
						}
						return false
					}

					var filterMaxSpeed = (el) => {
						if (el.max_speed <= this.max_speed || this.max_speed == '') {
							return true
						}
						return false
					}

					var filterPrice = (el) => {
						if (el.price <= this.price || this.price == '') {
							return true
						}
						return false
					}
					
					var auto = this.$parent.data.filter((el) => {
						return filterModel(el) && filterYear(el) && filterEngineCapacity(el) && filterColor(el) && filterMaxSpeed(el) && filterPrice(el)
					})

					if (auto.length != 0) {
						this.$parent.data = auto
						this.$parent.filter_result = true
					} else {
						this.$parent.filter_result = false
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
	    	this.$parent.filter_result = true
  		},
  	},
  	created() {
  		this.axios.get(this.$parent.$parent.AJAX_URL + '/rest/client/api/model').then((response) => {

	        if (response.status == 200) {
	            if (response.data.status) {
	                for (var key in response.data.data) {
						var obj = {
							label: response.data.data[key].name,
							value: response.data.data[key].id
						}
						this.params.models.push(obj)
					}
	            } else {
	              console.log(response.data.message)
	            }
	        } else {
	            	console.log(response.data.message)
	        }
    	})
  	},
  	components: {
    	RangeSlider, vSelect
  	}
}
</script>


<style>

</style>
