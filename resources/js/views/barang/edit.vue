<template>
    <v-app>
        <v-container>
            <BtnJudul text="Edit Barang"/>
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
                        <label for="" align="left">Edit Barang</label>

                        <v-text-field
                        v-model="nama"
                        :rules="nameRules"
                        label="Nama barang"
                        required
                        ></v-text-field>

                        <v-select
                            v-model="satuan"
                            :items="items"
                            :rules="[v => !!v || 'Item is required']"
                            label="Satuan Barang"
                            item-text="description"
                            item-value="id"
                            required
                        ></v-select>
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
import BarangMixin from '../../mixins/BarangMixin'
export default {
    name: 'barang.edit',

    mixins:[BarangMixin],
    methods:{
        async save(){
            this.loading = true
            let url = window.location.pathname
            url = url.split('/')
            url = `${url[1]}/${url[2]}`
            let data = new FormData()
            data.append('nama',this.nama)
            data.append('satuan',this.satuan)
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
         let url = window.location.pathname
         this.axios.get(url,this.config)
         .then((ress) => {
             let barang = ress.data.barang
             this.nama = barang.nama
             this.satuan = barang.satuan
             this.items = ress.data.satuan
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
