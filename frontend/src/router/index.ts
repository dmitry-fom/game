import { createRouter, createWebHistory } from 'vue-router'
import { routes } from './routes'
import { useUserStore } from '@/store/user'

const router = createRouter({
  history: createWebHistory(),
  routes
})

router.beforeEach(async (to, from, next) => {
  const tokenFromUrl = to.query.token as string

  if (tokenFromUrl) {
    localStorage.setItem('magic_token', tokenFromUrl)

    return next({ path: to.path, query: {} })
  }

  const token = localStorage.getItem('magic_token')

  const publicPaths = ['/', '/magic-link']
  const isPublic = publicPaths.some(path => to.path.startsWith(path))

  if (!token && !isPublic) {
    return next({ path: '/' })
  }

  const userStore = useUserStore()


  if (token && !userStore.fetched) {
    try {
      await userStore.fetchUser()
    } catch {
      localStorage.removeItem('magic_token')

      return next({ path: '/' })
    }
  }

  next()
})
export default router
