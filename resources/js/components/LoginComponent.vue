<template>
  <div>
        <form @submit.prevent="login">
          <center>
            <table>
              <div>Username</div>
              <input class="form-control" v-model="user.nickname" type="text"/>
              <div>Password</div>
              <input class="form-control" v-model="user.password" type="password"/>
              <div class="form-group">
                  <br>
            <button class="btn btn-primary">Login</button>
            </div>
          </table>

          </center>
          
        </form>

  </div>
</template>

<script>
  export default {
      data() {
        return {
          user: {}
        }
    },
    methods: {
      login(){
        console.log({test: this.user});
        let uri = 'http://127.0.0.1:8000/api/user/login';
        this.axios.post(uri, this.user).then((response) => {
            if(response.data.status === 0) {
                alert(response.data.message);
            }else{
                alert(response.data.message);
                this.$router.push({name: 'home'});
            }
        }).catch(error => console.log({error}));
      }
    }
  }
</script>
