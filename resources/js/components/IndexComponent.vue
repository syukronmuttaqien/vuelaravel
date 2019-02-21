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
      <h1>Posts</h1>
        <div class="row">
          <div class="col-md-10"></div>
          <div class="col-md-2">
            <router-link :to="{ name: 'create' }" class="btn btn-primary">Create Post</router-link>
          </div>
        </div><br />

        <table class="table table-hover">
            <thead>
            <tr>
                <th>Date</th>
                <th>Title</th>
                <th>Description</th>
                <th>Keyword</th>
                <th>Articles</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
                <tr v-for="post in posts" :key="post.id_data">
                    <td>{{ post.date_created }}</td>
                    <td>{{ post.title }}</td>
                    <td>{{ post.description }}</td>
                    <td>{{ post.keywords }}</td>
                    <td>{{ post.articles }}</td>
                    <td><router-link :to="{name: 'edit', params: { id_data: post.id_data }}" class="btn btn-primary">Edit</router-link></td>
                    <td><button class="btn btn-danger" @click.prevent="deletePost(post.id_data)">Delete</button></td>
                </tr>
            </tbody>
        </table>
  </div>
</template>

<script>
  export default {
      data() {
        return {
          posts: []
        }
      },
      created() {
        let uri = 'http://127.0.0.1:8000/api/posts';
        this.axios.get(uri).then(response => {
          this.posts = response.data.data;
          console.log('terpanggil')
        }).catch(error => console.log({error}));
      },
    methods: {
      deletePost(id_data)
      {
        let uri = `http://127.0.0.1:8000/api/post/delete/${id_data}`;
        this.axios.delete(uri).then(response => {
          this.posts.splice(this.posts.indexOf(id_data), 1);
        });
      }
    }
  }
</script>
