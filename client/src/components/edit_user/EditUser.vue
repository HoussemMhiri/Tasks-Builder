<template>
  <form class="row g-3 mx-2">
    <div class="col-12">
      <UserAvatar />
    </div>
    <div class="col-12">
      <label for="inputAddress" class="form-label">Name</label>
      <input
        type="text"
        class="form-control"
        id="inputAddress"
        placeholder="Your name"
      />
    </div>
    <div class="col-md-6">
      <label for="inputEmail4" class="form-label">Email</label>
      <input
        type="email"
        class="form-control"
        id="inputEmail4"
        placeholder="email@gmail.com"
      />
    </div>
    <div class="col-md-6">
      <label for="inputPassword4" class="form-label">Password</label>
      <input
        type="password"
        class="form-control"
        id="inputPassword4"
        placeholder="********"
      />
    </div>

    <div class="col-12">
      <button type="button" class="btn btn_submit">Submit</button>
    </div>
  </form>
</template>

<script setup>
import UserAvatar from "./UserAvatar.vue";
</script>

<style scoped>
.btn_submit {
  background-color: #5e72c2;
  color: white;
}
</style>
