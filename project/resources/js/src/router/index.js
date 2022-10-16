import Vue from 'vue'
// 引入 router 插件
import VueRouter from 'vue-router'
Vue.use(VueRouter)

// 引入 Components
import indexComponent from '../../components/pages/indexComponent'
import categoryComponent from '../../components/pages/categoryComponent'
import searchComponent from '../../components/pages/searchComponent'
import articleComponent from '../../components/pages/articleComponent'
import productComponent from '../../components/pages/productComponent'
import userComponent from '../../components/pages/userComponent'
import cartComponent from '../../components/pages/cartComponent'
import payComponent from '../../components/pages/payComponent'

export default new VueRouter({
    mode:'history',
    routes:[
        {
            path: '/',
            component: indexComponent
        },
        {
            path: '/category/:category',
            component: categoryComponent
        },
        {
            path: '/category/:category/page/:page',
            component: categoryComponent
        },
        {
            path: '/search/:search',
            component: searchComponent
        },
        {
            path: '/article/:article',
            component: articleComponent
        },
        {
            path: '/product/:product',
            component: productComponent
        },
        {
            path: '/user/:user',
            component: userComponent
        },
        {
            path: '/user/cart/:user',
            component: cartComponent
        },
        {
            path: '/user/pay/:user',
            component: payComponent
        }

    ]
})