<template>
  <div>
    <div class="bg-white p-4 rounded shadow mb-4">
      <h2 class="text-lg font-bold">Dashboard</h2>
      <p class="text-sm text-gray-600">Token: <code class="break-all">{{ token }}</code></p>
    </div>

    <div class="bg-white p-4 rounded shadow">
      <h3 class="font-semibold mb-2">Admin: Gerenciar Roles</h3>
      <form @submit.prevent="createRole" class="mb-4">
        <input v-model="roleName" placeholder="nome da role" class="border p-2 rounded mr-2" />
        <button class="bg-green-600 text-white px-3 py-1 rounded">Criar</button>
      </form>
      <ul>
        <li v-for="r in roles" :key="r.id" class="py-1">{{ r.name }} ({{ r.guard_name }})</li>
      </ul>
    </div>
  </div>
</template>

<script>
import api, { setToken } from '../services/api'
import { ref, onMounted } from 'vue'

export default {
  props: ['token'],
  setup(props) {
    const roles = ref([])
    const roleName = ref('')

    onMounted(async () => {
      setToken(props.token)
      const res = await api.get('/api/admin/roles')
      roles.value = res.data
    })

    async function createRole() {
  const res = await api.post('/api/admin/roles', { name: roleName.value, guard_name: 'sanctum' })
      roles.value.push(res.data)
      roleName.value = ''
    }

    return { roles, roleName, createRole }
  },
}
</script>
