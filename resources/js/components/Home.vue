<template>
  <div class="project-container">
    <h1>Projects</h1>
    <button class="toggle-form-btn" @click="showCreateProjectForm = !showCreateProjectForm">
      {{ showCreateProjectForm ? 'Cancel' : 'Create New Project' }}
    </button>
    <div v-if="showCreateProjectForm" class="form-container">
      <input v-model="newProject.name" placeholder="Project Name" class="input-field">
      <textarea v-model="newProject.description" placeholder="Project Description" class="input-field"></textarea>
      <button @click="createProject" class="submit-btn">Create Project</button>
    </div>
    <ul class="project-list">
      <li v-for="project in projects" :key="project.id" class="project-item">
        <router-link :to="{ path: '/project/' + project.id }" class="project-link">{{ project.name }}</router-link>
        <button @click="deleteProject(project.id)" class="delete-btn">Delete</button>
      </li>
    </ul>
  </div>
</template>

<script>
export default {
  data() {
    return {
      showCreateProjectForm: false,
      newProject: {
        name: '',
        description: ''
      }
    };
  },
  computed: {
    projects() {
      return this.$store.state.projects;
    }
  },
  methods: {
    fetchProjects() {
      this.$store.dispatch('fetchProjects');
    },
    createProject() {
      this.$http.post('/projects', this.newProject)
        .then(() => {
          this.fetchProjects();
          this.showCreateProjectForm = false;
          this.newProject.name = '';
          this.newProject.description = '';
        })
        .catch(error => {
          console.error(error);
        });
    },
    deleteProject(id) {
      this.$http.delete(`/projects/${id}`)
        .then(() => {
          this.fetchProjects();
        })
        .catch(error => {
          console.error(error);
        });
    }
  },
  created() {
    this.fetchProjects();
  }
};
</script>

<style scoped>
.project-container {
  max-width: 800px;
  margin: auto;
  padding: 20px;
}

.toggle-form-btn {
  background-color: #007bff;
  color: #fff;
  border: none;
  padding: 8px 12px;
  border-radius: 4px;
  cursor: pointer;
  margin-bottom: 10px;
}

.form-container {
  margin-bottom: 20px;
}

.input-field {
  width: 100%;
  padding: 10px;
  margin-bottom: 10px;
  border: 1px solid #ccc;
  border-radius: 4px;
}

.submit-btn {
  background-color: #28a745;
  color: #fff;
  border: none;
  padding: 8px 12px;
  border-radius: 4px;
  cursor: pointer;
}

.project-list {
  list-style-type: none;
  padding: 0;
}

.project-item {
  display: flex;
  justify-content: space-between;
  align-items: center;
  border-bottom: 1px solid #ccc;
  padding: 10px 0;
}

.project-link {
  color: #333;
  text-decoration: none;
}

.delete-btn {
  background-color: #dc3545;
  color: #fff;
  border: none;
  padding: 6px 10px;
  border-radius: 4px;
  cursor: pointer;
}
</style>
