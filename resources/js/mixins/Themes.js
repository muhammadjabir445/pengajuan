
import {mapActions, mapGetters} from 'vuex'
import BtnJudul from '../components/external/Btn.vue'
import PaginateComponent from '../components/external/Paginate.vue'
export default {
    data() {
        return {
            border:''
        }
    },
    mounted() {

    },

    computed: {
        ...mapGetters({
            color:'color/color'
        }),
        borderStyle() {
            return `border-top: 2px solid ${this.color} !important;`
        }
    },

    created() {
        this.border = this.borderStyle
    },

    components:{
        BtnJudul,
        PaginateComponent
    }
}
