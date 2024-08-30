<template>
  <div class="avatar-container flex justify-content-center">
    <label class="avatar-label">Avatar</label>
    <div class="avatar-wrapper">
      <input
        ref="fileInput"
        name="avatar"
        type="file"
        @change="handleFileUpload"
        accept="image/*"
        hidden
      />
      <button class="upload-button" type="button" @click="selectFile">
        <i class="bi bi-upload"></i>
      </button>
      <div class="image-preview">
        <img
          v-if="avatarPreview"
          :src="avatarPreview"
          alt="Avatar Preview"
          class="avatar-image"
        />
        <img
          v-else
          src="https://cdn-icons-png.freepik.com/512/147/147144.png"
          alt="Avatar Preview"
          class="avatar-image"
        />
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref } from "vue";

const fileInput = ref("");
const avatarPreview = ref("");

const selectFile = () => {
  fileInput.value.click();
};

const handleFileUpload = (event) => {
  let file = event.target.files[0];
  if (file) {
    const reader = new FileReader();
    reader.readAsDataURL(file);
    reader.onload = (e) => {
      avatarPreview.value = e.target.result;
    };
  }
};
</script>

<style scoped>
.avatar-container {
  max-width: 300px;
  margin: auto;
}

.avatar-label {
  font-size: 1.2em;
  margin-bottom: 0.5em;
  display: block;
  text-align: center;
}

.avatar-wrapper {
  position: relative;
  display: flex;
  justify-content: center;
  align-items: center;
}

.upload-button {
  position: absolute;
  bottom: 10px;
  right: 10px;
  background-color: #5e72c2;
  color: white;
  border: none;
  border-radius: 50%;
  width: 50px;
  height: 50px;
  display: flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
  transition: background-color 0.3s, transform 0.3s;
}

.upload-button:hover {
  background-color: #5c699d;
  transform: scale(1.05);
}

.upload-button i {
  font-size: 1.5em;
}

.image-preview {
  border: 1px solid var(--project-primary-color);
  border-radius: 50%;
  overflow: hidden;
}

.avatar-image {
  border-radius: 50%;
  width: 200px;
  height: 200px;
  object-fit: cover;
  display: block;
}
</style>
