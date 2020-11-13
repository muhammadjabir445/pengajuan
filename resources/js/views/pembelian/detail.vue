<template>
    <v-app>
        <Progress v-if="loading"/>
        <v-container v-if="!loading">
            <BtnJudul text="Pembelian Barang"/>

            <v-card
             :style="border"
            tile
            >
                <v-card-text class="text-center">
                    <v-container>
                        <v-row justify="center" align="center">
                            <v-col
                                cols="12"
                            >
                            <v-text-field
                                v-model="keyword"
                                label="Pencarian"
                                v-on:keyup = "go"
                                :color="color"
                            ></v-text-field>
                            </v-col>

                            <!-- <v-col
                                cols="6"
                                align="right"
                            >
                                <v-btn color="primary"  :to="urlcreate" small tile>
                                    Tambah Data
                                </v-btn>
                            </v-col> -->
                        </v-row>
                    </v-container>

                    <v-simple-table>
                        <template v-slot:default>
                        <thead>
                            <tr>
                            <th class="text-left">No</th>
                            <th class="text-left">Nama Barang</th>
                            <th class="text-left">Total</th>
                            <th class="text-left">Harga</th>
                            <th class="text-left">Total Harga</th>
                            <th class="text-left">Foto Bukti</th>
                            <th class="text-left">Tempat Pembelian</th>
                            <th class="text-left">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(item,index) in data" :key="item.id">
                                <td class="text-left">{{++index}}</td>
                                <td class="text-left">{{item.barang}}</td>
                                <td class="text-left">{{item.total}} / {{item.satuan_barang}}</td>

                                <td class="text-left">Rp. {{ item.harga ? formatPrice(item.harga) : 'Belum diinput'}}</td>
                                <td class="text-left">Rp. {{ item.harga ? formatPrice(item.harga * item.total) : 'Belum diinput'}}</td>
                                <td class="text-left">
                                    <v-img width="60px" height="80px" :src="item.foto" v-if="item.foto" @click="openImage(item.foto)"/>
                                    {{!item.foto ? 'Tidak ada foto' : ''}}
                                </td>
                                <td class="text-left">{{item.tempat_beli}}</td>

                                <td class="text-left" >
                                    <v-btn color="primary" v-on:click="openDetail(item.id)"  depressed small >
                                        <v-icon>mdi-clipboard-outline</v-icon>
                                    </v-btn>
                                <v-btn color="primary" :to="`detail/${item.id}/edit`" depressed small dark >
                                    Input
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
        </v-container>

        <DetailPembelian :dialog="dialog_detail" :data="detail" v-on:close="closeDetail"/>
    </v-app>

</template>
<script>
import GlobalMethod from '../../mixins/GlobalMethods'
import CrudMixin from '../../mixins/CrudMixin'
import DetailPembelian from '../../components/external/DetailPembelian'

export default {
    name: 'users',
    mixins:[CrudMixin,GlobalMethod],
    data() {
        return {
            detail:{},
            dialog_detail:false
        }
    },
    components:{
        DetailPembelian
    },
    methods:{
        openImage(url){
            window.open(url)
        },
        openDetail(id) {
            this.detail = this.data.find(x=> x.id === id)
            this.dialog_detail = true
        },
        closeDetail(){
            this.dialog_detail = false
        }
    },

}
</script>

