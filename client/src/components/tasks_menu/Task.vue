<template>
  <div class="todo_container">
    <div class="TheTodo_container">
      <p>Todo</p>
      <p>End at:</p>
    </div>

    <div class="btns_container">
      <button class="check btns"><i class="bi bi-check-lg"></i></button>
      <button class="delete btns"><i class="bi bi-x"></i></button>
      <button class="edit btns"><i class="bi bi-pencil-square"></i></button>
    </div>
  </div>
</template>

<script setup></script>

<style scoped>
.todo_container {
  width: 100% !important;
  display: flex;
  align-items: center;
  justify-content: space-between;
  background: #f2faff;
  border-radius: 10px;
}
.TheTodo_container p {
  margin: -10px 0;
}

.btns_container {
  width: auto;
  display: flex;
  gap: 0.5rem;
  margin-right: 2%;
}

.btns {
  border: none;
  border-radius: 50%;
  background: none;
  height: 2rem;
  width: 2rem;
  color: white;
}

.check {
  background-color: #00c6b6;
}
.check:hover {
  background-color: white;
  color: #00c6b6;
  transition: all 0.2s ease;
}

.delete {
  background-color: #dc3545;
}
.delete:hover {
  background-color: white;
  color: #dc3545;
  transition: all 0.2s ease;
}

.edit {
  background-color: #3c4856;
}

.edit:hover {
  background-color: white;
  color: #3c4856;
  transition: all 0.2s ease;
}
p {
  margin: 0;
  padding: 10px;
}
</style>
