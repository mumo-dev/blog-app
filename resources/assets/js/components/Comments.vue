<template>
  <div>
      <ul class="list-group">
          <li class="list-group-item" v-for="comment in comments" :key="comment.id">
             <p> {{ comment.body }}</p>
              <span class="">
              <small><strong> Comment by:{{ comment.user.name }}</strong></small>
                 at {{ comment.created_at}}
             </span>
          </li>
      </ul>
  </div>
</template>
<script>
    export default {
       props:['comments']
    
    }
</script>
<style scoped>

</style>

