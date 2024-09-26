<template>
  <div class="Tb_container">
    <div
      v-if="loading"
      class="d-flex justify-content-center align-items-center"
      style="height: 100%"
    >
      <div class="spinner-border text-primary" role="status"></div>
    </div>
    <table v-else class="table table-hover">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Task</th>
          <th scope="col">Status</th>
          <th scope="col">Deadline</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(task, index) in lastThreeTasks" :key="task.id">
          <th scope="row">{{ index + 1 }}</th>
          <td>{{ task.todo }}</td>
          <td>
            <span :class="task.isDone ? 'status-completed' : 'status-pending'">
              {{ task.isDone ? "Completed" : "Pending" }}
            </span>
          </td>
          <td>{{ formatDate(task.end_before) }}</td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script setup>
import { onMounted, ref } from "vue";
import axios from "../../../axiosToken";
import dayjs from "dayjs";

const allTasks = ref([]);
const lastThreeTasks = ref([]);
const loading = ref(true);

const formatDate = (date) => {
  return dayjs(date).format("D MMMM YYYY HH:mm");
};

const getAllTasks = async () => {
  try {
    const { data } = await axios.get("api/tasks");
    allTasks.value = data.tasks;
    lastThreeTasks.value = allTasks.value.slice(-3);
    console.log(lastThreeTasks.value);
  } catch (error) {
    console.error("Error fetching tasks:", error);
  } finally {
    loading.value = false;
  }
};

onMounted(() => {
  getAllTasks();
});
</script>

<style scoped>
.Tb_container {
  width: 100%;
  height: 100%;
  display: flex;
  align-items: center;
  justify-content: center;
  flex-direction: column;
  background-color: #f2f4f8;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  border-radius: 10px;
}

.table {
  border-radius: 10px;
  margin: 0 auto;
  height: 100%;
  width: 100%;
  text-align: center;
  overflow: hidden; /* Ensure the rounded corners apply to the table */
}

.table th {
  background-color: #5e72c2 !important;
  color: #ffffff !important
  ;
}

.status-completed {
  color: #4caf50;
  font-weight: bold;
}

.status-pending {
  color: #ff5722;
  font-weight: bold;
}
</style>
