<template>

  <div class="panel panel-default">
     <div class="panel-body">
        <h3 style="text-decoration:underline"><strong>{{post.title }}</strong></h3> 
         <h4 class="text-muted"> Post by {{post.user.name }} at <small> {{ post.created_at}} </small> </h4>
         <p>
             {{ post.body }}<br>
             <router-link :to="'/posts/'+post.id">Read More...</router-link>
        </p> 
     </div>
  </div>
</template>
<script>
    export default {
       props:['post']
    }
</script>
<style scoped>

</style>


