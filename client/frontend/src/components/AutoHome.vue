<template>
	<div class="auto col-md-2">
		<h4>{{item.MARK_NAME}}</h4>
		<div class="auto_img">
			<img :src="this.$parent.$parent.assetUrl+item.IMAGE">
		</div>
		<div class="auto_model">
			<a :href="'#/auto/'+item.ID">{{item.MODEL_NAME}}</a>
		</div>
		<hr>
	</div>

</template>

<script>
	export default {
  	name: 'AutoHome',
  	props: ['item']
}
</script>

<style>

</style>