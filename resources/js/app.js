import App from './components/App.vue';
import axios from 'axios';
import { createApp } from 'vue';
import router from './router';
import store from './store';

const app = createApp(App);

app.config.globalProperties.$http = axios;
app.use(router);
app.use(store);
app.mount('#app');
