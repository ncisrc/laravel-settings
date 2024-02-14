// Initialize Vue Engine
import { createApp } from "vue";
import App from './App.vue';

import "./index.css";
import "primevue/resources/themes/saga-blue/theme.css"      //theme
import "primevue/resources/primevue.min.css"                //core css
import "primeicons/primeicons.css"                          //icons

const app = createApp(App);

// Add locales management
import i18n from './locales';
app.use(i18n)

import { createPinia } from 'pinia'
app.use(createPinia())

import PrimeVue from 'primevue/config';
app.use(PrimeVue);

// Start the app
app.mount('#app')
