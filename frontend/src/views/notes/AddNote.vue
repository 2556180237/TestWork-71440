<template>
  <div class="submit-form col-md-12">
    <div v-if="!submitted">
      <div class="form-group">
        <label for="title">Title</label>
        <input
            type="text"
            class="form-control"
            id="title"
            required
            v-model="newNote.title"
            name="title"
        />
      </div>
      <div class="form-group">
        <label for="description">Login</label>
        <input
            class="form-control"
            id="description"
            required
            v-model="newNote.login"
            name="description"
        />
      </div>
      <div class="form-group">
        <label for="description">Password</label>
        <input
            class="form-control"
            id="description"
            required
            v-model="newNote.password"
            name="description"
        />
      </div>

      <div class="form-group">
        <label for="description">Url</label>
        <input
            class="form-control"
            id="description"
            required
            v-model="newNote.url"
            name="description"
        />
      </div>

      <div class="form-group">
        <label for="description">Description</label>
        <input
            class="form-control"
            id="description"
            required
            v-model="newNote.note"
            name="description"
        />
      </div>
      <div>
        <button  @click="saveNote" style="margin-top: 5px;" class="btn btn-success col-md-12 text-center">Submit</button>
      </div>
    </div>

    <div v-else>
      <h4>You submitted successfully!</h4>
      <button class="btn btn-success" @click="addNew">Add</button>
    </div>
  </div>
</template>

<script>
import DataService from "@/services/links";
import router from '@/router/'
export default {
  name: "add-tutorial",
  data() {
    return {
      newNote: {
        title: "",
        login: "",
        password: "",
        url: "",
        note: ""
      },
      submitted: false
    };
  },
  methods: {
    saveNote() {
      let data = {
        title: this.newNote.title,
        login: this.newNote.login,
        password: this.newNote.password,
        url: this.newNote.url,
        note: this.newNote.note
      };
      DataService.create(data)
          .then(response => {
            return router.push({
              name: 'notes'
            })
          })
          .catch(e => {
            console.log(e);
          });
    },

    addNew() {
      this.submitted = false;
      this.tutorial = {};
    }
  }
};
</script>

<style>
.submit-form {
  max-width: 300px;
  margin: auto;
}
</style>