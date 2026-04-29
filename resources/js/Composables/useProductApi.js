import axios from 'axios'

export function useProductApi() {
  const getProducts = (params) => axios.get('/api/products', { params }).then(r => r.data)

  const getProduct = (id) => axios.get(`/api/products/${id}`).then(r => r.data.data)

  const createProduct = (data) => axios.post('/api/products', data).then(r => r.data.data)

  const updateProduct = (id, data) => axios.put(`/api/products/${id}`, data).then(r => r.data.data)

  const deleteProduct = (id) => axios.delete(`/api/products/${id}`)

  const getCategories = () => axios.get('/api/categories').then(r => r.data.data)

  return { getProducts, getProduct, createProduct, updateProduct, deleteProduct, getCategories }
}