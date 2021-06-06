const state = {
    user:null,
    token:null,
    authenticated: false,
};
const getters = {
    StateUser: state => state.user,
    authenticated: state => state.authenticated
};
const actions = {
    async loginUser({dispatch },formData){
        await axios.get('/sanctum/csrf-cookie')
        await axios.post('/api/v1/manager/login',formData);
        return dispatch('me')
    },
    async signOut ({ dispatch }) {
        await axios.post('/logout')

        return dispatch('me')
    },
    me ({ commit }) {
        return axios.get('/api/v1/manager/current-user').then((response) => {
            commit('setAuthenticated', true)
            commit('setUser', response.data)
        }).catch(() => {
            commit('setAuthenticated', false)
            commit('setUser', null)
        })
    }
};
const mutations = {
    setUser(state, user){
        state.user = user
    },
    setToken(state, token){
        state.token = token
    },
    setAuthenticated(state, value){
        state.authenticated = value
    },
    LogOut(state){
        state.user = null
        state.token = null
    },
};

export default {
    namespaced:true,
    state,
    getters,
    actions,
    mutations
}