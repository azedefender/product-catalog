import { ref } from 'vue'
import axios from 'axios'

const token = ref(localStorage.getItem('token'))
const user = ref(null)

export function useAuth() {
  const isLoggedIn = () => !!token.value

  const setToken = (newToken) => {
    token.value = newToken
    localStorage.setItem('token', newToken)
    axios.defaults.headers.common['Authorization'] = `Bearer ${newToken}`
  }

  const login = async (email, password) => {
    const { data } = await axios.post('/api/login', { email, password })
    setToken(data.token)
    user.value = data.user
  }

  const logout = async () => {
    await axios.post('/api/logout')
    token.value = null
    user.value = null
    localStorage.removeItem('token')
    delete axios.defaults.headers.common['Authorization']
  }

  // Инициализация при загрузке
  if (token.value) {
    axios.defaults.headers.common['Authorization'] = `Bearer ${token.value}`
  }

  return { token, user, isLoggedIn, login, logout, setToken }
}