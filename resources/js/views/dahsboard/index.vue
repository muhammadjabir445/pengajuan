<template>
    <v-container>
        <v-card
             :style="border"
            tile
            outlined
            >
                <v-card-text class="text-center">
                   <v-row justify="center">
                       <v-col
                       cols="12"
                       md="3"
                       >
                        <v-card
                            tile
                            outlined
                        >

                            <v-card-text>
                                <h4>Total Divisi</h4>
                                <h3>{{total_divisi}}</h3>
                                <v-icon class="icon-dashboard" color="red">fal fa-users</v-icon>
                            </v-card-text>
                        </v-card>
                       </v-col>

                        <v-col
                       cols="12"
                       md="3"
                       >
                        <v-card
                            tile
                            outlined
                        >

                            <v-card-text>
                                <h4>Total Inventori Barang</h4>
                                <h3>{{total_inventori}}</h3>
                                <v-icon class="icon-dashboard" color="primary">fal fa-box</v-icon>
                            </v-card-text>
                        </v-card>
                       </v-col>

                        <v-col
                       cols="12"
                       md="3"
                       >
                        <v-card
                            tile
                            outlined
                        >

                            <v-card-text>
                                <h4>Total Pengajuan</h4>
                                <h3>{{total_pengajuan}}</h3>
                                <v-icon class="icon-dashboard" color="orange">fal fa-archive</v-icon>
                            </v-card-text>
                        </v-card>
                       </v-col>

                        <v-col
                       cols="12"
                       md="3"
                       >
                        <v-card
                            tile
                            outlined
                        >

                            <v-card-text>
                                <h4>Total Pembelian</h4>
                                <h3>{{total_pembelian}}</h3>
                                <v-icon class="icon-dashboard" color="blue">fal fa-archive</v-icon>

                            </v-card-text>
                        </v-card>
                       </v-col>
                   </v-row>

                   <v-row>
                       <v-col cols="12"
                       md="6"
                       >
                        <v-card
                        tile
                        >
                            <!-- <LineChart :height="350" :chartdata="LineData" :options="options" v-if="loading"/> -->
                        </v-card>
                       </v-col>
                        <v-col cols="12"
                       md="12"
                       height="350px"
                       >
                        <v-card
                        tile
                        >
                            <BarChart :height="350" :chartdata="chartData" :options="options" v-if="loading"/>
                        </v-card>
                       </v-col>
                   </v-row>
                </v-card-text>
                <v-card-actions class="">

                </v-card-actions>
            </v-card>
        <!-- <BarChart :height="350" :chartdata="chartData" :options="options" /> -->
    </v-container>

</template>

<script>
import middleware from '../../mixins/middleware'
import store from '../../stores'
import BarChart from '../../components/external/BarChart'
export default {
    data() {
        return {
            total_inventori: '',
            total_pengajuan:'',
            total_divisi:'',
            total_pembelian:'',
            loading:false,
            chartData:
                {
                labels:[],
                    datasets: [
                        {
                        label: 'Pengajuan',
                        backgroundColor: 'rgba(255, 99, 132, 0.2)',
                        data: []
                        },
                    ],
                },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }

        }
    },

    mixins:[middleware],
    components:{
        BarChart
    },

    methods: {
        async go() {
            await this.axios.get(window.location.pathname,this.config)
            .then((ress) => {
                console.log(ress)
                let data = ress.data
                this.total_inventori = data.total_inventori
                this.total_pengajuan = data.total_pengajuan
                this.total_divisi = data.total_divisi
                this.total_pembelian = data.total_pembelian
                data.chart_pengajuan.forEach(x => {

                     this.chartData.labels.push(x.divisi)

                     this.chartData.datasets[0].data.push(x.total_pengajuan)
                });

            })

            this.loading = true

        }
    },
    created() {
        this.go()
    },
}
</script>

<style scoped>
    .icon-dashboard{
        font-size: 50px;
        position: absolute;
        top: 5px;
        right: 10px;
        opacity: 0.1;
    }
</style>
