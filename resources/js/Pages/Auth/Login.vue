<template>
  <div class="max-w-sm mx-auto mt-20 bg-white p-6 shadow rounded">
    <h1 class="text-2xl mb-4">Вход для администратора</h1>
    <form @submit.prevent="submit">
      <input v-model="email" placeholder="Email" class="w-full p-2 border rounded mb-2" />
      <input v-model="password" type="password" placeholder="Пароль" class="w-full p-2 border rounded mb-2" />
      <button type="submit" class="w-full bg-blue-600 text-white p-2 rounded">Войти</button>
      <p v-if="error" class="text-red-500 mt-2">{{ error }}</p>
    </form>
  </div>
</template>

<script setup>
import { ref } from 'vue'
import { useAuth } from '@/Composables/useAuth'
import { router } from '@inertiajs/vue3'

const email = ref('')
const password = ref('')
const error = ref('')
const { login } = useAuth()

const submit = async () => {
  try {
    await login(email.value, password.value)
    router.visit('/admin/products')
  } catch (e) {
    error.value = e.response?.data?.message || 'Ошибка входа'
  }
}
</script>