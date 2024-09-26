<template>
  <div class="nav_container">
    <div class="left-side side">
      <img src="/Tasks1.png" width="40" alt="" />
    </div>
    <div class="midd-side side">
      <p class="parag">Tasks Builder</p>
    </div>

    <!-- rightSide-->
    <div class="right-side side d-none d-lg-flex">
      <div class="icons">
        <BellIcon
          :notifications="notifications"
          :fetchUserNotifications="fetchUserNotifications"
        />
      </div>
      <button type="button" class="btn btn-danger btn-log" @click="logout">
        <i class="bi bi-box-arrow-left"></i>
      </button>
      <div class="d-flex">
        <input
          class="form-control me-2"
          type="search"
          placeholder="Search"
          aria-label="Search"
          v-model="search"
          @input="hanldeSearch"
        />
        <!--  <button type="button" class="btn search-btn">Search</button> -->
      </div>
    </div>

    <!-- CANVAS-->
    <NavBtn />
  </div>
</template>

<script setup>
import NavBtn from "./NavBtn.vue";
import BellIcon from "./BellIcon.vue";

import { onMounted, ref } from "vue";
import axios from "../../../axiosToken";

//Data
const notifications = ref([]);
const search = ref("");

//Emits
const emit = defineEmits(["searchQuery"]);

// Logout
const logout = () => {
  localStorage.clear();
  window.location.reload();
};

// Notification
const fetchUserNotifications = async () => {
  const { data } = await axios.get("api/notifications");
  notifications.value = data?.data;
  console.log(notifications.value);
};

onMounted(() => {
  fetchUserNotifications();

  const userId = JSON.parse(localStorage.getItem("userData"));
  window.Echo.private(`App.Models.User.${userId?.id}`).notification(
    (notification) => {
      notifications.value.push(notification);
      fetchUserNotifications();
    }
  );
});

//Search
const hanldeSearch = () => {
  emit("searchQuery", search.value.trim());
};
</script>

<style scoped>
.nav_container {
  width: 100%;
  height: 100%;
  display: flex;
  justify-content: space-around;
}

.side {
  /*   border: 1px solid red; */
  min-width: 28%;
  max-width: 100%;
  text-align: center;
  justify-content: space-around;
  margin: 0;
}
.side:last-child {
  width: 35%;
  max-width: 100%;
  justify-content: space-around;
}

.icons i {
  font-size: 1.2rem;
  color: #5e72c2;
}

.parag {
  font-size: 1.8rem;
  font-weight: 600;
  color: #444655;
}

.btn-log {
  border-radius: 50%;
}

/* .search-btn {
  background-color: #5e72c2;
  color: white;
} */
</style>
