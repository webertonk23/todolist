<template>
  <!--  Header Start -->
  <header class="app-header">
    <nav class="navbar navbar-expand-lg justify-content-md-center">
      <ul class="navbar-nav">
        <li class="nav-item" v-for="(link, index) in links" :key="index">
          <RouterLink class="nav-link nav-icon-hover" :to="link.route">
            <i :class="link.icon" :title="link.name"></i>
          </RouterLink>
        </li>
      </ul>
    </nav>
  </header>
  <!--  Header End -->
</template>

<style scoped>
.app-header {
  background-color: #b54319fd;
  color: #fff;
  margin-bottom: 20px;
}

.app-header li a {
  color: #fff;
  transition: 0.3s;
}

.app-header li :hover {
  color: #b54319fd;
}
</style>

<script>
export default {
  name: "Navbar",
  data() {
    return {
      links: [
        {
          route: "/",
          name: "Home",
          icon: "ti ti-home",
        },
        {
          route: "/listas",
          name: "Listas",
          icon: "ti ti-list",
        },
      ],
    };
  },
};
</script>