import Vue from 'vue'
// 引入Vuex
import Vuex from 'vuex'
// Vue 使用插件 Vuex
Vue.use(Vuex)

// 配置 action 動作, 提供給使用者在組件中觸發
// 會在此階段呼叫 API
const actions = {}
// 準備 mutations 方法, 在 actoin 被觸發後執行完相關動作, 會 commit 到指定的 mutations 方法, 再由此方法修改 state 內容
const mutations = {}
// 保存共用數據的地方
const state = {}

// 新建一個 Vuex 實例
export default new Vuex.Store({
	actions,
	mutations,
	state
})