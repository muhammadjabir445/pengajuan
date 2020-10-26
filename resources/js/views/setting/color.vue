<template>
    <v-app>
        <v-container>
            <v-row>
                <v-col
                cols="12"
                align="center"
                >
                <v-color-picker
                    v-model="color"
                    @input="inputColor()"
                    class="ma-2"
                    show-swatches
                ></v-color-picker>
                </v-col>

                <!-- <v-col
                cols="12"
                md="6"
                >
                <v-text-field
                v-model="color"
                >

                </v-text-field>

                 <v-btn
                :disabled="!valid"
                color="success"
                tile
                @click="save()"
                :loading="loading"
                >
                Simpan
                </v-btn>
                </v-col> -->
            </v-row>
        </v-container>
    </v-app>

</template>
<script>

import middleware from '../../mixins/middleware'
import {mapActions,mapGetters} from 'vuex'
export default {
    name: 'users',
     data: () => ({
         color:"",
      swatches: [
        ['#FF0000', '#AA0000', '#550000'],
        ['#FFFF00', '#AAAA00', '#555500'],
        ['#00FF00', '#00AA00', '#005500'],
        ['#00FFFF', '#00AAAA', '#005555'],
        ['#0000FF', '#0000AA', '#000055'],
      ],
        snackbar: false,
      text: 'My timeout is set to 2000.',
      timeout: 2000,
    }),

    methods:{
        ...mapActions({
            setColor:'color/setColor'
        }),
        inputColor() {

            this.setColor(this.color)
            let varcolor = this.color
            let data = varcolor.replace('#','%23')
            this.axios.get(`/setting-color?color=${data}`)
            .then(ress=> {

            })
            .catch(err=> {
                console.log(err.response)
            })
        }
    },
    computed:{
        ...mapGetters({
            color_get:'color/color'
        })
    },
    created() {
        this.color = this.color_get
    }
}
</script>

