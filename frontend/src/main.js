import { createApp } from 'vue'
import './style.css'
import './index.css'
import Store from './store/index.js'
import Router from './router/index.js'
import App from './App.vue'

createApp(App)
    .use(Store)
    .use(Router)
    .mount('#app')
