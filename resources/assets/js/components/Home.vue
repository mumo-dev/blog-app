<template>
  <div>
    <h2>Posts</h2>
    <article v-for="post in posts" :key="post.id">
      <app-post :post="post"></app-post>
      
    </article>
      
     <div class="pagination">
        <button class="btn btn-primary" @click="fetchPosts(pagination.prev_page_url)"
                :disabled="!pagination.prev_page_url">
            Previous
        </button>
        <span>Page {{pagination.current_page}} of {{pagination.last_page}}</span>
        <button class="btn btn-primary" @click="fetchPosts(pagination.next_page_url)"
                :disabled="!pagination.next_page_url">Next
        </button>
    </div>

  </div>
</template>
<script>
  import Post from  './Post.vue'
  export default {
    data(){
      return{
        pagination:{}
      }
    },
    
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
      fetchPosts(page_url){
           page_url = page_url || '/api/posts/';
           axios(page_url)
            .then(({data})=>{
              this.makePagination(data);
              this.$store.dispatch('initPosts',data.data);
           })
      },
       makePagination(data){
                let pagination = {
                current_page: data.current_page,
                last_page: data.last_page,
                next_page_url: data.next_page_url,
                prev_page_url: data.prev_page_url
             };
            this.pagination= pagination;
        }
    }
  }
</script>

