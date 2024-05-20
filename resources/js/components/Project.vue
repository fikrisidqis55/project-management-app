<template>
  <div>
    <h1>{{ project.name }}</h1>
    <p>{{ project.description }}</p>
    
    <h2>Tasks</h2>
    <button @click="showCreateTaskForm = !showCreateTaskForm">
      {{ showCreateTaskForm ? 'Cancel' : 'Create New Task' }}
    </button>
    <div v-if="showCreateTaskForm">
      <input v-model="newTask.title" placeholder="Task Title">
      <textarea v-model="newTask.description" placeholder="Task Description"></textarea>
      <input type="date" v-model="newTask.deadline">
      <select v-model="newTask.user_id">
        <option v-for="user in users" :value="user.id">{{ user.name }}</option>
      </select>
      <button @click="createTask">Create Task</button>
    </div>
    <ul>
      <li v-for="task in project.tasks" :key="task.id">
        <strong>{{ task.title }}</strong> - {{ task.status }} - {{ task.deadline }}
        <button @click="deleteTask(task.id)">Delete</button>
      </li>
    </ul>
    
    <h2>Milestones</h2>
    <button @click="showCreateMilestoneForm = !showCreateMilestoneForm">
      {{ showCreateMilestoneForm ? 'Cancel' : 'Create New Milestone' }}
    </button>
    <div v-if="showCreateMilestoneForm">
      <input v-model="newMilestone.name" placeholder="Milestone Name">
      <textarea v-model="newMilestone.description" placeholder="Milestone Description"></textarea>
      <input type="date" v-model="newMilestone.deadline">
      <button @click="createMilestone">Create Milestone</button>
    </div>
    <ul>
      <li v-for="milestone in project.milestones" :key="milestone.id">
        <strong>{{ milestone.name }}</strong> - {{ milestone.deadline }}
        <button @click="deleteMilestone(milestone.id)">Delete</button>
      </li>
    </ul>
  </div>
</template>

<script>
export default {
  data() {
    return {
      project: {
        tasks: [],
        milestones: []
      },
      showCreateTaskForm: false,
      showCreateMilestoneForm: false,
      newTask: {
        title: '',
        description: '',
        deadline: '',
        user_id: ''
      },
      newMilestone: {
        name: '',
        description: '',
        deadline: ''
      },
      users: []
    };
  },
  methods: {
    fetchProject() {
      this.$http.get(`/projects/${this.$route.params.id}`).then(response => {
        this.project = response.data;
      });
    },
    fetchUsers() {
      this.$http.get('/users').then(response => {
        this.users = response.data;
      });
    },
    createTask() {
      this.newTask.project_id = this.project.id;
      this.$http.post('/tasks', this.newTask).then(() => {
        this.fetchProject();
        this.showCreateTaskForm = false;
        this.newTask = { title: '', description: '', deadline: '', user_id: '' };
      });
    },
    deleteTask(id) {
      this.$http.delete(`/tasks/${id}`).then(() => {
        this.fetchProject();
      });
    },
    createMilestone() {
      this.newMilestone.project_id = this.project.id;
      this.$http.post('/milestones', this.newMilestone).then(() => {
        this.fetchProject();
        this.showCreateMilestoneForm = false;
        this.newMilestone = { name: '', description: '', deadline: '' };
      });
    },
    deleteMilestone(id) {
      this.$http.delete(`/milestones/${id}`).then(() => {
        this.fetchProject();
      });
    }
  },
  created() {
    this.fetchProject();
    this.fetchUsers();
  }
};
</script>

<style>
/* Style for Project Name */
h1 {
  font-size: 24px;
  color: #333;
  margin-bottom: 20px;
}

/* Style for Project Description */
p {
  font-size: 16px;
  color: #666;
  margin-bottom: 20px;
}

/* Style for Tasks and Milestones */
h2 {
  font-size: 20px;
  color: #333;
  margin-top: 30px;
  margin-bottom: 10px;
}

/* Style for Create New Task and Create New Milestone buttons */
button {
  background-color: #4CAF50;
  color: white;
  padding: 10px 20px;
  border: none;
  cursor: pointer;
  margin-bottom: 10px;
}

button:hover {
  background-color: #45a049;
}

/* Style for input fields */
input[type="text"],
input[type="date"],
textarea,
select {
  width: 100%;
  padding: 10px;
  margin-bottom: 10px;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
}

/* Style for task and milestone items */
li {
  list-style-type: none;
  border: 1px solid #ccc;
  border-radius: 4px;
  padding: 10px;
  margin-bottom: 10px;
}

/* Style for task and milestone item buttons */
li button {
  background-color: #f44336;
  color: white;
  padding: 5px 10px;
  border: none;
  cursor: pointer;
  float: right;
}

li button:hover {
  background-color: #d32f2f;
}
</style>
