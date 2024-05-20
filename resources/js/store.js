import axios from 'axios';
import { createStore } from 'vuex';

const store = createStore({
    state: {
        projects: [],
        notifications: []
    },
    mutations: {
        SET_PROJECTS(state, projects) {
            state.projects = projects;
        },
        SET_NOTIFICATIONS(state, notifications) {
            state.notifications = notifications;
        }
    },
    actions: {
        fetchProjects({ commit }) {
            axios.get('/projects')
                .then(response => {
                    commit('SET_PROJECTS', response.data);
                });
        },
        fetchNotifications({ commit }) {
            axios.get('/notifications')
                .then(response => {
                    commit('SET_NOTIFICATIONS', response.data);
                });
        }
    },
    modules: {}
});

export default store;
