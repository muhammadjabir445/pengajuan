<template>
    <v-app>
        <Progress v-if="loading"/>
        <v-container v-if="!loading">
            <BtnJudul text="Data Pengajuan"/>

            <v-card
             :style="border"
            tile
            >
                <v-card-text class="text-center">
                    <v-container>
                        <v-row justify="center" align="center">
                            <v-col
                                cols="3"
                            >
                            <v-text-field
                                v-model="keyword"
                                label="Pencarian"
                                v-on:keyup = "go"
                                :color="color"
                                d-inline-block
                            ></v-text-field>

                            </v-col>
                            <v-col
                                cols="3"
                            >
                            <v-select
                            v-model="status"
                            :items="pilihan_status"
                            label="Status"
                            item-text="text"
                            item-value="value"
                            required
                                d-inline-block

                            @change="go(page)"
                            ></v-select>

                            </v-col>



                            <v-col
                                cols="6"
                                align="right"
                            >
                                <v-btn color="primary"  :to="urlcreate" small tile v-if="user.id_role !== 36">
                                    Input Pengajuan
                                </v-btn>
                            </v-col>
                        </v-row>
                    </v-container>

                    <v-simple-table>
                        <template v-slot:default>
                        <thead>
                            <tr>
                            <th class="text-left">No</th>
                            <th class="text-left">Nomor Surat</th>
                            <th class="text-left">Divisi</th>
                            <th class="text-left">Tanggal Pengajuan</th>
                            <th class="text-left">Status</th>
                            <th class="text-left">Aksi</th>
                            <th class="text-left">Konfirmasi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(item,index) in data" :key="item.id">
                                <td class="text-left">{{++index}}</td>
                                <td class="text-left">{{item.nomor_surat}}</td>
                                <td class="text-left">{{item.divisi}}</td>
                                <td class="text-left">{{item.tanggal_pengajuan}}</td>
                                <td class="text-left"> <v-btn
                                 x-small
                                    class="white--text"
                                    :color="statusColor(item.status)"
                                    depressed

                                    >
                                    {{statusText(item.status)}}
                                    </v-btn></td>
                                <td class="text-left">
                                <v-btn color="blue" :to="`/pengajuan/${item.id}`" depressed small dark >
                                    <v-icon>fal fa-bars</v-icon>
                                </v-btn>
                                <v-btn color="error" v-if="user.role.description == item.divisi && item.status == 0" depressed small @click="dialogDelete(item.id)" >
                                    <v-icon>mdi-delete-outline</v-icon>
                                </v-btn>


                                </td>
                                <td >
                                <v-btn color="primary" depressed small @click="changeStatus(item.id,1)" v-if="item.status == 0 && user.role.description == item.divisi" >
                                    Teruskan Ke HRD
                                </v-btn>
                                <v-btn color="primary" depressed small @click="changeStatus(item.id,2)" v-if="item.status == 1 && user.id_role == 37" >
                                    Teruskan Ke Finance
                                </v-btn>
                                <v-btn color="primary" depressed small @click="changeStatus(item.id,3)" v-if="item.status == 2 && user.id_role == 36" >
                                    Konfirmasi pengajuan
                                </v-btn>
                                <v-btn color="error" v-if="(user.id_role == 23 || user.id_role == 37) && item.status == 3" depressed small @click="report(item.id,'pdf',item.nomor_surat)" >
                                    PDF
                                </v-btn>
                                <v-btn color="success" v-if="(user.id_role == 23 || user.id_role == 37) && item.status == 3" depressed small @click="report(item.id,'excel',item.nomor_surat)" >
                                    Excel
                                </v-btn>
                                </td>
                            </tr>
                        </tbody>
                        </template>
                    </v-simple-table>
                </v-card-text>
                <PaginateComponent :page="page" :lengthpage="lengthpage" v-on:go="go"/>
                <v-card-actions class="">

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

            <v-dialog
            v-model="dialog_change"
            max-width="340"
            >
            <v-card>
                <v-card-title class="headline">Apa anda yakin mengubah status ?</v-card-title>

                <v-card-actions>
                <v-spacer></v-spacer>

                <v-btn

                    text
                    @click="dialog_change = false"
                >
                    Cancel
                </v-btn>

                <v-btn
                    color="success"
                    text
                    @click="confirmStatus()"
                    :loading="loading_confirm"
                >
                    Confirm
                </v-btn>
                </v-card-actions>
            </v-card>
            </v-dialog>
        </v-container>
    </v-app>

</template>
<script>
import { mapGetters } from 'vuex'
//  0 input pengajuan
    //  1 telah kirim ke hrd
    //  2 telah kirim ke finance
    // 3 telah konfirmasi finance
import CrudMixin from '../../mixins/CrudMixin'
import download from 'downloadjs'
export default {
    name: 'users',
    data() {
        return {
            id_change: '',
            status_change:'',
            dialog_change:false,
            loading_confirm:false,
            status:'',
             pilihan_status:[
                {
                    value : '',
                    text:'All'
                },
                 {
                    value : 0,
                    text:'Dalam Pengimputan'
                },
                {
                    value :1,
                    text:'Diteruskan ke hrd'
                },
                {
                    value :2,
                    text:'Diteruskan ke finance'
                },
                 {
                    value :3,
                    text:'Dikonfirmasi finance'
                },
            ]
        }
    },
    mixins:[CrudMixin],
    methods:{
        statusColor(status) {
              if (status == 0) {
                return 'primary'
            } else if(status == 1) {
                return 'blue'
            } else if(status == 2) {
                return 'orange'
            } else if(status == 3 ) {
                 return 'success'
            }
        },
        statusText(status) {
            if (status == 0) {
                return 'Dalam penginputan'
            } else if(status == 1) {
                return 'di teruskan ke HRD'
            } else if(status == 2) {
                return 'di teruskan ke Finance'
            } else if(status == 3 ) {
                 return 'Telah di konfirmasi Finance'
            }
        },
        async go(page = 1){
            let url = this.url
            this.page = page
            if(this.page > 1) {
                url = url + '?page=' +this.page + "&keyword=" + this.keyword
            }else{
                url = url + "?keyword=" + this.keyword
            }
            url = url +"&status=" + this.status
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
        },

        changeStatus(id,status) {
            this.id_change = id,
            this.status_change = status,
            this.dialog_change = true
        },
        async confirmStatus(){
            this.loading_confirm = true
            let data = new FormData()
            data.append('status',this.status_change)
            data.append('_method','PUT')
            await this.axios.post(`pengajuan-parent/${this.id_change}`,data,this.config)
            .then( async (ress) => {
                this.setSnakbar({
                    color_snakbar:'success',
                    pesan:ress.data.message,
                    status:true
                })

                await this.go()
            })
            .catch(err => {
                 this.setSnakbar({
                    color_snakbar:'red',
                    pesan:err.response.data.message,
                    status:true
                })

            })
            this.id_change = ''
            this.dialog_change = false
            this.status_change = ''
            this.loading_confirm = true
        },
        report(id,type,name){
            const file_type = type == 'pdf' ? type : 'xlsx'
            this.axios.get(`report-pengajuan/${id}/${type}`,{
                responseType: 'blob'
            })
            .then(ress => {
                const content = ress.headers['content-type'];
                download(ress.data, name + `.${file_type}`, content)
            })
            .catch(err => console.log(err.response))
        }
    },
    computed:{
        ...mapGetters({
            user:'auth/user'
        })
    }
}
</script>

