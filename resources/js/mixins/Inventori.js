import {mapActions} from 'vuex'
import middleware from './middleware'
export default {
    data: () => ({
        valid: true,
        lazy:false,
        loading:false,
        barang:'',
        user:'',
        id_lantai:'',
        id_ruangan:'',
        detail:'',
        lantais:[],
        ruangans:[],
        barangs:[],
        ruangan_filter:[],
        users:[],
        foto_inventori:'',
        imgurl:'',
        nameRules: [
          v => !!v || 'Tidak Boleh Kosong',
        ],
        status:'',
        status_pilihan:[
            {
                value:0,
                text:'Baik'
            },
            {
                value:1,
                text:'Rusak'
            }
        ]
      }),
    methods: {
        ...mapActions({
            setSnakbar: 'snakbar/setSnakbar'
        }),

        getLantaiRuangan(){
            this.axios.get('/inventori/create',this.config)
            .then((ress) => {
                this.lantais = ress.data.lantai
                this.ruangans = ress.data.ruangan
            })
            .catch((err) => console.log(err))
        },

        lantaiChange(id) {
            this.ruangan_filter = this.ruangans.filter(x => x.id_lantai === id)
        },

        async getUser(){
            await this.axios.get('users?keyword=' + this.user,this.config)
            .then((ress)=> {
                this.users = ress.data.data
            })
            .catch(Err => {
                console.log(Err.response)
            })
        },
        async get_barang(){
            this.axios.get('pengajuan/create?keyword='+ this.barang,this.config)
            .then((ress) => {
                if (ress.data.barang.length > 0) {
                     this.barangs = ress.data.barang
                } else {
                    this.barangs = []
                }

            })
            .catch((err) => {
                console.log(err.response)
            })
        },

        select_barang(nama_barang) {
            this.barang = nama_barang
            this.barangs = []
        },

        select_user(nama_user) {
            this.user = nama_user
            this.users = []
        },

        eventChange(event){
            const files = event.target.files
             this.foto_inventori = files[0]
              const fileReader = new FileReader()
             fileReader.addEventListener('load',()=>{
                 this.imgurl=fileReader.result
             })
              fileReader.readAsDataURL(this.foto_inventori)
        }

    },

    mixins:[middleware],

    created(){
    }
}
