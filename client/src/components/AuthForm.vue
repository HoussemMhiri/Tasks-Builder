<template>
  <form class="form_container" @submit.prevent="login ? auth(login) : auth()">
    <div class="mb-3" v-if="!login">
      <label for="exampleFormControlInput1" class="form-label">Username</label>
      <input
        type="text"
        class="form-control"
        id="exampleFormControlInput1"
        placeholder="name"
        v-model="form.name"
      />
    </div>
    <div class="mb-3" :class="{ 'mt-0': login }">
      <label for="exampleFormControlInput2" class="form-label"
        >Email address</label
      >
      <input
        type="email"
        class="form-control"
        id="exampleFormControlInput2"
        placeholder="name@example.com"
        v-model="form.email"
      />
    </div>
    <div class="mb-3">
      <label for="exampleFormControlInput3" class="form-label">Password</label>
      <input
        type="password"
        class="form-control"
        id="exampleFormControlInput3"
        placeholder="**********"
        v-model="form.password"
      />
    </div>
    <button type="submit">{{ login ? "Login" : "Register" }}</button>
  </form>
</template>

<script setup>
import axios from "axios";
import { ref } from "vue";
import { useRouter } from "vue-router";

const props = defineProps(["login"]);
const router = useRouter();

const form = ref({
  name: "",
  email: "",
  password: "",
});

const auth = async (login) => {
  const path = login ? "/api/login" : "/api/register";

  const { data } = await axios.post(path, form.value);
  console.log(data);

  if (login) {
    localStorage.setItem("userData", JSON.stringify(data?.user));
    localStorage.setItem("userToken", JSON.stringify(data?.token));
  }

  if (data?.user && !login) {
    router.push({ name: "login" });
  }

  if (data?.token && login) {
    router.push({ name: "home" });
  }
};
</script>

<style scoped>
.form_container {
  width: 80%;
  margin: 0 auto;
}

label {
  font-weight: 600;
}
button {
  width: 100%;
  margin-top: 10px;
  background: none;
  border: none;
  background-color: #5e72c2;
  color: white;
  padding: 1px 6px;
  border-radius: 5px;
  min-height: 30px;
}

button:hover {
  background-color: #d0a617;
  transition: all 0.2s ease-in;
}
</style>
