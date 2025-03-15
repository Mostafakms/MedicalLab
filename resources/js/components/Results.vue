vue
<template>
  <div>
    <h2>Lab Results</h2>
    <table>
      <thead>
        <tr>
          <th>Patient Name</th>
          <th>Test Type</th>
          <th>Result</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="result in results" :key="result.id">
          <td>{{ result.patient_name }}</td>
          <td>{{ result.test_type }}</td>
          <td>{{ result.result }}</td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
export default {
  data() {
    return {
      results: [],
    };
  },
  created() {
    this.fetchResults();
  },
  methods: {
    async fetchResults() {
      const response = await fetch('/api/results');
      this.results = await response.json();
    },
  },
};
</script>

<style scoped>
table {
  width: 100%;
  border-collapse: collapse;
}
th, td {
  border: 1px solid #ddd;
  padding: 8px;
}
</style>
