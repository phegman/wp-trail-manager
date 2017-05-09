<template>
	<div class="shortcode-generator">
		<div class="form-group">
			<label>Show Title</label>
			<select class="form-control" v-model="showTitle">
				<option :value="true">True</option>
				<option :value="false">False</option>
			</select>
		</div><!-- /.form-group -->
		<div class="form-group">
			<label>Show Description</label>
			<select class="form-control" v-model="showDescription">
				<option :value="true">True</option>
				<option :value="false">False</option>
			</select>
		</div><!-- /.form-group -->
		<code>
			[trail-manager post-id="{{ postId }}" show-title="{{ showTitle }}" show-description="{{ showDescription }}"]
		</code>
	</div><!-- /.shortcode-generator -->
</template>

<script>
	export default {
		data() {
			return {
				showTitle: true,
				showDescription: true,
			}
		},
		props: {
			postId: {
				type: Number,
				required: true
			}
		}
	}
</script>