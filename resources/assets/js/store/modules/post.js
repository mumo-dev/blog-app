const state = {
    post:[]
};

const getters ={
    post(state){
        return state.post;
    },
    comments(state){
        if(state.post.comments !== undefined){
          return state.post.comments.reverse();
        }
    }
};

const mutations = {
    'INIT_POST'(state,post){
        state.post = post;
    },
    'ADD_COMMENT'(state,comment){
        state.post.comments.push(comment);
    }
};

const actions ={
    initPost:({commit},post)=>{
       commit('INIT_POST',post);
    },
    addComment:({commit},comment)=>{
        commit('ADD_COMMENT',comment);
    }
}
export default { state, getters, mutations, actions };