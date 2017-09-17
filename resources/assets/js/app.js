import 'babel-polyfill'

import Vue from 'vue'
import axios from 'axios'
import './components'

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

// create app
const app = new Vue({
	el: '#app'
})
