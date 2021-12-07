const routes = [
  {
    path: '/',
    name: 'home',
    component: () => import('./Pages/Home.vue'),
  },
  {
    path: '/about',
    name: 'about',
    component: () => import('./Pages/About.vue')
  },
  {
    path: '/userAdmin',
    name: 'userAdmin',
    component: () => import('./Pages/user/user_index.vue')
  },
  {
    path: '/carAdmin',
    name: 'carAdmin',
    component: () => import('./Pages/car/car_index.vue')
  },
  {
    path: '/equipment',
    name: 'equipment',
    component: () => import('./Pages/equipment/equipment_index.vue')
  },
  {
    path: '/preferential',
    name: 'preferential',
    component: () => import('./Pages/preferential/preferential_index.vue')
  },
  {
    path: '/customer',
    name: 'customer',
    component: () => import('./Pages/customer/customer_index.vue')
  },
  {
    path: '/evaluation',
    name: 'evaluation',
    component: () => import('./Pages/evaluation/evaluation.vue')
  },
  {
    path: '/analysisAdmin',
    name: 'analysisAdmin',
    component: () => import('./Pages/analysis/analysis.vue')
  },
  {
    path: '/companyKey',
    name: 'companyKey',
    component: () => import('./Pages/companyKey/companyKey.vue')
  },
]

export default routes;