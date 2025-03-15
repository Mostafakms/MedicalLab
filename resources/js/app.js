require('./bootstrap');
import { createApp } from 'vue';
import 'bootstrap/dist/js/bootstrap.bundle.min.js';
import TestList from './components/TestList.vue';
const app = createApp({});

// Register your components
app.component('test-list', TestList);
app.mount('#app');
