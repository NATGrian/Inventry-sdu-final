<template>
	<div class="image">
		<image-preview :preview="value" @close="$emit('input', null)" v-if="value"></image-preview>
		<div class="image__upload" v-else>
			<input type="file" accept="image/*" @change="upload">
		</div>
	</div>
</template>
<script type="text/javascript">
	import ImagePreview from '../ImagePreview.vue'
	export default {
		components: {
			ImagePreview
		},
		props: {
			value: {
			    type: [String, File],
			    default: null
			}
		},
		methods: {

			upload(e) {
				const files = e.target.files
				if (files && files.length > 0) {
				  this.$emit('input', files[0])
				}
			}
		}
	}
</script>
<style>
.image {
	width: 70px;
	height: 70px;
}
.image__upload {
		width: 200px;
	height: 100%;
}
</style>