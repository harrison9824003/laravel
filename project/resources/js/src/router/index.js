import Vue from 'vue'
// 引入 router 插件
import VueRouter from 'vue-router'
Vue.use(VueRouter)

// 引入 Components
import indexComponent from '../../components/pages/indexComponent'

export default new VueRouter({
    routes:[
        {
            path: '/',
            component: indexComponent
        }
    ]
})