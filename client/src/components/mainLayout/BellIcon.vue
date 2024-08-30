<template>
  <div>
    <div :class="[changeColor ? 'newColor' : 'icons']">
      <button type="button" @click="toggle" class="icon_btn">
        <i class="bi bi-bell-fill"></i>
      </button>
    </div>
    <OverlayPanel
      ref="op"
      class="custom-overlay"
      :dismissable="true"
      appendTo="body"
    >
      <div class="overlay-content">
        <div
          class="notification-item"
          v-for="(notification, index) in notifications"
          :key="index"
        >
          <i class="bi bi-check-lg icon"></i>
          <div class="notification-text">
            <p>{{ notification.text }}</p>
            <small class="text-muted">{{ notification.time }}</small>
          </div>
          <i class="bi bi-eye-fill icon icon_eye"></i>
        </div>
      </div>
    </OverlayPanel>
  </div>
</template>

<script setup>
import OverlayPanel from "primevue/overlaypanel";
import { ref } from "vue";

const props = defineProps(["changeColor"]);

const op = ref();
const toggle = (event) => {
  op.value.toggle(event);
};

const notifications = ref([
  { text: "Task completed", time: "2 mins ago" },
  { text: "New comment", time: "10 mins ago" },
  { text: "Meeting scheduled", time: "30 mins ago" },
]);
</script>

<style scoped>
.icons i {
  font-size: 1.5rem;
  color: #5e72c2;
  cursor: pointer;
}

.newColor i {
  color: white !important;
  font-size: 1.3rem;
}

.icon_btn {
  background: none;
  border: none;
}

.custom-overlay {
  background-color: white !important; /* Ensure white background for the overlay */
  border-radius: 10px; /* Slightly increased radius for a softer look */
  box-shadow: 0 8px 16px rgba(0, 0, 0, 0.15); /* Enhanced shadow for depth */
  padding: 1rem;
  min-width: 280px; /* Slightly wider for better content fitting */
  opacity: 0;
  transform: translateY(-10px);
  transition: opacity 0.3s ease, transform 0.3s ease;
  position: relative; /* Position relative for absolute children positioning */
  position: fixed;
  z-index: 2090 !important;
}

.custom-overlay.p-connected-overlay-visible {
  opacity: 1;
  transform: translateY(0);
}

.overlay-content {
  display: flex;
  flex-direction: column;
}

.notification-item {
  cursor: pointer;
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 0.75rem 1rem;
  border-bottom: 1px solid #e0e0e0;
  background-color: white;
}

.notification-item:last-child {
  border-bottom: none;
}

.notification-item:hover .icon {
  color: #5b6979;
}

.icon {
  font-size: 1.2rem;
  color: #5e72c2;
}
.icon_eye {
  cursor: pointer;
}
.notification-text {
  flex-grow: 1;
  margin-left: 0.75rem;
}

.notification-text p {
  margin: 0;
  font-weight: 600;
  color: #333;
}

.notification-text small {
  color: #999;
}
</style>
