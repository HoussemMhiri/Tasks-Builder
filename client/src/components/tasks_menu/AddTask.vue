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
    <button type="submit" class="btn btn_submit">Submit</button>
  </form>
</template>

<script setup>
import dayjs from "dayjs";
import axios from "../../../axiosToken";
import Calendar from "primevue/calendar";
import { ref } from "vue";

const addTaskForm = ref({
  todo: "",
  end_before: "",
});

const formatDate = (date) => {
  return dayjs(date).format("YYYY-MM-DD HH:mm:ss");
};

const addTask = async () => {
  addTaskForm.value.end_before = formatDate(addTaskForm.value.end_before);
  const { data } = await axios.post("api/tasks", addTaskForm.value);
  console.log(data);
  for (let key in addTaskForm.value) {
    addTaskForm.value[key] = "";
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
