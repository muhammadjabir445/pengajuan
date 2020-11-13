<template>
    <v-dialog
        v-model="dialog_show"
        width="850px"
        @click:outside="close"
        @keydown.esc="close"
    >
    <v-app>
            <v-container>
                <v-card
                :style="border"
                tile
                flat
                >
                    <v-card-title class="" primary-title>Detail Inventori</v-card-title>
                    <v-card-text class="text-center">
                        <v-container>
                            <v-row justify="center" align="center">
                                <v-col
                                    cols="12"
                                >
                                <v-text-field
                                    v-model="keyword"
                                    label="Pencarian"
                                    v-on:keyup="go_detail(page)"
                                    :color="color"
                                ></v-text-field>
                                </v-col>
                            </v-row>
                        </v-container>

                        <v-simple-table>
                            <template v-slot:default>
                            <thead>
                                <tr>
                                <th class="text-left">No</th>
                                <th class="text-left">Barang</th>
                                <th class="text-left">Detail</th>
                                <th class="text-left">Lantai</th>
                                <th class="text-left">Ruangan</th>
                                <th class="text-left">Penanggung Jawab</th>
                                <th class="text-left">Foto</th>
                                <th class="text-left">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(item,index) in data" :key="item.id">
                                    <td class="text-left">{{++index}}</td>
                                    <td class="text-left">{{item.barang}}</td>
                                    <td class="text-left">{{item.detail}}</td>
                                    <td class="text-left">{{item.lantai}}</td>
                                    <td class="text-left">{{item.ruangan}}</td>
                                    <td class="text-left">{{item.user}}</td>
                                    <td class="text-left">
                                        <v-img :src="item.foto" width="60px" height="80px"/>
                                    </td>
                                    <td>
                                        <v-btn color="success" v-on:click="edit(item.id)" fab x-small dark v-if="user.name == item.user || user.id_role == 37 || user.id_role == 23">
                                            <v-icon>mdi-circle-edit-outline</v-icon>
                                        </v-btn>
                                        <v-btn color="error" fab x-small @click="dialogDelete(item.id)" v-if="user.name == item.user || user.id_role == 37 || user.id_role == 23">
                                            <v-icon>mdi-delete-outline</v-icon>
                                        </v-btn>
                                    </td>
                                </tr>
                            </tbody>
                            </template>
                        </v-simple-table>
                    </v-card-text>
                    <PaginateComponent :page="page" :lengthpage="lengthpage" v-on:go="go_detail"/>
                    <v-card-actions class="text-right">
                         <v-btn style=""
                            @click="close"
                            class="text-right"
                        >
                            Close
                        </v-btn>
                    </v-card-actions>
                </v-card>

                <v-dialog
                v-model="dialog"
                max-width="340"
                >
                <v-card>
                    <v-card-title class="headline">Apa anda yakin menghapus ?</v-card-title>

                    <v-card-actions>
                    <v-spacer></v-spacer>

                    <v-btn

                        text
                        @click="dialog = false"
                    >
                        Cancel
                    </v-btn>

                    <v-btn
                        color="red"
                        text
                        @click="deleteData()"
                    >
                        Delete
                    </v-btn>
                    </v-card-actions>
                </v-card>
                </v-dialog>
            </v-container>
    </v-app>
    </v-dialog>

</template>
<script>

import Progress from '../Progress'
import {mapActions, mapGetters} from 'vuex'
import middleware from '../../mixins/middleware'
export default {
    data(){
        return {
            data : [],
            page: 1,
            lengthpage: null,
            loading:true,
            keyword:'',
            urlcreate: '',
            url: '',
            dialog:false,
            idDelete: null
        }
    },

    props:{
        id_inventori:Number,
        dialog_show:Boolean
    },

    components:{
        'Progress' : Progress
    },

    mixins:[middleware],
    methods : {
        ...mapActions({
            setSnakbar:'snakbar/setSnakbar'
        }),

        // method ambil data
        async go_detail(page = 1){
            let url = 'inventori/' + this.id_inventori
            this.page = page
            if(this.page > 1) {
                url = url + '?page=' +this.page + "&keyword=" + this.keyword
            }else{
                url = url + "?keyword=" + this.keyword
            }
            if (this.id_inventori !== 0 && this.dialog_show && this.id_inventori) {
                 await this.axios.get(url,this.config)
                .then((ress)=>{
                    this.data = ress.data.data
                    this.page = ress.data.current_page ? ress.data.current_page : ress.data.meta.current_page
                    this.lengthpage = ress.data.last_page ? ress.data.last_page : ress.data.meta.last_page
                })
                .catch((err)=>{
                    console.log(err.response)
                })
                this.loading = false
            } else {
                this.data = []
            }

        },

        // method edit
        edit(id){
            let url = this.url + `/${id}/edit`
            console.log(url)
            this.$router.push(url)
        },

        // method delete
        deleteData(){
            let url = this.url + `/${this.idDelete}`
            this.axios.delete(url,this.config)
            .then((ress) => {
                this.setSnakbar({
                    color_snakbar:'success',
                    pesan:ress.data.message,
                    status:true
                })
                let index = this.data.map(x => {
                    return x.id
                }).indexOf(this.idDelete)

                this.data.splice(index,1)
                this.dialog = false
            })
            .catch((err)=>{
                console.log(err.response)
                this.setSnakbar({
                    pesan:err.response.data.message,
                    status:true
                })
            })
        },

        dialogDelete(id){
            this.idDelete = id
            this.dialog = true
        },

        close(){
            this.$emit('close')
        }
    },

    computed:{
        ...mapGetters({
            user:'auth/user'
        })
    },

    mounted() {

    },

    created(){
        this.url = window.location.pathname
        this.urlcreate = this.url + '/create'
    },
    beforeUpdate(){
        this.go_detail()
    }
}

</script>

