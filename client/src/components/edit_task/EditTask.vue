<template>
  <div>
    <button
      class="edit btns"
      type="button"
      data-bs-toggle="modal"
      :data-bs-target="'#modal-' + task.id"
      data-bs-whatever="@mdo"
    >
      <i class="bi bi-pencil-square"></i>
    </button>
    <div
      class="modal fade"
      :id="'modal-' + task.id"
      tabindex="-1"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Task</h1>
            <button
              type="button"
              class="btn-close"
              data-bs-dismiss="modal"
              aria-label="Close"
            ></button>
          </div>
          <div class="modal-body">
            <form @submit.prevent="updateTaskDone(true, { taskUpdated: true })">
              <div class="mb-3">
                <label for="recipient-name" class="col-form-label"
                  >Your Task:</label
                >
                <input
                  type="text"
                  class="form-control"
                  id="recipient-name"
                  v-model="task.todo"
                />
              </div>
              <div class="row mb-3">
                <label for="calendar-24h" class="font-bold block mb-2">
                  End at
                </label>
                <Calendar
                  id="calendar-24h"
                  v-model="task.end_before"
                  showTime
                  hourFormat="12"
                  appendTo="body"
                />
              </div>
              <div class="modal-footer">
                <button
                  type="button"
                  class="btn btn-secondary"
                  data-bs-dismiss="modal"
                >
                  Close
                </button>
                <button
                  type="submit"
                  class="btn btn-primary"
                  data-bs-dismiss="modal"
                >
                  Save
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import Calendar from "primevue/calendar";
const props = defineProps(["task", "updateTaskDone"]);
</script>

<style scoped>
.btns {
  border: none;
  border-radius: 50%;
  background: none;
  height: 2rem;
  width: 2rem;
  color: white;
}

.edit {
  background-color: #3c4856;
}

.edit:hover {
  background-color: white;
  color: #3c4856;
  transition: all 0.2s ease;
}
</style>

<style>
.p-datepicker {
  z-index: 1060 !important;
}
</style>
