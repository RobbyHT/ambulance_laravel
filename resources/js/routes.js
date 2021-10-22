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
    path: '/newsAdd',
    name: 'newsAdd',
    component: () => import('./Pages/news/news_add.vue')
  },
]

export default routes;