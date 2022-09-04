import Vue from 'vue'
import Vuex from 'vuex'
import axios from 'axios'
import CartList from './cartlist'

Vue.use(Vuex)
console.log('store/index.js import')

export default new Vuex.Store({
    modules: {
        CartList
    }
})
