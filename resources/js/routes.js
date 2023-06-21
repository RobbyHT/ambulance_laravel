const routes = [
  {
    path: '/',
    name: 'home',
    component: () => import('./pages/Home.vue'),
    meta: { layout: true }
  },
  {
    path: '/about',
    name: 'about',
    component: () => import('./pages/About.vue'),
    meta: { layout: true }
  },
  {
    path: '/userAdmin',
    name: 'userAdmin',
    component: () => import('./pages/user/user_index.vue'),
    meta: { layout: true }
  },
  {
    path: '/carAdmin',
    name: 'carAdmin',
    component: () => import('./pages/car/car_index.vue'),
    meta: { layout: true }
  },
  {
    path: '/equipment',
    name: 'equipment',
    component: () => import('./pages/equipment/equipment_index.vue'),
    meta: { layout: true }
  },
  {
    path: '/preferential',
    name: 'preferential',
    component: () => import('./pages/preferential/preferential_index.vue'),
    meta: { layout: true }
  },
  {
    path: '/customer',
    name: 'customer',
    component: () => import('./pages/customer/customer_index.vue'),
    meta: { layout: true }
  },
  {
    path: '/evaluation',
    name: 'evaluation',
    component: () => import('./pages/evaluation/evaluation.vue'),
    meta: { layout: true }
  },
  {
    path: '/analysisAdmin',
    name: 'analysisAdmin',
    component: () => import('./pages/analysis/analysis.vue'),
    meta: { layout: true }
  },
  {
    path: '/companyKey',
    name: 'companyKey',
    component: () => import('./pages/companyKey/companyKey.vue'),
    meta: { layout: true }
  },
  {
    path: '/form',
    name: 'form',
    component: () => import('./pages/form/form.vue'),
    meta: { layout: false }
  },
]

export default routes;