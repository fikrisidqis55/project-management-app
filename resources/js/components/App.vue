<template>
  <div>
    <nav>
      <router-link to="/">Home</router-link>
      <router-link to="/notifications">Notifications</router-link>
    </nav>
    <router-view></router-view>
  </div>
</template>

<script>
export default {
  // Root component logic here
};
</script>

<style scoped>
nav {
  display: flex;
  gap: 10px;
  background-color: #f8f9fa;
  padding: 10px;
}
</style>
