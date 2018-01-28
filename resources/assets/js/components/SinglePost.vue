<template>
  <div class="panel panel-default">
     <div class="panel-body">
         <div class="alert alert-danger" v-if="loading">
             <p>loading...</p>
         </div>
          <div class="alert alert-danger" v-if="error">
             <p> An error occured while fetching data </p>
         </div>
        <h3 style="text-decoration:underline">
            <strong>{{post.title }}</strong>
            </h3> 
             <h4 class="text-muted"> Post by 
                 {{post_by }} at <small> {{ post.created_at}} </small>
             </h4> 
             <p>
             {{ post.body }}<br>
             </p> 
        <hr/>
         <!-- create comment -->
        <div v-if="canComment">
           <div class="form-group">
               <textarea class="form-control" v-model="comment"></textarea>
           </div>
           <button class="btn btn-primary" @click="postComment" :disabled="comment.length < 2">Post Comment</button>
        </div>
        <div v-else>
            <div class="alert alert-info">
              Please Login to be able to comment
            </div>
        </div>
        <hr>
         <!-- display comments -->
        <h2 class="text-ceenter">Post Comments </h2>
        <app-comment :comments="comments"></app-comment>
         
     </div>
  </div>
</template>
<script>
  import Comments from './Comments.vue'
   export default{
       components:{
          'app-comment':Comments
       },
        data(){
            return {
               loading:true,
               error:false,
               comment:''
            }
       },
       watch:{
          '$route':'fetchPost'
       },
       computed:{
         post(){
             return this.$store.getters.post;
         },
         comments(){
             return this.$store.getters.comments;
         },
         post_by(){
             if(this.post.user != undefined){
                 return this.post.user.name;
             }
         },
         canComment(){
             const res = this.isLoggedIn();
             return res=== 0? false: true;
         }
       },
       created(){
           this.fetchPost();
       },
       methods:{
           fetchPost(){
               this.loading=true
               axios.get('/api/posts/'+ this.$route.params.id)
               .then(({data})=>{
                   this.$store.dispatch('initPost',data);
                   this.loading =false;
               }).catch(err=>{
                  this.error = true;
                  console.log(err);
               });
           },
           postComment(){
               const data= {
                  user_id:this.isLoggedIn(),
                  post_id: this.post.id,
                  body: this.comment
               };
            //    console.log(data);
            axios.post('/api/comments',data)
               .then(response=>{
                   console.log(response.data);
                   this.$store.dispatch('addComment',response.data);
                   this.comment ='';
               }).catch(err=>{
                   console.log(err);
               })

           },
           isLoggedIn(){
               const user = JSON.parse(window.localStorage.getItem('authUser'));
               if(user && user.access_token){
                   return user.id;
               }else{
                   return 0
               }
           }
       }
   }
</script>
<style scoped>

</style>
