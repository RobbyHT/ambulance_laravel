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
    path: '/analysisAdmin',
    name: 'analysisAdmin',
    component: () => import('./Pages/analysis/analysis.vue')
  },
  {
    path: '/evaluation',
    name: 'evaluation',
    component: () => import('./Pages/evaluation/evaluation.vue')
  },
]

export default routes;