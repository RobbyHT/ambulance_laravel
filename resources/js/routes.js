const routes = [
  {
    path: '/',
    name: 'home',
    component: () => import('./pages/Home.vue'),
  },
  {
    path: '/about',
    name: 'about',
    component: () => import('./pages/About.vue')
  },
  {
    path: '/userAdmin',
    name: 'userAdmin',
    component: () => import('./pages/user/user_index.vue')
  },
  {
    path: '/carAdmin',
    name: 'carAdmin',
    component: () => import('./pages/car/car_index.vue')
  },
  {
    path: '/equipment',
    name: 'equipment',
    component: () => import('./pages/equipment/equipment_index.vue')
  },
  {
    path: '/preferential',
    name: 'preferential',
    component: () => import('./pages/preferential/preferential_index.vue')
  },
  {
    path: '/customer',
    name: 'customer',
    component: () => import('./pages/customer/customer_index.vue')
  },
  {
    path: '/evaluation',
    name: 'evaluation',
    component: () => import('./pages/evaluation/evaluation.vue')
  },
  {
    path: '/analysisAdmin',
    name: 'analysisAdmin',
    component: () => import('./pages/analysis/analysis.vue')
  },
  {
    path: '/companyKey',
    name: 'companyKey',
    component: () => import('./pages/companyKey/companyKey.vue')
  },
]

export default routes;