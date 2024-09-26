<template>
  <div class="cardContainer">
    <div
      v-if="loading"
      class="d-flex justify-content-center align-items-center"
      style="height: 100%"
    >
      <div class="spinner-border text-primary" role="status"></div>
    </div>
    <div v-else class="card_info">
      <div class="image-preview">
        <img v-if="avatarPreview" :src="avatarPreview" class="avatar-image" />
        <img
          v-else
          src="https://cdn-icons-png.freepik.com/512/147/147144.png"
          class="avatar-image"
        />
      </div>

      <div class="user-details">
        <div class="user-info">
          <span class="label">Name:</span>
          <span class="value">{{ user.name || "N/A" }}</span>
        </div>
        <div class="user-info">
          <span class="label">Email:</span>
          <span class="value">{{ user.email || "N/A" }}</span>
        </div>
      </div>

      <router-link to="/editUser" class="edit-button">Edit</router-link>
    </div>
  </div>
</template>

<script setup>
import { onMounted, ref } from "vue";
import axios from "../../../axiosToken";

const user = ref({
  name: "",
  email: "",
  password: "",
  avatar: "",
});
const avatarPreview = ref("");

const loading = ref(true);

const getUser = async () => {
  try {
    const { data } = await axios.get("api/user");
    user.value = data?.user;
    user.value.password = data?.user?.decrypted_password;

    const baseURL = "http://localhost:8000";
    avatarPreview.value = user.value.avatar.startsWith("/storage")
      ? `${baseURL}${user.value.avatar}`
      : user.value.avatar;

    console.log(user.value);
  } catch (error) {
    console.log(error);
  } finally {
    loading.value = false;
  }
};

onMounted(() => {
  getUser();
});
</script>

<style scoped>
.cardContainer {
  width: 100%;
  max-width: 100%;
  height: 100%;
  padding: 20px;
  display: flex;
  align-items: center;
  justify-content: center;
  background-color: white;
  border-radius: 10px;
  box-shadow: 0 2px 4px #5e72c2;
  text-align: center;
}

.card_info {
  /*  border: 1px solid red; */
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  height: 100%;
  width: 85%;
}

.image-preview {
  margin-bottom: 20px;
  border-radius: 50%;
  overflow: hidden;
  border: 4px solid #5e72c2;
  width: 150px;
  height: 150px;
}

.avatar-image {
  width: 100%;
  height: 100%;
  object-fit: cover;
}

.user-details {
  margin-top: 15px;
  width: 100%;
}

.user-info {
  display: flex;
  justify-content: space-between;
  padding: 10px 0;
  border-bottom: 1px solid #ececec;
}

.label {
  font-weight: 600;
  color: #5e72c2;
}

.value {
  font-weight: 400;
  color: #333;
}

.user-info:last-child {
  border-bottom: none;
}
.edit-button {
  display: inline-block;
  padding: 5px 30px;
  margin-top: 20px;
  background-color: #5e72c2;
  color: white;
  border: none;
  border-radius: 5px;
  text-decoration: none;
  font-weight: 600;
  transition: background-color 0.3s;
}

.edit-button:hover {
  background-color: #4a5b9d;
}
</style>
