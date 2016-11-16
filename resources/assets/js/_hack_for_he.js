// This is to deal with he requirement not being removed in browser parser build
// https://github.com/vuejs/vue/blob/a4fcdbe6731ca4a0ef6a3f94ef06d56cc92636f7/src/compiler/parser/entity-decoder.js#L15
const decoder = document.createElement('div')
export function decode (html) {
	decoder.innerHTML = html
	return decoder.textContent
}
