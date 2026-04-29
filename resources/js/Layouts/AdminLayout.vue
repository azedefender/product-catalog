<template>
  <div class="min-h-screen bg-gray-100">
    <nav class="bg-white shadow p-4 flex justify-between items-center">
      <div>
        <a href="/admin/products" class="font-bold text-lg">Админка</a>
      </div>
      <button @click="handleLogout" class="text-red-600 hover:underline">Выйти</button>
    </nav>
    <main class="p-4">
      <slot />
    </main>
  </div>
</template>

<script setup>
import { useAuth } from '@/Composables/useAuth'
import { router } from '@inertiajs/vue3'

const { logout } = useAuth()

const handleLogout = async () => {
  await logout()
  router.visit('/')
}
</script>