<template>
   <v-dialog
    v-model="dialog"
    width="750"
    @click:outside="close"
    @keydown="close"
    >
        <v-card>
            <v-card-title class="" primary-title>Detail Pengajuan</v-card-title>

            <v-card-text>
                <table class="table-lead" v-if="data != {}">
                    <tbody>
                        <tr>
                            <td>Nama Barang</td>
                            <td>{{data.nama_barang}}</td>
                        </tr>
                        <tr>
                            <td>Estimasi harga</td>
                            <td>Rp. {{formatPrice(data.perkiraan_harga)}}</td>
                        </tr>
                        <tr>
                            <td>Total</td>
                            <td>{{data.total}} / {{data.satuan_barang}}</td>
                        </tr>

                        <tr>
                            <td>Jumlah Harga</td>
                            <td>Rp. {{formatPrice(data.perkiraan_harga * data.total)}}</td>
                        </tr>
                        <tr>
                            <td>Nama Pengaju</td>
                            <td>{{data.created_by}}</td>
                        </tr>
                        <tr>
                            <td>Tujuan Pengadaan</td>
                            <td> {{data.tujuan_pengadaan}}</td>
                        </tr>
                        <tr>
                            <td>Keterangan</td>
                            <td> {{data.keterangan}}</td>
                        </tr>

                        <tr>
                            <td>Tempat Pembelian</td>
                            <td> {{data.tempat_pembelian}}</td>
                        </tr>

                        <tr>
                            <td>Status</td>
                            <td>

                            <v-btn
                                x-small
                                class="white--text"
                                :color="color"
                                depressed

                                >
                                {{text}}
                                </v-btn>
                            </td>
                        </tr>

                        <tr v-if="data.alasan_tolak">
                            <td>Alasan Penolakan</td>
                            <td>{{data.alasan_tolak}}</td>
                        </tr>

                        <tr v-if="data.saran_coo">
                            <td>Saran COO</td>
                            <td>{{data.saran_coo}}</td>
                        </tr>
                    </tbody>
                </table>
            </v-card-text>
            <v-card-actions>
            <v-spacer></v-spacer>

            <v-btn

                text
                @click="close"
            >
                Close
            </v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>
</template>

<script>
import GlobalMethod from '../../mixins/GlobalMethods'
export default {
    props:{
        dialog:Boolean,
        data:Object,
        color:String,
        text:String
    },
    methods:{
        close() {
            this.$emit('close',this.dialog)

        },
    },
    mixins:[GlobalMethod]


}
</script>

<style lang="css" scoped>
.table-lead {
    border-collapse: collapse;
    width: 100%;
    margin-top: 20px;
}
    .table-lead td {
        padding: 10px 5px 10px 5px;
    }
</style>
