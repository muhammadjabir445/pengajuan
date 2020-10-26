export default {
    namespaced:true,
    state : {
        Color : null,

    },
    mutations : {
        Color : (state , payload) => {
            state.Color = payload
        },

    },

    actions : {

        setColor : ({commit},payload) =>{
            commit('Color',payload)
        },
    },

    getters : {
        color : state => state.Color,
    }
}
