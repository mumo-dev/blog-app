<template>
  <div>
    <h2>Posts</h2>
    <article v-for="post in posts" :key="post.id">
      <app-post :post="post"></app-post>
    </article>
      
  </div>
</template>
<script>
  import Post from  './Post.vue'
  export default {
    
     components:{
      'app-post':Post
     },
     computed: {
       posts(){
        return this.$store.getters.posts;
       }
     },
    created(){
          this.fetchPosts();
    },
    methods: {
      fetchPosts(){
           axios('api/posts')
            .then(({data})=>{
              this.$store.dispatch('initPosts',data);
           })
      }
    }
  }
</script>

