import axios from 'axios'

const baseURL = import.meta.env.VITE_API_URL || ''

const api = axios.create({
  baseURL,
  headers: {
    'Accept': 'application/json',
  },
})

export function setToken(token) {
  api.defaults.headers.common['Authorization'] = `Bearer ${token}`
}

export default api
