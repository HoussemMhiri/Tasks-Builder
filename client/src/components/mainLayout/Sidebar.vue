<template>
  <div class="sidebar_container">
    <h1 class="m-3">Tasks Menu</h1>

    <div class="my-5 userName">
      <router-link to="/editUser" class="editUser">
        <img
          src="https://png.pngtree.com/png-vector/20191101/ourmid/pngtree-cartoon-color-simple-male-avatar-png-image_1934459.jpg"
          alt=""
          width="50"
        />
      </router-link>
      <p>Houssem</p>
    </div>
    <div class="allMenu">
      <div class="d-flex">
        <ul>
          <li>
            <router-link @click="active = false" to="/allTasks"
              >Show Tasks</router-link
            >
          </li>
          <li>
            <router-link @click="active = false" to="/addTask"
              >Add Task</router-link
            >
          </li>
        </ul>
      </div>
      <div class="HomeMenu">
        <i class="bi bi-house-fill"></i>
        <router-link
          to="/"
          class="router_link_home"
          :class="[active && 'activeHome']"
          @click="active = true"
          >Home</router-link
        >
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref } from "vue";

const active = ref(false);
</script>

<style scoped>
.activeLink {
  padding: 0 10px;
  color: #f2faff;
}
.sidebar_container {
  color: white;
}

.userName {
  border: 2px solid #f2faff;
  border-right: 0px;
  border-left: 0px;
  padding: 10px;
  display: flex;
  align-items: center;
}

.userName p {
  font-size: 1.7rem;
  font-weight: 600;
  margin: 0 10px;
  color: #f2faff;
}
.userName img {
  border-radius: 30px;
  object-fit: contain;
}

.editUser {
  padding: 0;
  border: 1px solid transparent;
  border-radius: 50%;
}

.editUser:hover {
  border: 1px solid #dbeafe;
}

ul li {
  color: #dbeafe;
  font-size: 1.2rem;
  margin-bottom: 20px;
}

ul li a {
  text-decoration: none;
  color: #dbeafe;
}

ul li a:hover {
  color: #f2faff;
  padding: 0 10px;
  transition: all 0.3s ease-in-out;
}

.allMenu {
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  height: 55vh;
}

.HomeMenu {
  padding: 10px;
}

.router_link_home {
  text-decoration: none;
  font-size: 1.3rem;
  color: #dbeafe;
}

.router_link_home:hover {
  color: #f2faff;
  padding: 0 20px;
  transition: all 0.3s ease-in-out;
}

.activeHome {
  color: #f2faff;
  padding: 0 20px;
}
</style>
