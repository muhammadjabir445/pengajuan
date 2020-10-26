<template>
    <v-app>
        <v-container>
            <BtnJudul text="Tambah Pengajuan Barang"/>

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

                        <div style="position:relative;width:100%">
                        <v-text-field
                        outlined
                        v-model="barang"
                        :rules="nameRules"
                        label="Nama barang"
                        required
                        @keyup="get_barang"
                        style="position:relative"
                        >
                        </v-text-field>
                        <div class="list-barang" v-if="data_barang.length > 0">
                            <ul>
                                <li v-for="item in data_barang" :key="item.id" @click="select_barang(item.nama)">{{item.nama}}</li>
                            </ul>
                        </div>
                        </div>


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
    name: 'masterdata.edit',
   data: () => ({
        data_barang:[]
      }),
    mixins:[PengajuanMixin],
    methods:{
        async save(){
            this.loading = true
            let url = window.location.pathname
            url = url.split('/')
            url = "/" + url[1]
            let data = new FormData()
            data.append('barang',this.barang)
            data.append('total',this.total)
            data.append('tujuan_pengadaan',this.tujuan_pengadaan)
            data.append('keterangan',this.keterangan)
            data.append('tempat_pembelian',this.tempat_pembelian)
            data.append('perkiraan_harga',this.perkiraan_harga)
            data.append('id_parent',this.$route.params.id_parent)

            await this.axios.post(url,data,this.config)
            .then((ress) => {
                console.log(ress)
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

        async get_barang(){
            this.axios.get('pengajuan/create?keyword='+ this.barang,this.config)
            .then((ress) => {
                if (ress.data.barang.length > 0) {
                     this.data_barang = ress.data.barang
                } else {
                    this.data_barang = []
                }

            })
            .catch((err) => {
                console.log(err.response)
            })
        },

        select_barang(nama_barang) {
            this.barang = nama_barang
            this.data_barang = []
        },
    },


}
</script>

<style lang="css" scoped>
    .sembunyi {
        display: none;
    }
    .tampil {
        display: block;
    }

    .list-barang{
        background-color:white;
        position:relative;
        left:0px;
        bottom:30px;
        width:100%;
        -webkit-box-shadow: 4px 6px 5px -4px rgba(0,0,0,0.75);
        -moz-box-shadow: 4px 6px 5px -4px rgba(0,0,0,0.75);
        box-shadow: 4px 6px 5px -4px rgba(0,0,0,0.75);
        z-index: 100;
    }
    .list-barang ul li {

        padding-top: 15px;
        padding-bottom: 15px;
        padding-left: 10px;
    }
    .list-barang ul {
        list-style: none;
        padding: 0px;
    }
    .list-barang ul li:hover {
        cursor:pointer;
         background-color:rgb(233, 233, 233);
    }
</style>
