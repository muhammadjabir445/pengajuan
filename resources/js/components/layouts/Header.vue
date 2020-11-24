<template>
	<nav>
		<v-app-bar app :color="color" class="white--text" v-if="user" >
		    <v-app-bar-nav-icon color="white"
		    @click="sideBar()"></v-app-bar-nav-icon>
		    <v-toolbar-title>Inventori Redhunter</v-toolbar-title>
		    <v-spacer></v-spacer>
            <div class="text-center">
            <v-menu
            offset-y
            >
            <template v-slot:activator="{ on, attrs }">
                 <v-btn
                    class="white--text"
                    depressed
                    style="background:none !important;padding:0px !important"
                    v-bind="attrs"
                    v-on="on"
                    >
                    <v-badge
                        color="red"
                        :content="get_total_notifikasi"
                        small
                        v-if="get_total_notifikasi > 0"
                    >
                        <v-icon >fal fa-bell</v-icon>
                    </v-badge>

                    <v-icon v-else>fal fa-bell</v-icon>
                </v-btn>
            </template>
            <v-list
            class="pb-0 pt-0"
            >
                <v-list-item
                v-for="item in notifikasi"
                :key="item.id"

                :color="item.status == 0 ? color : ''"
                @click="go_to(item.url,item.id)"
                >
                    <v-list-item-subtitle v-html="item.deskripsi" :style="item.status == 0 ? style_list : ''">
                    </v-list-item-subtitle>
                </v-list-item>
            </v-list>
            </v-menu>
        </div>
		    <v-btn class="white--text" text @click="logOut" >Logout</v-btn>
		</v-app-bar>
	</nav>

</template>
<script>
import { mapActions, mapGetters } from 'vuex'
import middleware from '../../mixins/middleware'
export default {
    name:'navbar',
    methods:{
        ...mapActions({
            setSidebar : 'setSidebar',
            setAuth : 'auth/setAuth',
            setNotifikasi : 'auth/setNotifikasi'
        }),
        sideBar(){
            this.setSidebar(!this.sidebar)
        },
        async logOut(){
            await this.axios.post('/logout',{},this.config)
            .then((ress) => {
                this.setAuth({
                    user:null,
                    token:null,
                    menu:null
                })

                localStorage.removeItem('token')

                this.$router.push('/login')
            })
            .catch((err) =>console.log(err.response))
        },

        async go_to(url,id){
            let change_notifikasi = this.notifikasi.find( x => x.id == id)
            let index_notifikasi = this.notifikasi.findIndex( x => x.id == id)
            change_notifikasi.status = 1
            // let new_notifikasi = this.notifikasi
            // new_notifikasi = await new_notifikasi.splice(index_notifikasi,1,change_notifikasi)
            this.notifikasi.splice(index_notifikasi,1,change_notifikasi)
            this.axios.get('/change-status/notifikasi/' + id)

            // this.setNotifikasi(new_notifikasi)
            this.$router.push(url)
        }

    },

    mixins:[middleware],
    computed: {
        ...mapGetters({
            sidebar: 'sideBar',
            user : 'auth/user',
            color: 'color/color',
            notifikasi: 'auth/notifikasi'
        }),
        get_total_notifikasi : {
            get: function () {
            let total = this.notifikasi.filter(x => x.status == 0)
            return total.length
            },
            // setter
            set: function (newValue) {

            }
        },
         style_list: function () {
            return 'color:' + this.color +' !important';
            }
    },
}
</script>
