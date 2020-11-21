<template>
    <v-app>
        <Progress v-if="loading"/>
        <v-container v-if="!loading">
            <BtnJudul text="Data barang di ajukan"/>

            <v-card
             :style="border"
            tile
            >
                <v-card-text class="text-center">
                    <v-container>
                        <v-row justify="center" align="center">
                            <v-col
                                cols="12"
                                md="6"
                                class="d-md-flex"
                            >
                            <v-text-field
                                v-model="keyword"
                                label="Pencarian"
                                v-on:keyup ="go"
                                :color="color"
                                class="mr-2"
                            ></v-text-field>
                            </v-col>

                            <v-col

                                align="right"
                                cols="12"
                                md="6"
                            >
                                <v-btn color="primary"  :to="urlcreate" small tile v-if="parent_pengajuan.status == 0 && user.role.description == parent_pengajuan.divisi">
                                    Tambah Barang
                                </v-btn>
                            </v-col>
                        </v-row>
                    </v-container>

                    <v-simple-table>
                        <template v-slot:default>
                        <thead>
                            <tr>
                            <th class="text-left">No</th>
                            <th class="text-left">Nama Barang</th>
                            <th class="text-left">Tujuan Pengadaan</th>
                            <th class="text-left">Keterangan</th>
                            <th class="text-left">Input By</th>
                            <th class="text-left">Status</th>
                            <th class="text-left">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(item,index) in data" :key="item.id">
                                <td class="text-left">{{++index}}</td>
                                <td class="text-left">{{item.nama_barang}}</td>
                                <td class="text-left">{{item.tujuan_pengadaan}}</td>
                                <td class="text-left">{{item.keterangan}}</td>
                                <td class="text-left">{{item.created_by}}</td>
                                <td class="text-left">
                                 <v-btn
                                 x-small
                                    class="white--text"
                                    :color="statusColor(item.status_pengajuan)"
                                    depressed

                                    >
                                    {{statusText(item.status_pengajuan)}}
                                    </v-btn>
                                </td>
                                <td class="text-left" >

                                    <v-btn color="success" v-on:click="edit(item.id)"  depressed small v-if="item.status_pengajuan == 0 && user.name == item.created_by">
                                    <v-icon>mdi-circle-edit-outline</v-icon>
                                    </v-btn>
                                    <v-btn color="error" depressed small @click="dialogDelete(item.id)" v-if="item.status_pengajuan == 0 && user.name == item.created_by" >
                                        <v-icon>mdi-delete-outline</v-icon>
                                    </v-btn>

                                    <v-btn color="primary" v-on:click="openDetail(item.id)"  depressed small >
                                        <v-icon>mdi-clipboard-outline</v-icon>
                                    </v-btn>

                                    <v-btn color="primary" v-on:click="showConfirm(item.id)" v-if="item.status_pengajuan == 0 && user.id_role == 37"  depressed small >
                                        Confirmasi
                                    </v-btn>

                                    <v-btn color="primary" v-on:click="showConfirm(item.id)" v-if="item.status_pengajuan == 1 && user.id_role == 36"  depressed small >
                                        Confirmasi
                                    </v-btn>

                                    <v-btn color="primary" v-on:click="saranDialog(item.id)" v-if="item.status_pengajuan == 0 && user.id_role == 42"  depressed small >
                                        Rekomendasi
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

            <DialogDetail :dialog="dialogDetail"
            v-on:close="closeDetail"
            :color="statusColor(detailData.status_pengajuan)"
            :text="statusText(detailData.status_pengajuan)"
            :data="detailData"/>


            <DialogConfirm
            :dialog="dialogConfirm"
            v-on:close="closeDetail"
            v-on:go="go"
            :id="id_confirm"/>

            <v-dialog
            v-model="dialog_saran"
            max-width="450"
            >
            <v-card>
                <v-card-title class="headline">Masukkan Saran Rekomendasi</v-card-title>

                <v-card-text>
                    <v-textarea
                        outlined
                        label="Saran Rekomendasi"
                        v-model="saran_coo"
                    ></v-textarea>
                </v-card-text>
                <v-card-actions>
                <v-spacer></v-spacer>

                <v-btn

                    text
                    @click="dialog_saran = false"
                >
                    Cancel
                </v-btn>

                <v-btn
                    color="success"
                    text
                    @click="confirmSaran()"
                >
                    Save
                </v-btn>
                </v-card-actions>
            </v-card>
            </v-dialog>

        </v-container>
    </v-app>

