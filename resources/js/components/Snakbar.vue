<template>
  <div class="text-center">
    <v-snackbar
      v-model="statusSnakbar"
      :timeout="2000"
      top
      :color="color_snakbar"
    >
      {{ pesan }}

      <template v-slot:action="{ attrs }">
        <v-btn
           class="text-white"
            text
            @click="close()"
            v-bind="attrs"
        >
          Close
        </v-btn>
      </template>
    </v-snackbar>

  </div>
</template>
<script>
import {mapGetters,mapActions} from 'vuex'
export default {
    name : 'snakbar',
    computed :{
        ...mapGetters({
            status : 'snakbar/status',
            color_snakbar : 'snakbar/color_snakbar',
            pesan : 'snakbar/pesan',
        }),
        statusSnakbar: {
            get(){
                return this.status
            },
            set(value){
                this.setSnakbar({
                    color_snakbar:'red',
                    status:false,
                    pesan:null
                })
            }
        }



    },
    methods: {
        ...mapActions({
            setSnakbar: 'snakbar/setSnakbar'
        }),
        close(){
				this.setSnakbar({
					status:false
				})
			}
    }
}
</script>
