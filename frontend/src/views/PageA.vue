<template>
  <div
    style="display: flex; justify-content: center; height: 100vh;"
  >
    <div
      v-if="authorized"
      class="form-wrapper"
      style="text-align: center; width: 100%; max-width: 600px; margin-top: 50px;"
    >
      <h1>Private page A</h1>
      <p v-if="user"><b>Username</b>: {{ user.username }}, <b>Phone</b>: {{ user.phone }}</p>
      <label for="magic-link">Current magic link:</label>
      <div style="display: flex; gap: 10px; margin-top: 10px;">
        <input
          id="magic-link"
          type="text"
          v-model="magicLink"
          readonly
          style="flex: 1; padding: 5px;"
        />
        <button @click="copyLink">{{ copied ? 'Copied' : 'Copy' }}</button>
      </div>
      <div style="margin-top: 20px; display: flex; flex-direction: column; gap: 10px;">

        <button @click="regenerateLink" style="padding: 8px 10px;">
          🔄 Regenerate Link
        </button>

        <button
          @click="deactivateLink"
          style="padding: 8px 10px; background-color: #ffe0e0;"
        >
          🚫 Deactivate Link
        </button>

        <button @click="toggleHistoryModal" style="padding: 8px 10px;">
          📜 View Game History
        </button>

        <p v-if="success" style="color: green;">{{ success }}</p>
        <p v-if="error" style="color: red;">{{ error }}</p>

        <div
          @click="play"
          style="
            margin-top: 30px;
            font-size: 100px;
            cursor: pointer;
            transition: transform 0.2s ease;
            user-select: none;
          "
          @mouseover="hovering = true"
          @mouseleave="hovering = false"
          :style="{ transform: hovering ? 'scale(1.1)' : 'scale(1)' }"
        >
          🎲
        </div>
        <p style="margin-top: 10px; font-weight: bold;">I'm feeling lucky</p>
      </div>
    </div>
  </div>

  <div v-if="showHistoryModal" class="modal-overlay" @click.self="showHistoryModal = false">
    <div class="modal-content">
      <h2 style="margin-bottom: 15px;">🕹️ Recent Games</h2>
      <ul v-if="history.length">
        <li v-for="(item, index) in history" :key="index">
          {{ formatDate(item.played_at) }} - 🎲 {{ item.number }} |
          <span v-if="item.win">✅ Win</span>
          <span v-else>❌ Lose</span> |
          💰 {{ item.sum }}
        </li>
      </ul>
      <p v-else>No games played yet</p>
      <button @click="showHistoryModal = false" style="margin-top: 20px;">Close</button>
    </div>
  </div>
</template>


<script setup lang="ts">
import { computed, onMounted, ref } from 'vue'
import { useRoute, useRouter } from 'vue-router'
import { apiFetch } from '@/api'
import { useUserStore } from '@/store/user'
import type { User } from '@/types/User'

const route = useRoute()
const router = useRouter()

const authorized = ref(false)
const magicLink = ref('')
const copied = ref(false)
const hovering = ref(false)
const error = ref('')
const success = ref('')
const showHistoryModal = ref(false)

const userStore = useUserStore()
const user = computed<User | null>(() => userStore.user)

const history = ref<{ number: number; win: boolean; sum: number; played_at: string }[]>([])

onMounted(() => {
  const token = route.query.token || localStorage.getItem('magic_token')
  magicLink.value = localStorage.getItem('magic_link') || ''

  if (token && typeof token === 'string') {
    localStorage.setItem('magic_token', token)
    authorized.value = true
    router.replace({ path: route.path })
  } else {
    authorized.value = false
    router.push({ name: 'UserRegister' })
  }
})

const copyLink = async () => {
  try {
    await navigator.clipboard.writeText(magicLink.value)
    copied.value = true
    setTimeout(() => copied.value = false, 1000)
  } catch (err) {
    console.error('Copy failed', err)
  }
}

const regenerateLink = async () => {
  error.value = ''
  success.value = ''

  const res = await apiFetch('/auth/regenerate', { method: 'POST' })

  if (res && res.data?.link) {
    success.value = 'Link regenerated'

    const link = res.data.link
    const url = new URL(link)
    const token = url.searchParams.get('token') || ''

    localStorage.setItem('magic_link', link)
    localStorage.setItem('magic_token', token)

    magicLink.value = link
  } else {
    error.value = res?.message || 'Failed to regenerate'
  }
}

const deactivateLink = async () => {
  await apiFetch('/auth/deactivate', { method: 'POST' })

  localStorage.removeItem('magic_token')
  localStorage.removeItem('magic_link')
  localStorage.removeItem('user')

  await router.push({ name: 'UserRegister' })
}

const play = async () => {
  error.value = ''
  success.value = ''

  const res = await apiFetch('/game/play')

  if (res && res.data) {
    const { number, win, sum } = res.data

    success.value = `🎲 Rolled ${number} — ${win ? '🎉 You win!' : 'You lose'} ${win ? `Prize: ${sum}` : ''}`
  } else {
    error.value = res?.message || 'Failed to play'
  }
}

const toggleHistoryModal = async () => {
  await retrieveRecentHistory()

  showHistoryModal.value = true
}

const retrieveRecentHistory = async () => {
  const res = await apiFetch('/game/history')

  if (res && Array.isArray(res.data)) {
    history.value = res.data
  } else {
    console.error('Failed to fetch history')
  }
}

const formatDate = (raw: string) => {
  const date = new Date(raw)
  return date.toLocaleString(undefined, {
    year: 'numeric',
    month: '2-digit',
    day: '2-digit',
    hour: '2-digit',
    minute: '2-digit',
    second: '2-digit'
  })
}
</script>
<style>
.modal-overlay {
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: rgba(0,0,0,0.5);
  display: flex;
  justify-content: center;
  align-items: center;
  z-index: 1000;
}

.modal-content {
  background: white;
  padding: 25px;
  border-radius: 10px;
  width: 90%;
  max-width: 500px;
  max-height: 80vh;
  overflow-y: auto;
  text-align: left;
}
</style>