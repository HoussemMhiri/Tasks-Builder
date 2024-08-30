<template>
  <div>
    <h1 class="text-center">Login</h1>
    <AuthForm login="login" />
  </div>
</template>

<script setup>
import AuthForm from "@/components/AuthForm.vue";
</script>

<style scoped>
h1 {
  margin-bottom: -30px;
}
</style>
