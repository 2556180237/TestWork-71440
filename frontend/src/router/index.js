// importing vue router
import { createRouter, createWebHistory } from 'vue-router'

// define routes
const routes = [
  {
    path: '/',
    name: 'login',
    component: () => import('@/views/auth/Login.vue')
  },
  {
    path: '/notes',
    name: 'notes',
    component: () => import('@/views/notes/List.vue')
  },
  {
    path: "/add",
    name: "add",
    component: () => import("@/views/notes/AddNote.vue")
  }
]

// create router
const router = createRouter({
  history: createWebHistory(),
  routes // routes config
})

export default router