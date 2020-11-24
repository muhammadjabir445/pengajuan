<template>
<div>
    <v-dialog
    v-model="dialog"
    width="450"
    >
        <v-card>
            <v-card-title class="headline">Konfirmasi Pengajuan</v-card-title>

            <v-card-text class="text-center">
                <v-alert
                dense
                outlined
                type="warning"
                v-if="detail.total_stok > 0"
                >
                    Sudah ada stok barang ini di inventori berjumlah {{detail.total_stok}}
                </v-alert>
                <v-btn
                    depressed
                    color="red"
                    class="white--text"
                    @click="TolakAjuan()"
                >
                    Tolak
                </v-btn>

                <v-btn
                    depressed
                    color="success"
                    @click="TerimaAjuan()"
                >
                        Terima
                </v-btn>
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

    <v-dialog
    v-model="dialog_tolak"
    width="450"
    >
        <v-card>
            <v-card-title class="headline">{{status_pengajuan ?  'Terima Pengajuan' : 'Tolak Pengajuan' }}</v-card-title>

            <v-card-text>
                <div v-if="!status_pengajuan">
                    <v-textarea
                        outlined
                        label="Alasan Penolakan"
                        v-model="alasan_tolak"
                    ></v-textarea>
                </div>
            </v-card-text>
            <v-card-actions>
            <v-spacer></v-spacer>

            <v-btn

                    text
                    @click="dialog_tolak = false"
                >
                    Cancel
                </v-btn>

                <v-btn
                    color="success"
                    text
                    @click="confirmStatus()"
                    :loading="loading_confirm"
                >
                    Confirm
            </v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>
</div>


</template>

<script>
import { mapActions } from 'vuex'
import middleware from '../../mixins/middleware'
export default {
    props:{
        dialog:Boolean,
        id:Number,
        detail:Object
    },
    mixins:[middleware],
    data() {
        return {
            dialog_tolak:false,
            alasan_tolak:'',
            status_pengajuan:false,
            loading_confirm:false
        }
    },
    methods:{
        close() {
            this.$emit('close',this.dialog)
            this.alasan_tolak = ''
        },
        ...mapActions({
            setSnakbar:'snakbar/setSnakbar'
        }),
        go() {
            this.$emit('go')
        },


        TolakAjuan(){
            this.close()
            this.dialog_tolak = true
            this.status_pengajuan = false

        },

         TerimaAjuan(){
            this.close()
            this.dialog_tolak = true
            this.status_pengajuan = true
        },

        async confirmStatus() {
            this.loading_confirm = true
            let data = new FormData
            data.append('alasan_tolak' , this.alasan_tolak)
            data.append('status_pengajuan' , this.status_pengajuan)
            await this.axios.post(`pengajuan/${this.id}/status`,data,this.config)
            .then(async (ress) => {
                await this.go()
                this.setSnakbar({
                    color_snakbar:'success',
                    status:true,
                    pesan:ress.data.message

                })

            })
            .catch((rrr)=> console.log(err.response))
            this.dialog_tolak = false
            this.loading_confirm = false
        }

    }


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
