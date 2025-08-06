export const routes = [
  {
    path: '/',
    name: 'UserRegister',
    component: () => import('@/views/UserRegister.vue'),
  },
  {
    path: '/magic-link',
    name: 'ShowMagicLink',
    component: () => import('@/views/MagicLink.vue'),
  },
  {
    path: '/page-a',
    name: 'PageA',
    component: () => import('@/views/PageA.vue'),
    meta: {
      requiresAuth: true
    }
  }
]
