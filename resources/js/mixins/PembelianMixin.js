import {mapActions} from 'vuex'
import middleware from './middleware'
export default {
    data: () => ({
        valid: true,
        lazy:false,
        loading:false,
        harga:'',
        tempat_beli:'',
        barang:'',
        foto:'',
        nameRules: [
          v => !!v || 'Tidak Boleh Kosong',
        ],
        perkiraanRules: [
            v => !!v || 'Harus diisi',
            v => /^[0-9,]+$/.test(v) || 'Format salah',
            v => v.split(',').join('') <= 100000000 || 'Tidak boleh lebih dari 100 juta'

        ],
      }),
    methods: {
        ...mapActions({
            setSnakbar: 'snakbar/setSnakbar'
        }),
        eventChange(event){
            const files = event.target.files
            this.foto = files[0]
        },
        formatAsCurrency (value, dec) {
            dec = dec || 0
            if (value === null) {
                return null
            }
            return '' + value.toFixed(dec).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,")
        },

    },
    computed: {
        harga_convert:{
            get(){
                return this.formatAsCurrency(this.harga, 0)
            },
            set(newValue){
                this.harga= Number(newValue.replace(/[^0-9\.]/g, ''))
            }
        },
    },

    mixins:[middleware],

    created(){
    }
}
