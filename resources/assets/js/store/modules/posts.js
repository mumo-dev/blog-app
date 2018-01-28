const state = {
    posts:[]
};

const getters ={
    posts(state){
        return state.posts;
    }
};

const mutations = {
    'INIT_POSTS'(state,posts){
        state.posts = posts;
    }
};

const actions ={
    initPosts:({commit},posts)=>{
       commit('INIT_POSTS',posts);
    }
}
export default { state, getters, mutations, actions };