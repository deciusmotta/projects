import Vue from 'vue'
import VueRouter from 'vue-router'
import project from './project'
import user from './user'
import dashboard from './dashboard'
Vue.use(VueRouter)
let router = new VueRouter({
    routes:[
        dashboard,
        project, 
        user
    ],
})

export default router


