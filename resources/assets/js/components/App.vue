<template>
    <div class="container">
        <nav-bar></nav-bar>
        <router-view></router-view>
    </div>
</template>

<script>
    import Navbar from './Navbar.vue';
    export default {
        components:{
            navBar:Navbar
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
