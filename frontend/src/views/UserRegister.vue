<template>
  <div class="register-wrapper">
    <div class="register-form">
      <h1>Register</h1>
      <form @submit.prevent="submit">
        <label for="username">Username:</label>
        <input id="username" v-model="form.username" required />

        <label for="phone">Phone number:</label>
        <input id="phone" v-model="form.phone" required />

        <button type="submit">Submit</button>

        <p v-if="error" class="error-message">{{ error }}</p>
      </form>
    </div>
  </div>
</template>

<script setup lang="ts">
import { reactive, ref } from 'vue'
import { useRouter } from 'vue-router'
import { apiFetch } from '@/api.ts'

const router = useRouter()
const form = reactive({
  username: '',
  phone: ''
})
const error = ref('')

const submit = async () => {
  error.value = ''
  try {
    const res = await apiFetch('/auth/register', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify(form)
    })

    if (res.data.link) {
      localStorage.setItem('magic_link', res.data.link)

      await router.push({ name: 'ShowMagicLink', state: { link: res.data.link } })
    } else {
      error.value = res.data.message || 'Registration error'
    }
  } catch (e) {
    error.value = 'Network error'
  }
}
</script>

<style scoped>
.register-wrapper {
  display: flex;
  justify-content: center;
  align-items: center;
  height: 100vh;
  background-color: #f9f9f9;
}

.register-form {
  background: #ffffff;
  padding: 40px;
  border-radius: 12px;
  box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
  width: 350px;
}

h1 {
  text-align: center;
  margin-bottom: 25px;
}

form {
  display: flex;
  flex-direction: column;
  gap: 15px;
}

label {
  font-weight: bold;
  margin-bottom: 5px;
}

input {
  padding: 10px;
  font-size: 16px;
  border: 1px solid #ccc;
  border-radius: 6px;
}

button {
  padding: 12px;
  font-size: 16px;
  background-color: #4caf50;
  color: white;
  border: none;
  border-radius: 6px;
  cursor: pointer;
  transition: background-color 0.2s ease;
}

button:hover {
  background-color: #45a049;
}

.error-message {
  color: red;
  margin-top: 10px;
  text-align: center;
}
</style>
