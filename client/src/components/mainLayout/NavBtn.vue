<template>
  <div class="canvas d-lg-none">
    <button
      class="btn btn_canvas d-lg-none"
      type="button"
      data-bs-toggle="offcanvas"
      data-bs-target="#offcanvasExample"
      aria-controls="offcanvasExample"
    >
      <i class="bi bi-list"></i>
    </button>

    <div
      class="offcanvas offcanvas-end"
      tabindex="-1"
      id="offcanvasExample"
      aria-labelledby="offcanvasExampleLabel"
    >
      <div class="offcanvas-header">
        <h3 class="offcanvas-title" id="offcanvasExampleLabel">Menu</h3>
        <button
          type="button"
          class="btn-close"
          data-bs-dismiss="offcanvas"
          aria-label="Close"
        ></button>
      </div>
      <div class="offcanvas-body mx-3 text-center">
        <div class="iconCanvas my-3">
          <BellIcon :changeColor="true" class="THEbELLiCON" />
        </div>
        <button type="button" class="btn btn-danger my-3">Logout</button>
        <div class="d-flex my-3">
          <input
            class="form-control me-2"
            type="search"
            placeholder="Search"
            aria-label="Search"
          />
          <button type="button" class="btn btn-success">Search</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import BellIcon from "./BellIcon.vue";
</script>

<style scoped>
.offcanvas {
  background-color: #5e72c2;
  color: white;
}
.iconCanvas i {
  font-size: 1.3rem;
}

.btn_canvas {
  background-color: #5e72c2;
  color: white;
}
</style>
