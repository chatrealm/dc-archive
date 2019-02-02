import Vue from 'vue'
import axios from 'axios'
import * as components from './components'
import './navbar'

// configure axios instance for requests on same domain
const headers = {
	'X-Requested-With': 'XMLHttpRequest'
}
const token = document.head.querySelector('meta[name="csrf-token"]');

if (token) {
	headers['X-CSRF-TOKEN'] = token.content;
}

Vue.prototype.$http = axios.create({
	headers
})

document.querySelectorAll('[data-component]').forEach(el => {
	const component = el.getAttribute('data-component')
	if (!(component in components)) {
		console.error('Missing component', component, el)
		return
	}
	let props = {}
	const rawData = el.getAttribute('data-props')
	if (rawData) {
		props = JSON.parse(rawData)
	}
	new Vue({
		el,
		render(h) {
			return h(components[component], {props})
		}
	})
})
