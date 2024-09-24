<template>
  <form class="row g-3 mx-2" @submit.prevent="updateUser">
    <div class="col-12">
      <UserAvatar
        :avatarPreview="avatarPreview"
        @update-avatar="handleAvatarUpdate"
      />
    </div>
    <div class="col-12">
      <label for="inputAddress" class="form-label">Name</label>
      <input
        type="text"
        class="form-control"
        id="inputAddress"
        placeholder="Your name"
        v-model="user.name"
      />
    </div>
    <div class="col-md-6">
      <label for="inputEmail4" class="form-label">Email</label>
      <input
        type="email"
        class="form-control"
        id="inputEmail4"
        placeholder="email@gmail.com"
        v-model="user.email"
      />
    </div>
    <div class="col-md-6">
      <label for="inputPassword4" class="form-label">Password</label>
      <input
        type="password"
        class="form-control"
        id="inputPassword4"
        placeholder="********"
        v-model="user.password"
      />
    </div>

    <div class="col-12">
      <button type="submit" class="btn btn_submit">Submit</button>
    </div>
  </form>
</template>

<script setup>
import { onMounted, ref } from "vue";
import axios from "../../../axiosToken";
import UserAvatar from "./UserAvatar.vue";

const avatarPreview = ref("");

const user = ref({
  name: "",
  email: "",
  password: "",
  avatar: "",
});

const getUser = async () => {
  try {
    const { data } = await axios.get("api/user");
    user.value = data?.user;
    user.value.password = data?.user?.decrypted_password;

    const baseURL = "http://localhost:8000"; // Change this to match your backend
    avatarPreview.value = user.value.avatar.startsWith("/storage")
      ? `${baseURL}${user.value.avatar}`
      : user.value.avatar;

    console.log(user.value);
  } catch (error) {
    console.log(error);
  }
};

const updateUser = async () => {
  try {
    let formData = new FormData();

    Object.entries(user.value).forEach(([key, value]) => {
      formData.append(key, value);
    });

    formData.append("_method", "PUT");
    const { data } = await axios.post("api/user/update", formData);
    console.log(data);
    getUser();
  } catch (error) {
    console.log(error);
  }
};

const handleAvatarUpdate = ({ preview, file }) => {
  avatarPreview.value = preview;
  user.value.avatar = file;
};

onMounted(() => {
  getUser();
});
</script>

<style scoped>
.btn_submit {
  background-color: #5e72c2;
  color: white;
}
</style>
