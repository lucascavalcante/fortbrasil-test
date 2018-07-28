import Vue from 'vue'
import Router from 'vue-router'
import Customer from '@/components/Customer'

Vue.use(Router)

export default new Router({
  routes: [
    {
      path: '/',
      name: 'Customer',
      component: Customer
    }
  ]
})
