<template>
  <div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Register</div>

                <div class="panel-body">
                    <div class="alert alert-danger" v-if="error">
                        <h3>Registration failed.. Try again</h3>
                    </div>
                   
                        <div class="form-group">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6 mb-4">
                                <input id="email" type="email" class="form-control" v-model="user.email" required autofocus>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name" class="col-md-4 control-label">Username</label>

                            <div class="col-md-6 mb-4">
                                <input id="name" type="text" class="form-control" v-model="user.name" required>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6 mb-4">
                                <input id="password" type="password" class="form-control" v-model="user.password" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="passwordConfirmation" class="col-md-4 control-label">Confirm Password</label>

                            <div class="col-md-6 mb-4">
                              
                              <input id="passwordConfirmation" type="password"
                               class="form-control" v-model="user.confirmPassword" 
                                required>
                              <!-- <span class="error" v-if="isMatching"><small>password don't much</small></span> -->
                         </div>
                        </div>
                      
                       
                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary"
                                 @click.prevent="register" :disabled="shouldLogin">
                                   Register
                                </button>
                            </div>
                        </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
</template>
<script>
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
                    name:'',
                    email:'',
                    password:'',
                    confirmPassword:''
                },
                error:false,
              
            }
        },
        methods:{
            register(){
                //use ajax to check if email exists in the db
                //to be done
                const data ={
                    name: this.user.name,
                    email: this.user.email,
                    password:this.user.password
                };
                axios.post('/api/register',data).then(response=>{
                    if(response.status ===200){
                        if(response.data.message=='success'){
                          this.$router.push({name:'login'});
                        }     
                    }
   
                }).catch(err=>{
                    this.error = true;
                    console.log(err);
                })
            }
        },
        computed:{
           shouldLogin(){
               if(!this.user.name || !this.user.email || !this.user.password || !this.user.confirmPassword){
                      return true;
               }
               return false;
           }
        }
    
    }
</script>
<style lang="scss">
   .mb-4{
       margin-bottom: 4px;
   }
</style>



