<template>
   <v-dialog
    v-model="dialog"
    width="750"
    @click:outside="close"
    @keydown="close"
    >
        <v-card>
            <v-card-title class="" primary-title>Detail Pembelian</v-card-title>

            <v-card-text>
                <table class="table-lead" v-if="data != {}">
                    <tbody>
                        <tr>
                            <td>Nama Barang</td>
                            <td>{{data.barang}}</td>
                        </tr>
                        <tr>
                            <td>Total</td>
                            <td>{{data.total}} / {{data.satuan_barang}}</td>
                        </tr>
                        <tr>
                            <td>Estimasi harga</td>
                            <td>Rp. {{formatPrice(data.perkiraan_harga)}}</td>
                        </tr>

                        <tr>
                            <td>Jumlah Estimasi</td>
                            <td>Rp. {{formatPrice(data.perkiraan_harga * data.total)}}</td>
                        </tr>

                        <tr>
                            <td>Harga</td>
                            <td>Rp. {{ data.harga ? formatPrice(data.harga) : 'Belum diinput'}}</td>
                        </tr>

                        <tr>
                            <td>Jumlah harga</td>
                            <td>Rp. {{ data.harga ? formatPrice(data.harga * data.total) : 'Belum diinput'}}</td>
                        </tr>

                        <tr>
                            <td>Selisi</td>
                            <td>Rp. {{ data.harga ? formatPrice(data.perkiraan_harga - data.harga) : 'harga belum diinput'}}</td>
                        </tr>

                        <tr>
                            <td>Jumlah Selisi</td>
                            <td>Rp. {{ data.harga ? formatPrice((data.perkiraan_harga * data.total) - (data.harga * data.total)) : 'harga belum diinput'}}</td>
                        </tr>


                        <tr>
                            <td>Tempat Pembelian</td>
                            <td> {{data.tempat_beli}}</td>
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
    },
    methods:{
        close() {
            this.$emit('close')

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
