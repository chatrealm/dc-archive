<template>
	<div>
		<div class="columns is-multiline" v-if="!loading">
			<div class="column is-one-third" v-for="show in shows" :key="show.id">
				<a class="live-stream-box">
					<p class="title is-4">{{ show.name }}</p>

					<a class="live-stream-link"
						target="_blank"
						rel="noopener noreferrer"
						v-for="stream in show.streams"
						:key="stream.id"
						:href="stream.video_url">
						{{ stream.title }}
					</a>
				</a>
			</div>
		</div>
	</div>
</template>

<script>
	import axios from 'axios'

	export default {
		computed: {
			shows() {
				const result = []
				const shows = {}

				this.config.streams.data.forEach(stream => {
					const show_id = stream.show_id
					if (!shows[show_id]) {
						const show_data = stream.show.data
						shows[show_id] = Object.assign({ streams: [] }, show_data)
						result.push(shows[show_id])
					}
					const show = shows[show_id]

					show.streams.push(stream)
				})

				return result
			}
		},
		data() {
			return {
				config: {
					streams: {
						data: []
					}
				},
				loading: true
			}
		},
		mounted() {
			this.getData()
		},
		methods: {
			async getData() {
				const res = await axios.get(this.configUrl)
				this.config = res.data
				this.loading = false
			}
		},
		props: {
			configUrl: {
				required: true,
				type: String
			}
		}
	}
</script>
