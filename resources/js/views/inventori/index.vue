<template>
    <v-app>
        <Progress v-if="loading"/>
        <v-container v-if="!loading">
            <BtnJudul text="Data Inventori"/>

            <v-card
             :style="border"
            tile
            >
                <v-card-text class="text-center">
                    <v-container>
                        <v-row justify="center" align="center">
                            <v-col
                                cols="6"
                            >
                            <v-text-field
                                v-model="keyword"
                                label="Pencarian"
                                v-on:keyup = "go"
                                :color="color"
                            ></v-text-field>
                            </v-col>

                            <v-col
                                cols="6"
                                align="right"
                            >
                                <v-btn color="primary"  :to="urlcreate" small tile>
                                    Tambah Data Inventori
                                </v-btn>
                            </v-col>
                        </v-row>
                    </v-container>

                    <v-simple-table>
                        <template v-slot:default>
                        <thead>
                            <tr>
                            <th class="text-left">No</th>
                            <th class="text-left">Nama</th>
                            <th class="text-left">Total</th>
                            <th class="text-left">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(item,index) in data" :key="item.id">
                                <td class="text-left">{{++index}}</td>
                                <td class="text-left">{{item.nama}}</td>
                                <td class="text-left">{{item.inventori_count}} {{item.satuan}}</td>
                                <td class="text-left">
                                <v-btn color="success" v-on:click="openDetail(item.id)" x-small dark >
                                    Lihat Detail
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

        <InventoriDetail :dialog_show="dialog_show" :id_inventori="id_inventori" v-on:close="close" />
    </v-app>

</template>
<script>
import InventoriDetail from '../../components/external/InventoriDetail'
import CrudMixin from '../../mixins/CrudMixin'
export default {
    name: 'users',
    data() {
        return {
            dialog_show:false,
            id_inventori:0
        }
    },
    mixins:[CrudMixin],
    components:{
        InventoriDetail
    },
    methods:{
        openDetail(id) {
        this.dialog_show = true,
        this.id_inventori = id
        },
        close(){
            this.dialog_show = false
            this.id_inventori = 0
        }
    }
}
</script>

