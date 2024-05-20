<template>
  <div>
    <h1>Notifications</h1>
    <ul>
      <li v-for="notification in notifications" :key="notification.id">
        {{ notification.data }}
        <button @click="markAsRead(notification.id)">Mark as Read</button>
      </li>
    </ul>
  </div>
</template>

<script>
export default {
  data() {
    return {
      notifications: []
    };
  },
  methods: {
    fetchNotifications() {
      this.$http.get('/notifications').then(response => {
        this.notifications = response.data;
      });
    },
    markAsRead(id) {
      this.$http.post(`/notifications/${id}/markAsRead`).then(() => {
        this.fetchNotifications();
      });
    }
  },
  created() {
    this.fetchNotifications();
  }
};
</script>
