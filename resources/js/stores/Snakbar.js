export default {
    namespaced:true,
    state : {
        status : false,
        color_snakbar : 'red',
        pesan : ''
    },
    mutations : {
        setSnakbar : (state , payload) => {
            state.status = payload.status,
            state.color_snakbar = payload.color_snakbar,
            state.pesan = payload.pesan
        },

    },

    actions : {

        setSnakbar : ({commit},payload) =>{
            commit('setSnakbar',payload)
        },
    },

    getters : {
        status : state => state.status,
        color_snakbar : state => state.color_snakbar,
        pesan : state => state.pesan,
    }
}
