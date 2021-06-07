<template>
  <table-component :fields="fields" :api-url="apiUrl"></table-component>
</template>

<script>
export default {
  name: "ProductList",
  data(){
    return {
      apiUrl:'/manager/sam-pham/get-list',
      fields:[
        {
          name:'id',
          title:'Id'
        },
        {
          name:'name',
          title:'Tên sản phẩm'
        },
        {
          name:'id',
          title:'Giá bán'
        },
        {
          name:'price',
          title:'Giá vốn'
        },
        {
          name:'id',
          title:'Loại'
        },
        {
          name:'id',
          title:'Đơn vị'
        },
        {
          name:'id',
          title:'Tồn kho'
        },
      ]
    }
  }
}
</script>
