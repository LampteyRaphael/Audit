import  Vue from  'vue'

import Router from 'vue-router'

Vue.use(Router)

import firstPage from './components/pages/myFirstVuePage'

const routes=[
    {
        'path':'/my-new-vue-router',
         component:firstPage
    }
]


export default new Router({
    mode:'history',
    routes
})
