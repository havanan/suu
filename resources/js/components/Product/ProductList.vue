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
            :bordered="false"
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
      <template #cell(id)="data">
        <p>{{data.value}}</p>
      </template>
      <template #cell(name)="data">
        <strong>{{data.value}}</strong>
      </template>
      <template #cell(image)="data">
        <div class="text-center">
          <img v-if="data" :src="getImg(data.value)" class="product-img-2">
        </div>
      </template>
      <template #cell(price_import)="data">
        <p class="text-primary">{{vndFormat(data.value)}}</p>
      </template>
      <template #cell(price)="data">
        <div v-html="getPrice(data.item)"></div>
      </template>
      <template #cell(total)="data">
        <p class="badge text-white shadow-sm w-100" :class="data.value <=2 ? 'bg-gradient-bloody' : 'bg-gradient-quepal'">{{data.value}}</p>
      </template>

      <template #cell(action)="data">
        <button class="btn btn-outline-primary" @click="editProduct(data.item)">
          <i class="bx bx-pencil me-0"></i>
        </button>
        <button class="btn btn-outline-success" @click="toggleDetails(data.item)">
          <i class="bx bx-info-square me-0"></i>
        </button>
        <button class="btn btn-outline-danger" @click="deleteProduct(data.item)">
          <i class="bx bx-trash me-0"></i>
        </button>
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
    <b-modal
            v-model="isShowModal"
            title="Chi tiết sản phẩm"
            hide-footer
            size="xl">
      <div class="row">
        <div class="container-fluid">
          <table class="table table-bordered">
            <thead>
            <tr>
              <th>Id</th>
              <th></th>
              <th>Size</th>
              <th>Màu</th>
              <th>Giá vốn</th>
              <th>Giá bán</th>
              <th>Tồn kho</th>
              <th>Trạng thái</th>
              <th></th>
            </tr>
            </thead>
            <tbody v-if="detail.childs">
              <tr v-for="child in detail.childs">
                <td>{{child.id}}</td>
                <td>
                  <img :src="getImg(child.image)" width="100px" />
                </td>
                <td>
                  <p>{{child.size}}</p>
                </td>
                <td>
                  <p>{{child.color}}</p>
                </td>
                <td>
                  <p class="text-primary">{{vndFormat(child.price_import)}}</p>
                </td>
                <td>
                  <div v-html="getPrice(child)"></div>
                </td>
                <td>
                  <p class="badge text-white shadow-sm w-100" :class="child.total <=2 ? 'bg-gradient-bloody' : 'bg-gradient-quepal'">{{child.total}}</p>
                </td>
                <td>
                  <p>{{child.status}}</p>
                </td>
                <td>
                  <button class="btn btn-outline-primary" @click="editProduct(child)">
                    <i class="bx bx-pencil me-0"></i>
                  </button>
                  <button class="btn btn-outline-danger" @click="deleteProduct(child)">
                    <i class="bx bx-trash me-0"></i>
                  </button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </b-modal>
  </div>
</template>

<script>
export default {
  name: "ProductList",

  data() {
    return {
      apiUrl: '/manager/san-pham/get-list',
      isBusy: false,
      currentPage: 1,
      totalRows: 0,
      perPage: 0,
      form: {
        keyword: '',
      },
      fields: [
        {
          key: 'id',
          label: 'Id',
          sortable: true,
          thStyle: {width: '80px'},
          thClass: 'text-center',
          tdClass: 'text-center'
        },
        {
          key: 'image',
          label: '',
          tdClass: 'text-center'

        },
        {
          key: 'name',
          label: 'Tên sản phẩm',
          sortable: true,
        },
        {
          key: 'price_import',
          label: 'Giá vốn',
          sortable: true,
        },
        {
          key: 'price',
          label: 'Giá bán',
          sortable: true,
        },
        {
          key: 'category_name',
          label: 'Loại'
        },
        {
          key: 'total',
          label: 'Tồn kho',
        },
        {
          key: 'action',
          label: 'Tác vụ',
        },
      ],
      items: [],
      detail: {
        info:{},
        childs:[]
      },
      isShowModal: false
    }
  },
  mounted() {
    this.getList();
  },
  watch: {
    currentPage: {
      handler: function (newVal, oldVal) {
        if (newVal !== oldVal) {
          this.getList()
        }
      }
    }
  },
  methods: {
    getImg(data) {
      let img = '';
      if (data) {
        data = JSON.parse(data)
        if (data[0]) {
          img = data[0]
        }
      }
      return '/cdn/products/small/' + img
    },
    getList(page = false) {
      const vm = this
      const formParams = vm.form;
      formParams.page = page ? page : vm.currentPage;
      const params = {
        params: formParams,
      }
      vm.isBusy = !vm.isBusy
      axios.get(vm.apiUrl, params).then(function (res) {
        vm.isBusy = !vm.isBusy
        if (res.data) {
          vm.binData(res.data)
        }
      });
    },
    binData(results){
      const vm = this
      if (results.items) {
        vm.items = results.items
      }
      if (results.currentPage) {
        vm.currentPage = results.currentPage
      }
      if (results.total) {
        vm.totalRows = results.total
      }
      if (results.perPage) {
        vm.perPage = results.perPage
      }
    },
    vndFormat(money) {
      let vnd = 0;
      if (money) {
        money = parseInt(money)
        vnd = money.toLocaleString('it-IT', {style: 'currency', currency: 'VND'});
      }
      return vnd
    },
    getPrice(data) {
      let price = '';
      if (data.price_discount) {
        price = '<p class="text-success">' + this.vndFormat(data.price_discount) + '</p><del class="text-danger">' + this.vndFormat(data.price) + '</del>'
      } else {
        price = '<p class="text-success">' + this.vndFormat(data.price) + '</p>'
      }
      return price
    },
    toggleDetails(data) {
      const vm = this
      vm.isShowModal = true
      axios.get('/manager/san-pham/info/' + data.id).then(function (res) {
        if (res.data) {
          console.log(res.data)
          vm.detail = res.data
        }
      })
    },
    deleteProduct(info){
      const vm = this;
      if (info.id){
        axios.get('/manager/san-pham/xoa/' + info.id).then(function (res) {
          if (res.data) {
            vm.binData(res.data)
          }
        })
      }
    },
    editProduct(info){
      if (info.id){
        window.location.href = '/manager/san-pham/sua/'+info.id
      }
    }
  }
}
</script>
