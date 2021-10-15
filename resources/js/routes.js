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
]

export default routes;