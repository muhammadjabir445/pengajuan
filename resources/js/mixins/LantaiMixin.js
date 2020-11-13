import {mapActions} from 'vuex'
import middleware from './middleware'
export default {
    data: () => ({
        valid: true,
        lazy:false,
        loading:false,
        lantai:'',
        ruangans:[{
            ruangan:''
        }],
        nameRules: [
          v => !!v || 'Tidak Boleh Kosong',
        ],
      }),
    methods: {
        ...mapActions({
            setSnakbar: 'snakbar/setSnakbar'
        }),
        tambah_ruang(){
            this.ruangans.push({
                ruangan:''
            })
        },
        hapus_ruang(index) {
            this.ruangans.splice(index,1)
        }
    },

    mixins:[middleware],

    created(){
    }
}
