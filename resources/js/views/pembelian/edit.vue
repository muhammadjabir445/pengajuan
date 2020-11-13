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
                        v-model="harga_convert"
                        :rules="perkiraanRules"
                        label="Harga Satuan"
                        required
                        ></v-text-field>

                        <v-text-field
                        outlined
                        v-model="tempat_beli"
                        :rules="nameRules"
                        label="Tempat Beli"
                        required
                        ></v-text-field>

                        <label for="">Foto Struk</label>
                        <input type="file" style="" id="foto_profile" ref="foto_profile" accept="image/*" @change="eventChange" required>

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
import PembelianMixin from '../../mixins/PembelianMixin'
export default {
    name: 'barang.edit',

    mixins:[PembelianMixin],
    methods:{
        async save(){
            this.loading = true
           let url = 'pembelian/' + this.$route.params.id_detail +'/edit'
            let data = new FormData()
            data.append('harga',this.harga)
            data.append('tempat_beli',this.tempat_beli)
            data.append('foto',this.foto)
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
         let url = 'pembelian/' + this.$route.params.id_detail + '/edit'
         this.axios.get(url,this.config)
         .then((ress) => {
             let pembelian = ress.data.data
             this.barang = pembelian.barang
             this.harga = pembelian.harga ? pembelian.harga : 0
             this.tempat_beli = pembelian.tempat_beli ? pembelian.tempat_beli : ''

         })
         .catch((err) => console.log(err.response))
        }

    },

    created(){
        this.go()
    }

}
</script>
