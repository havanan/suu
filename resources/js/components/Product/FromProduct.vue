<template>
  <div class="row">
    <div class="col-lg-6">
      <div class="border border-3 p-4 rounded">
        <div class="row mb-3">
          <div class="col-md-4 col-sm-12">
              <label class="form-label">Ảnh sản phẩm</label>
              <vue-dropzone ref="myVueDropzone"
                            id="dropzone"
                            :options="dropzoneOptions"
                            v-on:vdropzone-success="uploadSuccess"
                            v-on:vdropzone-processing="uploadProcess"
                            v-on:vdropzone-complete="uploadComplete"
              ></vue-dropzone>
            </div>
          <div class="col-md-8 col-sm-12">
              <label class="form-label">Preview
                <b-icon icon="three-dots" animation="cylon" class="ml-2 text-success" id="loading" style="display: none" font-scale="1.5"></b-icon>
              </label>
              <div class="row">
                <div class="col-md-3 mb-1 text-right" v-for="item in previewImages">
                  <img :src="'/cdn/products/small/'+item.name" style="width: 100%">
                  <i class="text-danger" @click="removeImage(item)" style="cursor: pointer">x</i>
                </div>
              </div>
          </div>
        </div>
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
              <label for="inputCostPerPrice" class="form-label">Loại sản phẩm</label>
              <v-select :options="configs.categories" v-model="formData.category_id"></v-select>
            </div>
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
          <vue-editor v-model="formData.description"></vue-editor>
        </div>
      </div>
    </div>
    <div class="col-lg-6">
      <div class="border border-3 p-4 rounded">
        <div class="row g-3">
          <div class="col-md-6 col-sm-12">
            <label  class="form-label">Trạng thái</label>
            <v-select :options="configs.status" v-model="formData.status"></v-select>
          </div>
          <div class="col-md-6 col-sm-12">
            <label  class="form-label">Đơn vị</label>
            <v-select :options="configs.units" v-model="formData.unit"></v-select>
          </div>
          <div class="col-md-6 col-sm-12">
            <label class="form-label">Màu sắc</label>
            <v-select :options="configs.colors" v-model="formData.color"></v-select>
          </div>
          <div class="col-md-6 col-sm-12">
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
  import { VueEditor, Quill } from "vue2-editor";

  export default {
  name: "FromProduct",
    components: {
      VueEditor,Quill
    },
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
        addRemoveLinks: false,
        previewsContainer: false,
        headers: { 'x-csrf-token': document.head.querySelector("[name=csrf-token]").content }
      },
      configs:{
        status:[],
        sizes:[],
        colors:[],
        units:[],
        categories:[]
      },
      formData:{
        name:'',
        code:'',
        price_import:0,
        price:0,
        price_discount:0,
        total:0,
        description:'',
        images:[],
        imageRemove:[],
        status:0,
        unit:null,
        category_id:null,
        color:0,
        size:0
      },
      previewImages:[],
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
    uploadSuccess(file, response) {
        if(response.id){
          this.formData.images.push(response.id)
          this.previewImages.push(response);

        }
    },
    uploadProcess(file){
      if (file){
        $('#loading').show()
      }
    },
    uploadComplete(res){
      $('#loading').hide()
    },
      removeImage(image){
        const vm = this
        const previewImages = vm.previewImages;
        const formImages = vm.formData.images;
        if (image && image.id > 0) {
          //xóa ảnh cũ của sp
          const index = previewImages.indexOf(image);
          if(index > -1){
            previewImages.splice(index, 1);
            vm.previewImages =  previewImages;
            vm.formData.imageRemove.push(image.id)
          }
          //xóa ảnh ở mảng upload
          const imageIndex = formImages.indexOf(image.id);
          if(imageIndex > -1){
            formImages.splice(index, 1);
            vm.formData.images =  formImages;
          }
        }
      },
  }
}
</script>