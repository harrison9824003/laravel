import Vue from 'vue'
// 引入 router 插件
import VueRouter from 'vue-router'
Vue.use(VueRouter)

// 引入 Components
import Product from '../../components/ProductComponent'

export default new VueRouter({
    routes:[
        {
            path: '/product',
            component: Product
        }
    ]
})