import Vue from 'vue'
import Router from 'vue-router'
import Home from '@/components/Home'
import PageNotFound from '@/components/PageNotFound'
import Auto from '@/components/Auto'

Vue.use(Router)

export default new Router({
  routes: [
    {
      path: '/',
      name: 'home',
      component: Home
    },
    {
      path: '/auto/:id',
      name: 'Auto',
      component: Auto
    },
    {
      path: '*',
      name: 'PageNotFound ',
      component: PageNotFound 
    },
  ]
})
