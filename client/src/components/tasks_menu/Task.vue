<template>
  <div class="todo_container">
    <div class="TheTodo_container">
      <p class="todoP" :class="[task.isDone && 'done']">{{ task.todo }}</p>
      <p>
        <span class="endAtP">End at</span>:
        <span class="endAtT">{{ formatDate(task.end_before) }}</span>
      </p>
    </div>

    <div class="btns_container">
      <button class="check btns" @click="updateTaskDone(false)">
        <i class="bi bi-check-lg"></i>
      </button>
      <button type="button" class="delete btns" @click="deleteTask">
        <i class="bi bi-x"></i>
      </button>
      <EditTask :task="task" :updateTaskDone="updateTaskDone" />
    </div>
  </div>
</template>

<script setup>
import axios from "../../../axiosToken";
import dayjs from "dayjs";
import EditTask from "../edit_task/EditTask.vue";

const props = defineProps(["task", "getAllTasks"]);

const formatDate = (date) => {
  return dayjs(date).format("D MMMM YYYY HH:mm");
};

const formatDateForUpdate = (date) => {
  return dayjs(date).format("YYYY-MM-DD HH:mm");
};

const deleteTask = async () => {
  swal
    .fire({
      title: "Are you sure ?",
      text: "revert back is impossible",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#4481eb",
      cancelButtonColor: "#d33",
      confirmButtonText: "confirm",
      cancelButtonText: "cancel",
    })
    .then((result) => {
      if (result.isConfirmed) {
        axios
          .delete(`api/tasks/${props.task.id}`)
          .then((response) => {
            console.log("task deleted successfully");
            props.getAllTasks();
          })
          .then(() => {
            toast.fire({
              icon: "success",
              title: "Task Delete it successfully",
              timer: 2000,
            });
          })
          .catch((error) => {
            alert(error);
          });
      }
    });
};

const updateTaskDone = async (updateTask = false, additionalParams = {}) => {
  try {
    const bodyData = updateTask
      ? {
          todo: props.task.todo,
          end_before: formatDateForUpdate(props.task.end_before),
        }
      : {
          isDone: !props.task.isDone,
        };
    const { data } = await axios.put(`api/tasks/${props.task.id}`, bodyData, {
      params: updateTask ? additionalParams : {},
    });
    console.log(data);
    props.getAllTasks();
  } catch (error) {
    if (error.response) {
      console.log("Validation errors:", error.response.data.errors);
    } else {
      console.error("Error:", error.message);
    }
  }
};
</script>

<style scoped>
.todo_container {
  width: 100% !important;
  display: flex;
  align-items: center;
  justify-content: space-between;
  background: #f2faff;
  border-radius: 10px;
  /*   border: 1px solid red; */
  margin-bottom: 15px;
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

p {
  margin: 0;
  padding: 10px;
}

.endAtP,
.todoP {
  font-weight: 500;
}

.endAtT {
  color: #444655;
}

.done {
  text-decoration: line-through;
}
</style>
