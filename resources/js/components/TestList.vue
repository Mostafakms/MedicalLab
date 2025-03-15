<template>
    <div class="container mt-5">
      <h2>Test List</h2>
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>Name</th>
            <th>Category</th>
            <th>Price</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="test in tests" :key="test.id">
            <td>{{ test.name }}</td>
            <td>{{ test.category }}</td>
            <td>{{ test.price }}</td>
          </tr>
        </tbody>
      </table>
    </div>
  </template>
  
  <script>
  export default {
    data() {
      return {
        tests: []
      };
    },
    mounted() {
      this.fetchTests();
    },
    methods: {
      fetchTests() {
        // Make API call to get the tests from Laravel backend
        axios.get('/api/tests')
          .then(response => {
            this.tests = response.data;
          });
      }
    }
  };
  </script>
  
  <style scoped>
  table th, table td {
    text-align: center;
  }
  </style>
  