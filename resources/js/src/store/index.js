import Vue from 'vue'
// 引入Vuex
import Vuex from 'vuex'
// Vue 使用插件 Vuex
Vue.use(Vuex)

import Menu from './menu.js'
import Banner from './article/banner.js'
import newArrival from './product/newArrival.js'
import Cart from './cart.js'

// 新建一個 Vuex 實例
export default new Vuex.Store({
	modules: {
		Menu,
		Banner,
		newArrival,
		Cart
	}
})