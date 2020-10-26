<template>
    <v-app>
        <v-container>
            <BtnJudul text="Edit Pengajuan Barang"/>
            <v-card
             :style="border"
            tile
            >
                <!-- <v-card-text class="text-center"> -->
                <v-card-text>
                    <v-container>
                        <v-form
                        ref="form"
                        v-model="valid"
                        :lazy-validation="lazy"
                        >

                        <v-text-field
                        outlined
                        v-model="barang"
                        :rules="nameRules"
                        label="Nama barang"
                        required
                        disabled
                        >
                        </v-text-field>


                        <v-text-field
                        outlined
                        v-model="harga"
                        :rules="perkiraanRules"
                        label="Perkiraan Harga"
                        required
                        ></v-text-field>

                        <v-text-field
                        outlined
                        v-model="total"
                        :rules="[numberRule]"
                        label="Total"
                        required
                        ></v-text-field>

                        <v-textarea
                        outlined
                        :rules="nameRules"
                        label="Tujuan Pengadaan"
                        v-model="tujuan_pengadaan"
                        ></v-textarea>


                        <v-textarea
                        outlined
                        :rules="nameRules"
                        label="Keterangan"
                        v-model="keterangan"
                        ></v-textarea>

                        <v-text-field
                        outlined
                        v-model="tempat_pembelian"
                        label="tempat_pembelian"
                        required
                        ></v-text-field>

                        <v-row>
                            <v-col
                            cols="12"
                            align="right"
                            >
                              <v-btn
                                :disabled="!valid"
                                color="success"
                                tile
                                @click="save()"
                                :loading="loading"
                                >
                                Simpan
                                </v-btn>
                            </v-col>
                        </v-row>

                    </v-form>
                    </v-container>

                </v-card-text>

                <v-card-actions class="">

                </v-card-actions>
            </v-card>
        </v-container>
    </v-app>

</template>
<script>
// import {mapActions} from 'vuex'
import PengajuanMixin from '../../mixins/PengajuanMixin'
export default {
    name: 'barang.edit',

    mixins:[PengajuanMixin],
    methods:{
        async save(){
            this.loading = true
           let url = 'pengajuan/' + this.$route.params.id
            let data = new FormData()
            data.append('total',this.total)
            data.append('tujuan_pengadaan',this.tujuan_pengadaan)
            data.append('keterangan',this.keterangan)
            data.append('tempat_pembelian',this.tempat_pembelian)
            data.append('perkiraan_harga',this.perkiraan_harga)
            data.append('_method','PUT')

            await this.axios.post(url,data,this.config)
            .then((ress) => {
                this.setSnakbar({
                    status:true,
                    pesan:ress.data.message,
                    color_snakbar:'success'
                })
                this.$router.go(-1)
            })
            .catch((err)=>{
                if (err.response.status == 400 ) {
                    this.setSnakbar({
                    color_snakbar:'red',
                    status:true,
                    pesan:err.response.data.message,
                    })
                }else{
                    this.setSnakbar({
                    status:true,
                    color_snakbar:'red',
                    pesan:"Terjadi Kesalahan",
                    })
                }

                console.log(err.response)
            })
            this.loading = false

        },

        go(){
         let url = 'pengajuan/' + this.$route.params.id + '/edit'
         this.axios.get(url,this.config)
         .then((ress) => {
             let pengajuan = ress.data.pengajuan
             this.barang = pengajuan.nama_barang
             this.perkiraan_harga = pengajuan.perkiraan_harga
             this.keterangan = pengajuan.keterangan
             this.tempat_pembelian = pengajuan.tempat_pembelian
             this.total = pengajuan.total
             this.tujuan_pengadaan = pengajuan.tujuan_pengadaan
             this.date_pengajuan = pengajuan.tanggal_pengajuan
         })
         .catch((err) => console.log(err.response))
        }

    },

    created(){
        this.go()
    }

}
</script>

<style lang="css" scoped>
</style>
