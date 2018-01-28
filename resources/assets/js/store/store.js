
import Vuex from 'vuex'
import Vue from 'vue'
import posts from './modules/posts'
import post from './modules/post'

Vue.use(Vuex);

export default new Vuex.Store({
  modules:{
      posts,
      post
  },
  state:{
    displayInfo:true
  },
  getters:{
    displayLogin(state){
      return state.displayInfo;
    }
  },
  mutations:{
    setLoginInfo(state, payload){
      state.displayInfo = payload;
    }
  },
  actions:{
   setLoginInfo:({commit},payload)=>{
     commit('setLoginInfo',payload);
   }
  }
});