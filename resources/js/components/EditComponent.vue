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
    <h1>Edit Post</h1>
    <form @submit.prevent="updatePost">
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
                <td>Articles</td>
                <td>:</td>
                <td><textarea class="form-control" v-model="post.articles" rows="5"></textarea></td>
              </tr>
            </table>
          </div>
        </div>
        </div>
        <!-- <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>Post Body:</label>
              <textarea class="form-control" v-model="post.body" rows="5"></textarea>
            </div>
          </div>
        </div><br /> -->
        <div class="form-group">
          <button class="btn btn-primary">Update</button>
        </div>
    </form>
  </div>
</template>

<script>
    export default {

      data() {
        return {
          post: {}
        }
      },
      created() {
        let uri = `http://127.0.0.1:8000/api/post/edit/${this.$route.params.id_data}`;
        this.axios.get(uri).then((response) => {
            this.post = response.data;
        }).catch(error => console.log({error}));
      },
      methods: {
        updatePost() {
          let uri = `http://127.0.0.1:8000/api/post/update/${this.$route.params.id_data}`;
          this.axios.post(uri, this.post).then((response) => {
            this.$router.push({name: 'posts'});
          });
        }
      }
    }
</script>