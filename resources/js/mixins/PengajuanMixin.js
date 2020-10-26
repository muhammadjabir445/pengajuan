import {mapActions} from 'vuex'
import middleware from './middleware'
export default {
    data: () => ({
        valid: true,
        lazy:false,
        loading:false,
        barang:'',
        perkiraan_harga:0,
        total:'',

        tujuan_pengadaan:'',
        tempat_pembelian:'',
        keterangan:'',
        nameRules: [
          v => !!v || 'Tidak Boleh Kosong',
        ],
        perkiraanRules: [
            v => !!v || 'Harus diisi',
            v => /^[0-9,]+$/.test(v) || 'Format salah'
        ],
        numberRule: v  => {
            if (!v == 0 ) return true;
            if (!isNaN(parseFloat(v)) && v >= 0 && v <= 999) return true;
            return 'Number has to be between 0 and 999';
          },


      }),
    methods: {
        ...mapActions({
            setSnakbar: 'snakbar/setSnakbar'
        }),
        formatAsCurrency (value, dec) {
            dec = dec || 0
            if (value === null) {
                return null
            }
            return '' + value.toFixed(dec).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,")
        },

    },

    mixins:[middleware],

    computed: {
        harga:{
            get(){
                return this.formatAsCurrency(this.perkiraan_harga, 0)
            },
            set(newValue){
                this.perkiraan_harga= Number(newValue.replace(/[^0-9\.]/g, ''))
            }
        },
    },
    created(){
    }
}
