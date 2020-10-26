import {mapActions} from 'vuex'
import middleware from './middleware'
export default {
    data: () => ({
        valid: true,
        lazy:false,
        loading:false,
        satuan:'',
        items:[],
        nama: '',
        nameRules: [
          v => !!v || 'Tidak Boleh Kosong',
        ],
      }),
    methods: {
        ...mapActions({
            setSnakbar: 'snakbar/setSnakbar'
        }),

        getSatuan(){
            this.axios.get(window.location.pathname,this.config)
            .then((ress) => {
                this.items = ress.data.satuan
            })
            .catch((err) => console.log(err))
        }

    },

    mixins:[middleware],

    created(){
        this.getSatuan()
    }
}
