<template>
  <div>
    <div class="row">
      <div class="col-md-9">
        <button class="btn btn-primary" type="button" @click="createProduct()">+ Tạo mới</button>
      </div>
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
      <template #cell(parent)="data">
        <strong>{{getParent(data.value)}}</strong>
      </template>
      <template #cell(status)="data">
       <span class="badge text-white shadow-sm w-50"
             :class="data.value === 0 ? 'bg-gradient-bloody' : 'bg-gradient-quepal'">
            {{getStatus(data.value)}}
          </span>
      </template>
      <template #cell(action)="data">
        <button class="btn btn-outline-primary mb-2" @click="editProduct(data.item)">
          <i class="bx bx-pencil me-0"></i>
        </button>
<!--        <button class="btn btn-outline-success mb-2" @click="toggleDetails(data.item)">-->
<!--          <i class="bx bx-info-square me-0"></i>-->
<!--        </button>-->
        <button class="btn btn-outline-danger mb-2" @click="deleteProduct(data.item)">
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
            size="md">
      <div class="row">
        <div class="container-fluid">
            <div class="form-group">
              <label>Tên <i class="text-danger">*</i></label>
              <input type="text" class="form-control" v-model="formData.name" @change="getProductSlug()">
              <span class="text-danger" v-if="errors.name">{{errors.name}}</span>
            </div>
          <div class="form-group">
            <label>Seo Url</label>
            <input type="text" class="form-control" v-model="formData.slug">
          </div>
          <div class="form-group">
            <label>Chuyên mục cha</label>
            <select class="form-control" v-model="formData.parent_id">
              <option value="">Chuyên mục cha</option>
              <template v-for="parent in parents">
                <option :value="parent.id">{{parent.name}}</option>
              </template>
            </select>
          </div>
          <div class="form-group">
            <label>Trạng thái</label>
            <select class="form-control" v-model="formData.status">
              <option value="0">Khóa</option>
              <option value="1">Hoạt động</option>
            </select>
          </div>
          <div class="text-right">
            <button type="button" class="btn btn-success" @click="actionForm()">Lưu</button>
          </div>
        </div>
      </div>
    </b-modal>
  </div>
</template>

<script>
export default {
  name: "CategoryList",

  data() {
    return {
      apiUrl: '/manager/loai-san-pham/get-list',
      isBusy: false,
      currentPage: 1,
      totalRows: 0,
      perPage: 0,
      form: {
        keyword: '',
      },
      formData:{
        name:'',
        slug:'',
        parent_id:'',
        status:1,
        id:''
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
          key: 'name',
          label: 'Tên Loại sản phẩm',
          sortable: true,
        },
        {
          key: 'parent',
          label: 'Chuyên mục cha',
          sortable: true,
          thClass: 'text-center',
          tdClass: 'text-center'
        },
        {
          key: 'status',
          label: 'Trạng thái',
          sortable: true,
        },
        {
          key: 'action',
          label: 'Tác vụ',
        },
      ],
      items: [],
      detail: {
        info:{},
      },
      isShowModal: false,
      parents:[],
      errors:{
        name:''
      },
      action:'create'
    }
  },
  mounted() {
    this.getList();
    this.getParentList();
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
    deleteProduct(info){
      const vm = this;
      if (info.id){
        axios.get('/manager/loai-san-pham/xoa/' + info.id).then(function (res) {
          if (res.data) {
            vm.binData(res.data)
          }
        })
      }
    },
    getParentList(){
      const vm = this;
      axios.get('/manager/loai-san-pham/get-parents').then(function (res) {
        if (res.data) {
          vm.parents = res.data
        }
      })
    },
    editProduct(info){
      const vm = this
      if (info){
        vm.isShowModal = true;
        vm.action = 'edit';
        vm.formData = info
      }
    },
    createProduct(){
      const vm = this;
      vm.formData = {name:'', slug:'', parent_id:'', status:1,id:''};
      vm.action = 'create';
      vm.isShowModal = true;
    },
    getParent(data){
      let name = '-';
      if(data.name) {
        name = data.name
      }
      return data.name
    },
    getStatus(data){
      let res = 'Khóa'
      if(data && data === '1'){
        res = 'Hoạt động'
      }
      return res;
    },
    getProductSlug(){
      const vm = this
      vm.formData.slug = vm.makeSlug(vm.formData.name)
    },
    makeSlug(name){
      let slug = ''
      //Đổi chữ hoa thành chữ thường
      slug = name.toLowerCase();

      //Đổi ký tự có dấu thành không dấu
      slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
      slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
      slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
      slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
      slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
      slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
      slug = slug.replace(/đ/gi, 'd');
      //Xóa các ký tự đặt biệt
      slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');
      //Đổi khoảng trắng thành ký tự gạch ngang
      slug = slug.replace(/ /gi, "-");
      //Đổi nhiều ký tự gạch ngang liên tiếp thành 1 ký tự gạch ngang
      //Phòng trường hợp người nhập vào quá nhiều ký tự trắng
      slug = slug.replace(/\-\-\-\-\-/gi, '-');
      slug = slug.replace(/\-\-\-\-/gi, '-');
      slug = slug.replace(/\-\-\-/gi, '-');
      slug = slug.replace(/\-\-/gi, '-');
      //Xóa các ký tự gạch ngang ở đầu và cuối
      slug = '@' + slug + '@';
      slug = slug.replace(/\@\-|\-\@|\@/gi, '');
      return slug
    },
    actionForm(){
      const vm = this;
      let url = '/manager/loai-san-pham/tao-moi';
      if (vm.action === 'edit'){
         url = '/manager/loai-san-pham/cap-nhat';
      }
      const formData = vm.formData
      axios.post(url,formData).then(function (res) {
        if (res.data){
          vm.isShowModal = false;
          vm.getList();
        }
      }).catch(function (error) {
        if(error.response && error.response.data && error.response.data.errors) {
          vm.errors = error.response.data.errors
        }
      });
    }
  }
}
</script>
