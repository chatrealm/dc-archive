<template>
	<div class="columns is-centered" v-if="loading || error">
		<div class="column is-half is-narrow">
			<div class="control is-loading" v-if="loading">
				Loading Streams...
			</div>
			<template v-else>
				Error: {{ error }}
			</template>
		</div>
	</div>
	<div class="columns is-multiline" v-else>
		<div class="column is-one-third" v-for="show in shows" :key="show.id">
			<a class="live-stream-box" :href="livehubUrl + '/#/' + show.slug">
				<p class="live-stream-title">{{ show.name }}</p>

				<a class="live-stream-link"
					target="_blank"
					rel="noopener noreferrer"
					v-for="stream in show.streams"
					:key="stream.id"
					:href="stream.url">
					<span class="tag">{{ stream.service }}</span>
					<span>{{ stream.title }}</span>
				</a>
			</a>
		</div>
		<div class="column is-half" v-if="shows.length === 0">No streams are currently live</div>
	</div>
</template>

<script>
	import axios from 'axios'

	export default {
		computed: {
			configUrl() {
				return this.livehubUrl + '/live/config';
			},
			shows() {
				const result = []
				const shows = {}

				this.config.streams.data.forEach(stream => {
					if (stream.state !== 'live') {
						return;
					}

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
				error: null,
				loading: true
			}
		},
		mounted() {
			this.getData()
		},
		methods: {
			async getData() {
				this.loading = true
				this.error = null
				try {
					const res = await axios.get(this.configUrl)
					this.config = res.data
				} catch(err) {
					this.error = err.message;
				}
				this.loading = false
			}
		},
		props: {
			livehubUrl: {
				required: true,
				type: String
			}
		}
	}
</script>
