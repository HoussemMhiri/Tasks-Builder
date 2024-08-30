<template>
  <main class="all-content">
    <router-view class="child" />
  </main>
</template>

<script setup></script>

<style scoped>
.all-content {
  min-height: 100vh;
  display: flex;
  align-items: center;
  justify-content: center;
  width: 100%;
  background-color: #dbeafe;
}

.child {
  width: 100%;
  max-width: 450px;
  margin: 0 15px;
  margin-bottom: 5%;
  background-color: white;
  border-radius: 5px;
  min-height: 500px;
  display: flex;
  flex-direction: column;
  justify-content: space-evenly;
}
</style>
