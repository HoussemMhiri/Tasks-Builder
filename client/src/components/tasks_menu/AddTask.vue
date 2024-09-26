<template>
  <form class="form-container_add" @submit.prevent="addTask">
    <div class="row mb-3">
      <label for="inputEmail3" class="col-form-label">Add Task</label>
      <div class="col-sm">
        <input
          type="text"
          class="form-control"
          id="inputEmail3"
          v-model="addTaskForm.todo"
        />
      </div>
    </div>
    <div class="row mb-3">
      <label for="calendar-24h" class="font-bold block mb-2"> End at </label>
      <Calendar
        id="calendar-24h"
        v-model="addTaskForm.end_before"
        showTime
        hourFormat="12"
      />
    </div>
    <button type="submit" class="btn btn_submit" :disabled="loading">
      <span v-if="loading">Submitting...</span>
      <span v-else>Submit</span>
    </button>
  </form>
</template>

<script setup>
import dayjs from "dayjs";
import axios from "../../../axiosToken";
import Calendar from "primevue/calendar";
import { ref } from "vue";
import Swal from "sweetalert2";

const addTaskForm = ref({
  todo: "",
  end_before: "",
});

const loading = ref(false);

const formatDate = (date) => {
  return dayjs(date).format("YYYY-MM-DD HH:mm");
};

const addTask = async () => {
  try {
    loading.value = true;
    addTaskForm.value.end_before = formatDate(addTaskForm.value.end_before);
    const { data } = await axios.post("api/tasks", addTaskForm.value);
    console.log(data);

    // Clear the form
    for (let key in addTaskForm.value) {
      addTaskForm.value[key] = "";
    }

    await Swal.fire({
      icon: "success",
      title: "Task added successfully",
      timer: 3000,
    });
  } catch (error) {
    console.error("Error adding task:", error);
  } finally {
    loading.value = false;
  }
};
</script>

<style scoped>
#calendar-24h {
  background: white;
  height: 37.5px;
  border-radius: 8px;
}

.form-container_add {
  border: 7px solid #96a6fb;
  border-radius: 10px;
  padding: 1rem;
  height: 80%;
  width: 80%;
  display: flex;
  flex-direction: column;
  padding-top: 8rem;
  align-items: center;
}

.btn_submit {
  margin-top: 1rem;
  background: #5e72c2;
  color: white;
  transition: background-color 0.3s ease;
}

.btn_submit[disabled] {
  background-color: #a0aec0;
  cursor: not-allowed;
}

label {
  font-weight: 600;
  font-size: 1.2rem;
}
</style>

<style>
#calendar-24h input {
  width: 100%;
  height: 100%;
  border: none;
}
#calendar-24h input:focus {
  outline: none;
}
#calendar-24h_panel {
  background-color: white !important;
  border-radius: 5px !important;
  padding: 10px !important;
}
</style>
