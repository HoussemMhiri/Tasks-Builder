<template>
  <div class="canvas d-lg-none my-3">
    <button
      class="btn btn_canvas d-lg-none"
      type="button"
      data-bs-toggle="offcanvas"
      data-bs-target="#offcanvasExampleSide"
      aria-controls="offcanvasExample"
    >
      <i class="bi bi-arrow-right-circle"></i>
    </button>

    <div
      class="offcanvas offcanvas-start"
      tabindex="-1"
      id="offcanvasExampleSide"
      aria-labelledby="offcanvasExampleLabel"
    >
      <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasExampleLabel">Details</h5>
        <button
          type="button"
          class="btn-close"
          data-bs-dismiss="offcanvas"
          aria-label="Close"
        ></button>
      </div>
      <div class="offcanvas-body">
        <Sidebar />
      </div>
    </div>
  </div>
</template>

<script setup>
import Sidebar from "../mainLayout/Sidebar.vue";
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
