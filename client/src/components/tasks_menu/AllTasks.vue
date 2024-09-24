<template>
  <div class="todos_container">
    <div class="btn-group">
      <select name="dropdown-menu" id="" v-model="status">
        <option value="all">All</option>
        <option value="complete">Complete</option>
        <option value="uncomplete">Uncomplete</option>
      </select>
    </div>
    <div class="todo_container">
      <Task
        v-for="task in allTasks"
        :key="task.id"
        :task="task"
        :getAllTasks="getAllTasks"
      />
    </div>
  </div>
</template>

<script setup>
import { onMounted, ref, watch } from "vue";
import Task from "./Task.vue";
import axios from "../../../axiosToken";
import dayjs from "dayjs";

const props = defineProps(["query"]);

const allTasks = ref("");

const status = ref("all");

const getAllTasks = async () => {
  const { data } = await axios.get("api/tasks", {
    params: { q: props.query, status: status.value },
  });

  allTasks.value = data.tasks;
  console.log(allTasks.value);
};

onMounted(() => {
  getAllTasks();
});

watch([() => props.query, () => status.value], ([x, y]) => {
  getAllTasks();
});
</script>

<style scoped>
.todos_container {
  width: 100%;
  height: 100%;
  display: flex;
  align-items: start;
  justify-content: center;
  position: relative;
  padding-top: 5rem;
}

.btn-group {
  position: absolute;
  top: 10px;
  right: 10px;
}
.TheTodo_container p {
  margin: -10px 0;
}

.todo_container {
  width: 70%;
  height: 4.325rem;
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

.btn-group select {
  padding: 0.5rem 1rem;
  border-radius: 5px;
  border: 1px solid #5e72c2;
  background-color: white;
  color: #5e72c2;
  font-size: 1rem;
  cursor: pointer;
  box-shadow: 0 2px 4px #5e72c2;
  cursor: pointer;
  transition: background-color 0.3s, box-shadow 0.3s;
}

.btn-group select:focus {
  outline: none;
  background-color: white;
  box-shadow: 0 0 0 2px #5e72c2;
}

.btn-group select:hover {
  background-color: #f2faff;
}

.btn-group {
  position: absolute;
  top: 10px;
  right: 10px;
  cursor: pointer;
}
</style>
