import "@/assets/main.css";
import "primeicons/primeicons.css";
import "sweetalert2/dist/sweetalert2.min.css";

/* ================================Sweet Alert start */
import swal from "sweetalert2";
window.swal = swal;

const toast = swal.mixin({
  toast: true,
  position: "top-end",
  showConfirmButton: false,
  timer: 3000,
  timerProgressBar: true,
  didOpen: (toast) => {
    toast.addEventListener("mouseenter", swal.stopTimer);
    toast.addEventListener("mouseleave", swal.resumeTimer);
  },
});

window.toast = toast;

/* lARAVEL echo AnD PUSHER*/

import Echo from "laravel-echo";
import Pusher from "pusher-js";

// Make Pusher available globally
window.Pusher = Pusher;
const token = JSON.parse(localStorage.getItem("userToken"));

window.Echo = new Echo({
  broadcaster: "pusher",
  key: "a628d86cf7f542e819a3",
  cluster: "eu",
  encrypted: true,
  authEndpoint: "http://localhost:8000/broadcasting/auth",
  auth: {
    headers: {
      Authorization: `Bearer ${token}`,
    },
  },
});

/**/

import { createApp } from "vue";
import { createPinia } from "pinia";

import App from "./App.vue";
import router from "./router";
import PrimeVue from "primevue/config";

//in main.js
import "primevue/resources/themes/aura-light-green/theme.css";

import "bootstrap/dist/css/bootstrap.min.css";
import "bootstrap/dist/js/bootstrap.bundle.min.js";

import "bootstrap-icons/font/bootstrap-icons.css";

const app = createApp(App);
app.use(PrimeVue);
app.use(createPinia());
app.use(router);

app.mount("#app");
