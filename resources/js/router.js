import { createRouter, createWebHistory } from 'vue-router';

import Home from './components/Home.vue';
import Notifications from './components/Notifications.vue';
import Project from './components/Project.vue';

const routes = [
    { path: '/', component: Home },
    { path: '/project/:id', component: Project },
    { path: '/notifications', component: Notifications }
];

const router = createRouter({
    history: createWebHistory(),
    routes
});

export default router;
