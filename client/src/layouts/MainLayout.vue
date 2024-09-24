<template>
  <div class="main-layout">
    <div class="navbar">
      <Nav @search-query="searchQuery" />
    </div>

    <aside class="sidebar d-none d-lg-block">
      <Sidebar />
    </aside>

    <!--CANVAS-->
    <SideBtn class="sideBtn" />

    <main class="content">
      <router-view :query="query" />
    </main>
  </div>
</template>

<script setup>
import { ref } from "vue";
import Nav from "../components/mainLayout/Nav.vue";
import Sidebar from "../components/mainLayout/Sidebar.vue";
import SideBtn from "../components/tasks_menu/SideBtn.vue";

const query = ref("");

const searchQuery = (q) => {
  query.value = q;
};
</script>

<style scoped>
.main-layout {
  height: 100vh;
  display: grid;
  grid-template-columns: 250px 1fr;
  grid-template-rows: 60px 1fr;
}

.navbar {
  background-color: #dbeafe;
  grid-column: 1/3;
  grid-row: 1/2;
}

.sidebar {
  background-color: #5e72c2;
  grid-column: 1/2;
  grid-row: 2/3;
}

.content {
  grid-column: 2/3;
  grid-row: 2/3;
  display: flex;
  align-items: center;
  justify-content: center;
  margin: 20px;
  background-color: #dbeafe;
  border-radius: 10px;
}

@media (max-width: 992px) {
  .content {
    grid-column: 1/3;
    grid-row: 2/3;
  }

  .sideBtn {
    position: absolute;
    top: 8%;
    left: 0;
  }
}
</style>
