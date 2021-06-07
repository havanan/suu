<template>
  <vuetable ref="vuetable"
            :api-url="apiUrl"
            :fields="fields"
            :per-page="perPage"
            data-path=""
            pagination-path=""
  ></vuetable>
</template>

<script>
import Vuetable from 'vuetable-2'

export default {
  name: "TableComponent",
  components: {
    Vuetable
  },
  props:{
    apiUrl:{
      type:String,
      default:''
    },
    fields: {
      type:Array,
      default:[]
    },
    perPage:{
      type:Number,
      default: 10
    }
  }
}
</script>

<style scoped>

</style>