<template>
  <div class="list row">
    <div class="col-md-6">
      <h4>Notes List</h4>
      <ul class="list-group">
        <li class="list-group-item"
            :class="{ active: index == currentIndex }"
            v-for="(note, index) in notes"
            :key="index"
            @click="setActive(note, index)"
        >
          {{ note.title }}
        </li>
      </ul>

      <div class="col-md-12 text-center">
        <router-link :to="'/add'" class="m-1 btn btn-sm btn-dark">Add note</router-link>
      </div>
    </div>
    <div class="col-md-6">
      <div v-if="curNote">
        <h4>{{curNote.title}}</h4>
        <div>
          <label><strong>Login:</strong></label>
          <span contenteditable @input="updateContent($event, 'Login')"> {{ curNote.login }} </span>
        </div>
        <div>
          <label><strong>Password:</strong></label>
          <span contenteditable @input="updateContent($event, 'Password')"> {{ curNote.password }} </span>
        </div>
        <div>
          <label><strong>URL:</strong></label>
          <span contenteditable @input="updateContent($event, 'url')">{{ curNote.url }} </span>
        </div>
        <div>
          <label><strong>Note:</strong></label>
          <span contenteditable @input="updateContent($event, 'note')"> {{ curNote.note }} </span>
        </div>
        <div>
          <button class="btn btn-sm btn-info" @click="editNote(curNote.id, curNote)">
            Edit
          </button>
          <button class="m-3 btn btn-sm btn-danger" @click="removeNote(curNote.id)">
            Remove
          </button>
        </div>
      </div>
      <div v-else>
        <br />
        <p>Click on a note.</p>
      </div>
    </div>
  </div>
</template>

<script>
import DataService from "@/services/links";
export default {
  name: "tutorials-list",
  data() {
    return {
      notes: [],
      curNote: null,
      currentIndex: -1,
      title: ""
    };
  },
  methods: {
    retrieveNotes() {
      DataService.getAll()
          .then(response => {
            this.notes = response.data.data;
          })
          .catch(e => {
            console.log(e);
          });
    },
    refreshList() {
      this.retrieveNotes();
      this.curNote = null;
      this.currentIndex = -1;
    },
    setActive(tutorial, index) {
      this.curNote = tutorial;
      this.currentIndex = tutorial ? index : -1;
    },

    editNote(id, obj){
      console.log(obj)
      DataService.update(id, obj)
          .then(response => {
            this.refreshList();
          })
          .catch(e => {
            console.log(e);
          });
    },
    
    removeNote(id) {
      DataService.delete(id)
          .then(response => {
            this.refreshList();
          })
          .catch(e => {
            console.log(e);
          });
    },
    updateContent(e, contentType) {
      const inputText = e.target.innerHTML;
      switch (contentType) {
        case "Login":
          this.curNote.login = inputText;
          break;
        case "Password":
          this.curNote.password = inputText;
          break;
        case "url":
          this.curNote.url = inputText;
          break;
        case "note":
          this.curNote.note = inputText;
          break;
        default:
          break;
      }
    },
  },
  mounted() {
    this.retrieveNotes();
  }
};
</script>

<style>
.list {
  text-align: left;
  max-width: 750px;
  margin: auto;
}
[contenteditable="true"]:focus{
  border:none;
  outline:none;
}
</style>