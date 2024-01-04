<template>
  <Navbar />
  <div class="container-fluid">
    <div class="row">
      <router-view />
    </div>
  </div>
</template>

<script>
import axios from 'axios';
import Navbar from "./Navbar.vue";

export default {
  name: "App",
  components: { Navbar },
};
</script>