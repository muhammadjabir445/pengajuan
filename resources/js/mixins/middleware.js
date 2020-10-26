
import {mapActions, mapGetters} from 'vuex'
import ThemesMixins from './Themes'
export default {
    data(){
        return {
            config:null
        }
    },

    mixins:[ThemesMixins],

    computed: {
        ...mapGetters({
            token:'auth/token',

        }),

    },

    created(){
        this.config = {
            headers: {
                'Authorization': 'Bearer ' + this.token,
            }
        }
    },
    components:{

    }
}
