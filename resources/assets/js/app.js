import Vue from 'vue'
import VueResource from 'vue-resource'

Vue.use(VueResource)

const csrfToken = document.querySelector('meta[name="csrf-token"]')

if (csrfToken) {
	Vue.http.interceptors.push((request, next) => {
		request.headers.set('X-CSRF-TOKEN', csrfToken.getAttribute('content'))

		next()
	})
}

// Vue

const app = new Vue({
	el: '#app'
})
