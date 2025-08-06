<template>
  <div>
    <h1>Magic Link</h1>
    <p v-if="link">Your link: <a :href="link" target="_blank">{{ link }}</a></p>
    <p v-else>Link not found</p>
  </div>
</template>

<script setup lang="ts">
import { ref } from 'vue'

const link = ref(history.state.link)
</script>
