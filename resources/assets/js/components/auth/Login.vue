<template>
  <div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Login</div>
    

                <div class="panel-body">
                    <div class="alert alert-danger" v-if="error">
                        <h4> Authentication failed!! check your credentials and try again</h4>
                    </div>
                   
                        <div class="form-group ">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6 mb-4">
                                <input id="email" type="email" class="form-control" v-model="user.email" required autofocus>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6 mb-4">
                                <input id="password" type="password" class="form-control" v-model="user.password" required>
                            </div>
                        </div>
                      
                       
                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary" @click.prevent="login">
                                    Login
                                </button>

                                <a class="btn btn-link" href="#">
                                    Forgot Your Password?
                                </a>
                            </div>
                        </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
</template>
<script>
import { getHeader}  from '../../config'
    export default {
        beforeRouteEnter(to,from,next){
           const authUser = JSON.parse(window.localStorage.getItem('authUser'));
           if(authUser && authUser.access_token){
               next(false);
           }else{
               next();
           }
        },
       data(){
           return{
               user:{
                  email:'',
                  password:''
               },
               error:false,
            
           }
       },
       methods:{
           login(){
               const data ={
                   client_id:2,
                   client_secret:'L6AZifzmerxTmeHkBv9Wf0kO5wrtFZjnZ3VlRoqu',
                   grant_type:'password',
                   username:this.user.email,
                   password:this.user.password
               };
               const authUser ={};
               axios.post('/oauth/token',data).then(response=>{
                   if(response.status == 200){
                     console.log(response);
                     authUser.access_token = response.data.access_token;
                     authUser.refresh_token = response.data.refresh_token;
                     window.localStorage.setItem('authUser',JSON.stringify(authUser));

                     axios.get('/api/user',{ headers: getHeader()}).then(({data})=>{
                           authUser.username = data.name;
                           authUser.email = data.email;
                           authUser.id = data.id;
                           window.localStorage.setItem('authUser',JSON.stringify(authUser));
                     });
                    //check the route the user was coming from, redirect there;
                    //tobe done
                     this.$store.dispatch('setLoginInfo',false);
                     this.$router.push({name:'home'});
                     
                   }
                   
               }).catch(err=>{
                   console.log(err);
                   this.error = true;
                   this.user.password=''
               })
           }
       }
    }
</script>
<style scoped>
    .mb-4{
        margin-bottom: 4px!important;
    }
</style>


