<template>
  <div class="home_grid">
    <div class="left_side"><CardInfo /></div>
    <div class="right_side"><Pie /></div>
    <div class="bottom_side"><Table /></div>
  </div>
</template>

<script setup>
import CardInfo from "@/components/dashboard/CardInfo.vue";
import Pie from "@/components/dashboard/Pie.vue";
import Table from "@/components/dashboard/Table.vue";
</script>

<style scoped>
.home_grid {
  display: grid;
  grid-template-columns: repeat(2, 1fr);
  grid-template-rows: minmax(150px, 28vw) minmax(80px, 11vw);
  gap: 20px;
  width: 100%;
  max-width: 1200px;
  margin: 0 auto;
}

.bottom_side {
  grid-column: 1 / -1;
}

/* Responsive styling */
@media (max-width: 768px) {
  .home_grid {
    grid-template-columns: 1fr;
    grid-template-rows: auto;
  }

  .left_side,
  .right_side,
  .bottom_side {
    grid-column: 1 / -1; /* Make all items span the full width */
  }
}
</style>
