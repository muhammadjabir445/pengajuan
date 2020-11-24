<template>
    <v-app>
        <v-container>
            <BtnJudul text="Input pembelian Barang"/>
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
                        <v-row>
                            <v-col cols="12" md="6">
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
                                <input type="file" style="" id="foto_profile" ref="foto_profile" accept="image/*" @change="eventChangePembelian" required>
                            </v-col>
                            <v-col cols="12" md="6" v-if="inventori == ''">

                                <div style="position:relative;width:100%" >
                                <v-text-field
                                outlined
                                v-model="user"
                                :rules="nameRules"
                                label="Penanggung Jawab"
                                required
                                @keyup="getUser"
                                style="position:relative"

                                >
                                </v-text-field>
                                <div class="list-barang" v-if="users.length > 0">
                                    <ul>
                                        <li v-for="item in users" :key="item.id" @click="select_user(item.name)">{{item.name}}</li>
                                    </ul>
                                </div>
                                </div>

                                <v-text-field
                                outlined
                                v-model="detail"
                                :rules="nameRules"
                                label="Detail barang"
                                required
                                >
                                </v-text-field>


                                <v-select
                                    v-model="id_lantai"
                                    :items="lantais"
                                    :rules="[v => !!v || 'Item is required']"
                                    label="Lantai"
                                    item-text="lantai"
                                    item-value="id"
                                    required
                                    @change="lantaiChange(id_lantai)"
                                ></v-select>

                                <v-select
                                    v-model="id_ruangan"
                                    :items="ruangan_filter"
                                    :rules="[v => !!v || 'Item is required']"
                                    label="Ruangan"
                                    item-text="ruangan"
                                    item-value="id"
                                    required
                                ></v-select>

                                <v-text-field
                                outlined
                                v-model="foto"
                                :rules="nameRules"
                                label="Detail barang"
                                required
                                style="display:none"
                                >
                                </v-text-field>
                                <input type="file" @change="eventChange">
                                <span>Foto Barang</span>
                                <v-img :src="imgurl" v-if="imgurl" width="100%" height="300px"/>
                            </v-col>
                        </v-row>


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
import InventoriMixin from '../../mixins/Inventori'
export default {
    name: 'barang.edit',
    data() {
        return {
            inventori:''
        }
    },
    mixins:[PembelianMixin, InventoriMixin],
    methods:{
        async save(){
            this.loading = true
           let url = 'pembelian/' + this.$route.params.id_detail +'/edit'
            let data = new FormData()
            data.append('harga',this.harga)
            data.append('tempat_beli',this.tempat_beli)
            data.append('foto',this.foto)
            data.append('user',this.user)
            data.append('id_lantai',this.id_lantai)
            data.append('id_ruangan',this.id_ruangan)
            data.append('detail',this.detail)
            data.append('foto_inventori',this.foto_inventori)
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
             this.inventori = pembelian.inventori
             this.harga = pembelian.harga ? pembelian.harga : 0
             this.tempat_beli = pembelian.tempat_beli ? pembelian.tempat_beli : ''

         })
         .catch((err) => console.log(err.response))
        }

    },

    created(){
        this.go()
        this.getLantaiRuangan()
    }

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
