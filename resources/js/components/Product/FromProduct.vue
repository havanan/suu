<template>
  <div class="row">
    <div class="col-lg-5">
      <div class="border border-3 p-4 rounded">
        <div class="mb-3">
          <label for="inputProductTitle" class="form-label">Tên sản phẩm</label>
          <input type="email" class="form-control" id="inputProductTitle" placeholder="Nhập tên sản phẩm">
        </div>
        <div class="mb-3">
          <div class="row">
            <div class="col-md-6">
              <label for="inputPrice" class="form-label">Giá nhập</label>
              <input type="number" class="form-control" id="inputPrice" v-model="formData.price_import">
            </div>
            <div class="col-md-6">
              <label for="inputCompareatprice" class="form-label">Giá bán</label>
              <input type="number" class="form-control" id="inputCompareatprice" v-model="formData.price">
            </div>
          </div>
        </div>
        <div class="mb-3">
          <div class="row">
            <div class="col-md-6">
              <label for="inputCostPerPrice" class="form-label">Giá khuyến mại</label>
              <input type="number" class="form-control" id="inputCostPerPrice" v-model="formData.price_disount">
            </div>
            <div class="col-md-6">
              <label for="inputStarPoints" class="form-label">Tổng số lượng</label>
              <input type="number" class="form-control" id="inputStarPoints" v-model="formData.total" readonly>
            </div>
          </div>
        </div>
        <div class="mb-3">
          <label for="inputProductDescription" class="form-label">Mô tả sản phẩm</label>
          <textarea class="form-control" id="inputProductDescription" rows="3" v-model="formData.description"></textarea>
        </div>
      </div>
    </div>
    <div class="col-lg-7">
      <div class="border border-3 p-4 rounded">
        <div class="row g-3">
          <div class="col-md-6 col-sm-12">
            <div class="mb-3">
              <label for="inputProductDescription" class="form-label">Ảnh sản phẩm</label>
              <vue-dropzone ref="myVueDropzone"
                            id="dropzone"
                            :options="dropzoneOptions"
                            @vdropzone-complete="afterComplete"
              ></vue-dropzone>
            </div>
          </div>
          <div class="col-md-6 col-sm-12">
            <label  class="form-label">Trạng thái</label>
            <v-select :options="configs.status" v-model="formData.status"></v-select>
          </div>
        </div>
        <div class="row g-3">
          <div class="col-md-4 col-sm-12">
            <label  class="form-label">Đơn vị</label>
            <v-select :options="configs.units" v-model="formData.unit"></v-select>
          </div>
          <div class="col-md-4 col-sm-12">
            <label class="form-label">Màu sắc</label>
            <v-select :options="configs.colors" v-model="formData.color"></v-select>
          </div>
          <div class="col-md-4 col-sm-12">
            <label class="form-label">Size</label>
            <v-select :options="configs.sizes" v-model="formData.size"></v-select>
          </div>
          <div class="col-12">
            <div class="d-grid">
              <button type="button" class="btn btn-primary">Lưu</button>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div><!--end row-->
</template>

<script>
export default {
  name: "FromProduct",
  props:['id'],
  mounted() {
    this.getProductProperty()
  },
  data: function () {
    return {
      dropzoneOptions: {
        url: '/manager/san-pham/upload-image',
        thumbnailWidth: 150,
        maxFilesize: 5,
        addRemoveLinks: true,
        headers: { 'x-csrf-token': document.head.querySelector("[name=csrf-token]").content }
      },
      configs:{
        status:[],
        sizes:[],
        colors:[],
        units:[]
      },
      formData:{
        name:'',
        code:'',
        price_import:0,
        price:0,
        price_discount:0,
        total:0,
        description:'',
        images:null,
        status:0,
        unit:null,
        color:0,
        size:0
      }
    }
  },
  methods:{
  async  getProductProperty(){
    const vm = this;
     const res = await axios.get('/manager/san-pham/get-property');
      if(res.data && res.data.data) {
        vm.configs = res.data.data;
      }
    },
    afterComplete (file) {
    console.log(file);
    }
  }
}
</script>