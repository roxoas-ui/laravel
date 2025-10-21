<template>
  <div class="bg-white p-6 rounded shadow">
    <h2 class="text-xl font-bold mb-4">Login</h2>
    <form @submit.prevent="submit">
      <label class="block mb-2">Email</label>
      <input v-model="email" type="email" class="w-full border rounded p-2 mb-3" />
      <label class="block mb-2">Senha</label>
      <input v-model="password" type="password" class="w-full border rounded p-2 mb-3" />
      <button class="bg-blue-600 text-white px-4 py-2 rounded">Entrar</button>
    </form>
    <p v-if="error" class="text-red-600 mt-2">{{ error }}</p>
  </div>
</template>

<script>
import api, { setToken } from '../services/api'
import { ref } from 'vue'

export default {
  emits: ['logged'],
  setup(props, { emit }) {
    const email = ref('admin@local.test')
    const password = ref('SenhaTemporaria123!')
    const error = ref(null)

    async function submit() {
      error.value = null
      try {
  const res = await api.post('/api/login', { email: email.value, password: password.value })
  setToken(res.data.token)
  emit('logged', res.data.token)
      } catch (e) {
        error.value = e.response?.data?.message || 'Erro ao logar'
      }
    }

    return { email, password, submit, error }
  },
}
</script>
