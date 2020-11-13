<template>
    <v-app>
        <v-container>
            <BtnJudul text="Tambah Data Lantai"/>

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
                        v-model="lantai"
                        :rules="nameRules"
                        label="Lantai"
                        required
                        ></v-text-field>
                        <v-btn tile @click="tambah_ruang()" depressed small color="success" class="text-white">
                            <v-icon dark>mdi-plus</v-icon> Tambah Ruangan
                        </v-btn>
                        <div class="ruangan" style="position:relative" v-for="(item,index) in ruangans" :key="index">
                            <v-text-field
                            v-model="item.ruangan"
                            :rules="nameRules"
                            label="Ruangan"
                            required
                            ></v-text-field>
                             <v-btn style="position:absolute;top:0px;right:0px;index:1000"
                             fab
                             @click="hapus_ruang(index)"
                             dark x-small depressed color="red"
                             v-if="ruangans.length > 1">
                                <v-icon dark>mdi-close</v-icon>
                            </v-btn>
                        </div>
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
import LantaiMixin from '../../mixins/LantaiMixin'
export default {
    name: 'lantai.edit',

    mixins:[LantaiMixin],
    methods:{
        async save(){
            this.loading = true
            let url = window.location.pathname
            url = url.split('/')
            url = `${url[1]}/${url[2]}`
            let data = new FormData()
            data.append('lantai',this.lantai)
            data.append('ruangan',JSON.stringify(this.ruangans))
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
                let lantai = ress.data.lantai
                this.lantai = lantai.lantai
                this.ruangans = lantai.ruangan
            })
            .catch((err) => console.log(err.response))
        }

    },
    created() {
        this.go()
    }

}
</script>

<style lang="css" scoped>
</style>
