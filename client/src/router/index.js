import { createRouter, createWebHistory } from "vue-router";
import HomeView from "../views/HomeView.vue";
import AuthLayout from "@/layouts/AuthLayout.vue";
import MainLayout from "@/layouts/MainLayout.vue";
import Register from "@/views/Register.vue";
import Login from "@/views/Login.vue";
import AddTask from "@/components/tasks_menu/AddTask.vue";
import AllTasks from "@/components/tasks_menu/AllTasks.vue";
import EditUser from "@/components/edit_user/EditUser.vue";

const router = createRouter({
  linkActiveClass: "activeLink",
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: "/",
      component: MainLayout,
      meta: { requiresAuth: true },
      children: [
        {
          path: "",
          name: "home",
          component: HomeView,
        },
        {
          path: "/addTask",
          name: "addTask",
          component: AddTask,
        },
        {
          path: "/allTasks",
          name: "allTasks",
          component: AllTasks,
        },
        {
          path: "/editUser",
          name: "editUser",
          component: EditUser,
        },
      ],
    },
    {
      path: "/auth",
      component: AuthLayout,
      meta: { requiresGuest: true },
      children: [
        {
          path: "",
          name: "register",
          component: Register,
        },
        {
          path: "login",
          name: "login",
          component: Login,
        },
      ],
    },
  ],
});

router.beforeEach((to, from, next) => {
  const token = JSON.parse(localStorage.getItem("userToken"));

  if (to.matched.some((record) => record.meta.requiresAuth)) {
    if (!token) {
      next("/auth");
    } else {
      next();
    }
  } else if (to.matched.some((record) => record.meta.requiresGuest)) {
    if (token) {
      next("/");
    }
    next();
  } else {
    next();
  }
});

export default router;
