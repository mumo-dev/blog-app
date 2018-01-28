<template>
  <nav class="nav nav-pills">
      <router-link :to="{name:'home'}" tag="li" exact><a> Home</a></router-link>
      <!-- <router-link :to="{name:'blog'}" tag="li"><a> Our blog</a></router-link> -->
      <router-link :to="{name:'contact'}" tag="li"><a> Contact us</a></router-link>
      <router-link :to="{name:'about'}" tag="li"><a> About us</a></router-link>

        <router-link :to="{name:'login'}" tag="li" class="pull-right" v-if="displayLogin"><a> Login</a></router-link>
        <router-link :to="{name:'register'}" tag="li"  class="pull-right" v-if="displayLogin"><a> Register</a></router-link>

    
        <li class="pull-right" v-if="!displayLogin"><a href="#" @click.prevent="logout">Log out</a></li>
      
  </nav>
</template>
<script>
    export default {
        computed:{
           displayLogin(){
               return this.$store.getters.displayLogin;
           }
        },
       methods:{
           logout(){
               window.localStorage.removeItem('authUser');
               this.$store.dispatch('setLoginInfo',true);
               document.location.reload(true);
           }

       }
    }
</script>
<style scoped>
   .nav{
       margin-bottom: 30px;
       background: white;
       padding: 5px;
       border-radius: 2px;
   }
</style>


