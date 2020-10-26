import {mapActions} from 'vuex'
import middleware from './middleware'
export default {
    data: () => ({
        valid: true,
        lazy:false,
        loading:false,
        tanggal_pengajuan:false,
        date_tanggal_pengajuan:new Date().toISOString().substr(0, 10),
        nameRules: [
          v => !!v || 'Tidak Boleh Kosong',
        ],
      }),
    methods: {
        ...mapActions({
            setSnakbar: 'snakbar/setSnakbar'
        }),

    },

    mixins:[middleware],

    created(){

    }
}
