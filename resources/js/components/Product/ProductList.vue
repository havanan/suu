<template>
  <div>
    <div class="row">
      <div class="col-md-9"></div>
      <div class="col-md-3">
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Tìm kiếm..." @change="getList(0)" v-model="form.keyword">
        </div>
      </div>
    </div>
    <b-table
            :fixed="true"
             :items="items"
             :fields="fields"
             :bordered="true"
             :busy="isBusy"
             :current-page="currentPage"
             :per-page="0"
    >
      <template #table-busy>
        <div class="text-center text-danger my-2">
          <b-spinner class="align-middle"></b-spinner>
          <strong>Loading...</strong>
        </div>
      </template>
      <template #cell(image)="data">
        <img v-if="data" :src="data.value" width="100px">
      </template>
      <template #cell(action)="data">
        <button class="btn btn-primary"><i class="lni lni-pencil-alt"></i></button>
      </template>

    </b-table>
    <div class="row">
      <b-col sm="12" md="12">
        <b-pagination
                v-model="currentPage"
                :total-rows="totalRows"
                :per-page="perPage"
                align="right"
        ></b-pagination>
      </b-col>
    </div>
  </div>
</template>

<script>
export default {
  name: "ProductList",

  data(){
    return {
      apiUrl:'/manager/san-pham/get-list',
      isBusy: false,
      currentPage:1,
      totalRows:0,
      perPage:0,
      form:{
        keyword:'',
      },
      fields:[
        {
          key:'id',
          label:'Id',
          sortable: true,
        },
        {
          key:'image',
          label:'',
        },
        {
          key:'name',
          label:'Tên sản phẩm',
          sortable: true,
        },

        {
          key:'price',
          label:'Giá vốn',
          sortable: true,
        },
        {
          key:'id',
          label:'Loại'
        },
        {
          key:'id',
          label:'Đơn vị'
        },
        {
          key:'id',
          label:'Tồn kho'
        },
        {
          key:'action',
          label:'Tác vụ'
        },
      ],
      items: []
    }
  },
  mounted() {
    this.getList();
  },
  watch:{
    currentPage: {
      handler: function (newVal, oldVal) {
        if (newVal !== oldVal) {
          this.getList()
        }
      }
    }
  },
  methods:{
    getList(page = false){
      const vm = this
      const formParams = vm.form;
      formParams.page = page ? page : vm.currentPage;
      const params = {
        params:formParams,
      }
      vm.isBusy = !vm.isBusy
      axios.get(vm.apiUrl,params).then(function (res){
        vm.isBusy = !vm.isBusy
        if(res.data) {
          const results = res.data;
          if(results.items){
            vm.items = results.items
          }
          if (results.currentPage){
            vm.currentPage = results.currentPage
          }
          if (results.total){
            vm.totalRows = results.total
          }
          if (results.perPage){
            vm.perPage = results.perPage
          }
        }
      });
    }
  }
}
</script>
