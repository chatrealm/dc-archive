import Vue from 'vue'
import axios from 'axios'
import './components'


// configure axios
axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest'
const token = document.head.querySelector('meta[name="csrf-token"]');

if (token) {
	axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
}

Vue.prototype.$http = axios

// create app
const app = new Vue({
	el: '#app'
})
