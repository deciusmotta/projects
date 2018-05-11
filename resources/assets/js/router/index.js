import Vue from 'vue'
import VueRouter from 'vue-router'
import project from './project'
import user from './user'
Vue.use(VueRouter)
let router = new VueRouter({
    routes:[project, user],
})

export default router


