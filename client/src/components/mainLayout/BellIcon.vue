<template>
  <div>
    <div :class="[changeColor ? 'newColor' : 'icons']">
      <button type="button" @click="toggle" class="icon_btn">
        <i class="bi bi-bell-fill"></i>
        <!-- Badge for notification count -->
        <span v-if="messageUnreadNumber > 0" class="badge">{{
          messageUnreadNumber
        }}</span>
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
          :class="[notification?.read_at !== null ? 'notificationRead' : '']"
          class="notification-item"
          v-for="(notification, index) in notifications"
          :key="index"
        >
          <i
            v-if="notification?.data?.type"
            class="bi bi-exclamation-circle-fill alertIcon"
          ></i>
          <i v-else class="bi bi-check-lg icon"></i>
          <div class="notification-text">
            <p>{{ notification?.data?.test }}</p>
            <small class="text-muted"
              >{{
                notification?.data?.type
                  ? "Task end in 30 minutes"
                  : "Completed"
              }}
            </small>
          </div>

          <div class="twoIcons">
            <div @click="readNotification(notification?.id)">
              <i
                v-if="notification?.read_at == null"
                class="bi bi-eye-fill icon icon_eye"
              ></i>
              <i v-else class="bi bi-eye-slash-fill"></i>
            </div>
            <button
              type="button"
              class="delete btns"
              @click="DeleteNotification(notification?.id)"
            >
              <i class="bi bi-x"></i>
            </button>
          </div>
        </div>
      </div>
    </OverlayPanel>
  </div>
</template>

<script setup>
import axios from "../../../axiosToken";
import OverlayPanel from "primevue/overlaypanel";
import { computed, ref } from "vue";

const props = defineProps([
  "changeColor",
  "notifications",
  "fetchUserNotifications",
]);

const messageUnreadNumber = computed(() => {
  return props.notifications?.filter((el) => el.read_at == null).length || 0;
});

const readNotification = async (id) => {
  const { data } = await axios.put(`api/notifications/${id}/read`);
  props.fetchUserNotifications();
};
const DeleteNotification = async (id) => {
  const { data } = await axios.delete(`api/notifications/${id}`);
  console.log(data);
  props.fetchUserNotifications();
};

const op = ref();
const toggle = (event) => {
  op.value.toggle(event);
};
</script>

<style scoped>
/**/

.btns {
  border: none;
  border-radius: 50%;
  background: none;
  height: 1.3em;
  width: 1.3rem;
  color: white;
}

.delete {
  background-color: #dc3545;
}
.delete:hover {
  background-color: white;
  color: #dc3545;
  transition: all 0.2s ease;
}

.alertIcon {
  color: red;
}

/** */
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
  position: relative;
}

.badge {
  position: absolute;
  top: -5px;
  right: -5px;
  background-color: red;
  color: white;
  border-radius: 50%;
  padding: 3px 6px;
  font-size: 0.8rem;
  font-weight: bold;
  line-height: 1;
}

.custom-overlay {
  background-color: white !important;
  border-radius: 10px;
  box-shadow: 0 8px 16px rgba(0, 0, 0, 0.15);
  padding: 1rem;
  min-width: 280px;
  opacity: 0;
  transform: translateY(-10px);
  transition: opacity 0.3s ease, transform 0.3s ease;
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
  max-height: 300px; /* Set the max height */
  overflow-y: auto; /* Enable vertical scrolling */
}

.notification-item {
  cursor: pointer;
  display: flex;
  align-items: center;
  justify-content: space-between;
  /*   width: 20rem; */
  padding: 0.75rem 1.5rem;
  border-bottom: 1px solid #e0e0e0;
  background-color: white;
}

.twoIcons {
  /*   border: 1px solid black; */
  margin-left: 1.5rem;
  display: flex;
  flex-direction: column;
  align-items: center;
  height: 50px !important;
  justify-content: space-between;
}

.notificationRead {
  background-color: #afb5bc;
  color: #5b6979;
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
