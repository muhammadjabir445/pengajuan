<template>
         <v-btn small :color="color" class="white--text" tile>{{text}}</v-btn>
</template>

<script>
import {mapGetters} from 'vuex'
export default {
    props:['text'],
    computed:{
        ...mapGetters({
            color:'color/color'
        })
    }
}
</script>
