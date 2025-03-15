vue
<template>
  <div>
    <nav class="navbar">
      <h1>Medical Lab System</h1>
      <ul>
        <li><router-link to="/">Home</router-link></li>
        <li><router-link to="/results">Results</router-link></li>
        <li><router-link to="/submit">Submit Patient</router-link></li>
      </ul>
    </nav>

    <router-view></router-view>
  </div>
</template>

<script>
export default {
  name: "Dashboard",
};
</script>

<style scoped>
.navbar {
  background-color: #2c3e50;
  color: white;
  padding: 1rem;
}
.navbar ul {
  list-style-type: none;
  padding: 0;
}
.navbar li {
  display: inline;
  margin-right: 20px;
}
</style>