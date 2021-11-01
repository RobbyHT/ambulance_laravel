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
]

export default routes;