</template>
<script>
 // 0 menunggu sttus hrd
    // 1 di acc hrd atau menunggu keputusan finance
    // 2 di tolak hrd
    // 3 di acc finance
    // 4 di tolak finance
import CrudMixin from '../../mixins/CrudMixin'
import DialogDetail from '../../components/external/DetailPengajuan'
import DialogConfirm from '../../components/external/ChangeStatus'
import { mapGetters } from 'vuex'
export default {
    name: 'pengajuan.index',
    mixins:[CrudMixin],
    components:{DialogDetail,DialogConfirm},
    data() {
        return {
            dialogDetail:false,
            detailData:{},

            dialogConfirm:false,
            id_confirm:0,
            parent_pengajuan:{},
            dialog_saran:false,
            saran_coo:'',
            status:'',

        }
    },
    methods:{
        statusColor(status) {
            if (status == 0) {
                return 'blue'
            } else if(status == 1 || status == 3) {
                return 'success'
            } else if(status == 2 || status == 4) {
                return 'red'
            }
        },
        statusText(status) {
            if (status == 0) {
                return 'Menunggu persetujuan HRD'
            } else if(status == 1) {
                return 'Telah di ACC oleh HRD'
            } else if(status == 2) {
                return 'Ditolak HRD'
            } else if(status == 3 ) {
                 return 'Telah di ACC oleh Finance'
            } else if (status == 4) {
                return 'Ditolak Finance'
            }
        },
        closeDetail(){
            this.dialogDetail = false
             this.dialogConfirm =false
        },
        openDetail(id) {
            this.dialogDetail = true
            this.detailData = this.data.find(x=> x.id === id)
        },
        async go(page = 1){
            let url = 'pengajuan'
            this.page = page == null ? this.page : page
            if(this.page > 1) {
                url = url + '?page=' +this.page + "&keyword=" + this.keyword
            }else{
                url = url + "?keyword=" + this.keyword
            }
            url = url + `&id_parent=${this.$route.params.id_parent}&status`
            await this.axios.get(url,this.config)
            .then( async (ress)=>{
                this.data = ress.data.data
                this.page = ress.data.current_page ? ress.data.current_page : ress.data.meta.current_page
                this.lengthpage = ress.data.last_page ? ress.data.last_page : ress.data.meta.last_page
                await this.get_parent()
            })
            .catch((err)=>{
                console.log(err.response)
            })
            this.loading = false
        },
        deleteData(){
            let url = 'pengajuan' + `/${this.idDelete}`
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
                    status:true,
                    color_snakbar:'red'
                })
            })
        },
        showConfirm(id) {
            this.id_confirm = id
            this.dialogConfirm = true
        },
        async get_parent() {
             await this.axios.get('pengajuan-parent/' + this.$route.params.id_parent,this.config)
                .then((ress) => {
                    this.parent_pengajuan = ress.data.data

                }).catch((err)=>{
                    console.log(err.response)
            })
        },

        saranDialog(id) {
            this.dialog_saran = true
            this.detailData = this.data.find(async x => await x.id === id)
            this.saran_coo = this.detailData.saran_coo
            this.id_confirm = id
        },

        confirmSaran() {
            let data = new FormData()
            data.append('saran_coo',this.saran_coo)
            this.axios.post(`pengajuan/${this.id_confirm}/saran`,data,this.config)
            .then(ress => {
                this.setSnakbar({
                    color_snakbar:'success',
                    pesan:ress.data.message,
                    status:true
                })
            })
            .catch(err=> {
                console.log(err.response)
                this.setSnakbar({
                    color_snakbar:'red',
                    pesan:err.response,
                    status:true
                })
            })
            this.dialog_saran = false
        }

    },
    computed: {
        ...mapGetters({
            user:'auth/user'
        })
    },
}
</script>

