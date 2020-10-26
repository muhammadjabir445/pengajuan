<template>
    <div class="text-center">
        <v-pagination
        v-model="page"
        :length="lengthpage"
        :total-visible="7"
        @input="go"
        :color="color"
        ></v-pagination>
    </div>
</template>


<script>
import {mapGetters} from 'vuex'
export default {
    props:{
        page:Number,
        lengthpage:Number
    },
    computed:{
        ...mapGetters({
            color:'color/color'
        })
    },
    methods:{
        go() {
            this.$emit('go',this.page)
        }
    }
}

</script>

<style>

</style>
