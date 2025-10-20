<template>
  <div class="min-h-screen bg-gray-100">
    <div class="max-w-2xl mx-auto p-6">
      <LoginForm v-if="!token" @logged="onLogged" />
      <Dashboard v-else :token="token" />
    </div>
  </div>
</template>

<script>
import { ref } from 'vue'
import LoginForm from './components/LoginForm.vue'
import Dashboard from './components/Dashboard.vue'

export default {
  components: { LoginForm, Dashboard },
  setup() {
    const token = ref(null)
    function onLogged(t) {
      token.value = t
    }
    return { token, onLogged }
  },
}
</script>
