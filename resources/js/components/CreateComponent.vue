<template>
  <div>
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
        <ul class="navbar-nav">
            <li class="nav-item">
            <router-link to="/home" class="nav-link">Home</router-link>
            </li>
            <li class="nav-item">
            <router-link to="/create" class="nav-link">Create Post</router-link>
            </li>
            <li class="nav-item">
            <router-link to="/posts" class="nav-link">Posts</router-link>
            </li>
        </ul>
    </nav>
    <h1>Create A Post</h1>
    <form @submit.prevent="addPost">
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <table>
              <tr>
                <td>Date</td>
                <td> : </td>
                <td><input type="date" class="form-control" v-model="post.date_created"></td>
              </tr>
              <tr>
                <td>Title</td>
                <td> : </td>
                <td><input type="text" class="form-control" v-model="post.title"></td>
              </tr>
              <tr>
                <td>Description</td>
                <td> : </td>
                <td><textarea class="form-control" v-model="post.description" rows="5"></textarea></td>
              </tr>
              <tr>
                <td>Keyword</td>
                <td> : </td>
                <td><input type="text" class="form-control" v-model="post.keywords"></td>
              </tr>
              <tr>
                <td>Data Source</td>
                <td> : </td>
                <td><input type="file" @change="previewFiles"></td>
              </tr>
              <tr>
                <td>Articles</td>
                <td>:</td>
                <td><textarea class="form-control" v-model="post.articles" rows="5"></textarea></td>
              </tr>
            </table>
          </div>
        </div>
      </div>
        <div class="form-group">
          <button class="btn btn-primary">Create</button>
        </div>
    </form>
  </div>
</template>

<script>
    export default {
        data(){
        return {
          post:{}
        }
    },
    methods: {
      addPost(){
        let uri = 'http://127.0.0.1:8000/api/post/create';
        console.log({posts: this.post});
        this.axios.post(uri, this.post).then((response) => {
        this.$router.push({name: 'posts'});
        }).catch(error => console.log({error}));
      },
      previewFiles(event) {
        this.post.file = event.target.files;
      }
    }
  }
</script>