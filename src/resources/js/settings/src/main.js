// Initialize Vue Engine
import { createApp } from "vue";
import App from './App.vue';
import PrimeVue from 'primevue/config';
const app = createApp(App);

// Add locales management
import i18n from './locales';
app.use(i18n, PrimeVue)

import { createPinia } from 'pinia'
app.use(createPinia())

// Start the app
app.mount('#app')
