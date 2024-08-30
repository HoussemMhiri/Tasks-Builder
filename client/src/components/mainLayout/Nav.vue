<template>
  <div class="nav_container">
    <div class="left-side side">
      <img
        src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTqaPDdSaK-bgA5Ye6Du39dR54r5T1AbYx7NA&s"
        width="50"
        alt=""
      />
    </div>
    <div class="midd-side side">
      <p class="parag">Tasks Builder</p>
    </div>

    <!-- rightSide-->
    <div class="right-side side d-none d-lg-flex">
      <div class="icons">
        <BellIcon />
      </div>
      <button type="button" class="btn btn-danger">Logout</button>
      <div class="d-flex">
        <input
          class="form-control me-2"
          type="search"
          placeholder="Search"
          aria-label="Search"
        />
        <button type="button" class="btn btn-success">Search</button>
      </div>
    </div>

    <!-- CANVAS-->
    <NavBtn />
  </div>
</template>

<script setup>
import NavBtn from "./NavBtn.vue";
import BellIcon from "./BellIcon.vue";
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
  justify-content: space-between;
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
</style>
