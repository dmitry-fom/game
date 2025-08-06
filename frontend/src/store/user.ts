import { defineStore } from 'pinia'
import { apiFetch } from '@/api.ts'
import type { User } from '@/types/User'

export const useUserStore = defineStore('user', {
  state: () => ({
    user: null as User | null,
    fetched: false,
  }),
  actions: {
    async fetchUser() {
      if (this.fetched) return

      try {
        const res = await apiFetch('/auth/me')
        this.user = res.data
        this.fetched = true
      } catch {
        this.user = null
        this.fetched = true

        localStorage.removeItem('magic_token')
      }
    }
  }
})