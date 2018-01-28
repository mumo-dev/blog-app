import VueRouter from 'vue-router'
import Home from './components/Home.vue'
import Blog from './components/Blog.vue'
import Contact from './components/Contact.vue'
import About from './components/About.vue'
import Post from './components/SinglePost.vue'
import Login from './components/auth/Login.vue'
import Register from './components/auth/Register.vue'
const routes =[
   {
       path:'/', component:Home,name:'home'

   },
   {
    path:'/blog', component:Blog,name:'blog'
   },
   {
    path:'/contact', component:Contact,name:'contact'
   },
   {
    path:'/about', component:About,name:'about',
   },
   {
      path:'/posts/:id', component:Post,
   },
   {
    path:'/login', component:Login,name:'login',
   },
   {
    path:'/register', component:Register,name:'register',
   },
];
export const router = new VueRouter({
   routes,
   linkExactActiveClass:'active',
//    mode:'history'
});