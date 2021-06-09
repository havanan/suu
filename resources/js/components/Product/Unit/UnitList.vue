<template>
  <v-table :data="displayData"
           :currentPage.sync="currentPage"
           class="table table-striped table-bordered">
    <thead slot="head">
      <v-th sortKey="name" defaultSort="desc" >Tên đơn vị</v-th>
      <v-th sortKey="created_at" defaultSort="desc" >Ngày tạo</v-th>
      <th></th>
    </thead>
    <tbody slot="body" slot-scope="{displayData}">
    <tr v-for="row in displayData" :key="row.id">
      <td>{{ row.name }}</td>
      <td>{{ row.created_at }}</td>
      <td>
        <button class="btn btn-outline-danger mr-2">
          <i class="bx bx-trash me-0"></i>
        </button>
        <button class="btn btn-outline-primary">
          <i class="lni lni-pencil"></i>
        </button>
      </td>
    </tr>
    </tbody>
  </v-table>
<!--  <smart-pagination-->
<!--          :currentPage.sync="currentPage"-->
<!--          :totalPages="totalPages"-->
<!--  />-->
</template>

<script>
export default {
  name: "UnitList",
  mounted() {
    this.getData()
  },
  data(){
    return {
      apiUrl:'/manager/sam-pham/don-vi/get-list',
      displayData:[],
      currentPage: 1,
      totalPages: 0
    }
  },
  methods: {
    nameLength (row) {
      return `row.name.length`
    },
   async getData(){
      const result = await axios.get(this.apiUrl);
      if (result && result.data){
        const dat = result.data;
       this.displayData = dat.data
        this.currentPage = dat.current_page
        this.totalPages = dat.total
      }
    }
  }
}
</script>
