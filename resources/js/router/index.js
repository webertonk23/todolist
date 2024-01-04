import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../components/Home.vue'
import ListasView from '../components/Listas.vue'

const routes = [
  {
    path: '/',
    name: 'home',
    component: HomeView
  },
  {
    path: '/listas',
    name: 'listas',
    component: ListasView
  },
  // {
  //   path: '/lojas/edit/:id',
  //   name: 'lojasEdit',
  //   component: LojasEdit
  // },
]

const router = createRouter({
  history: createWebHistory(),
  routes
})

export default router
