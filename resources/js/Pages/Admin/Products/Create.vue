<template>
  <div class="max-w-md mx-auto bg-white p-6 shadow rounded">
    <h2 class="text-xl mb-4">Новый товар</h2>
    <form @submit.prevent="submit">
      <input v-model="form.name" placeholder="Название" class="w-full p-2 border rounded mb-2" required />
      <select v-model="form.category_id" class="w-full p-2 border rounded mb-2" required>
        <option disabled value="">Выберите категорию</option>
        <option v-for="cat in categories" :key="cat.id" :value="cat.id">{{ cat.name }}</option>
      </select>
      <textarea v-model="form.description" placeholder="Описание" class="w-full p-2 border rounded mb-2"></textarea>
      <input v-model.number="form.price" type="number" step="0.01" min="0.01" placeholder="Цена" class="w-full p-2 border rounded mb-2" required />
      <button type="submit" class="w-full bg-blue-600 text-white p-2 rounded">Сохранить</button>
    </form>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { useProductApi } from '@/Composables/useProductApi'
import { router } from '@inertiajs/vue3'

const { createProduct, getCategories } = useProductApi()
const categories = ref([])
const form = ref({
  name: '',
  category_id: '',
  description: '',
  price: 0
})

const submit = async () => {
  await createProduct(form.value)
  router.visit('/admin/products')
}

onMounted(async () => {
  categories.value = await getCategories()
})
</script>

<script>
import AdminLayout from '@/Layouts/AdminLayout.vue'
export default { layout: AdminLayout }
</script>