<template>
  <div class="row">
    <div class="col-lg-8">
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
              <label for="inputStarPoints" class="form-label">Số lượng</label>
              <input type="number" class="form-control" id="inputStarPoints" v-model="formData.total">
            </div>
          </div>
        </div>
        <div class="mb-3">
          <label for="inputProductDescription" class="form-label">Mô tả sản phẩm</label>
          <textarea class="form-control" id="inputProductDescription" rows="3" v-model="formData.description"></textarea>
        </div>
      </div>
    </div>
    <div class="col-lg-4">
      <div class="border border-3 p-4 rounded">
        <div class="row g-3">
          <div class="col-12">
            <div class="mb-3">
              <label for="inputProductDescription" class="form-label">Ảnh sản phẩm</label>
              <vue-dropzone ref="myVueDropzone" id="dropzone" :options="dropzoneOptions" v-model="formData.images"></vue-dropzone>
            </div>
          </div>
          <div class="col-12">
            <label for="inputProductType" class="form-label">Trạng thái</label>
            <select class="form-select" id="inputProductType" v-model="formData.status">
              <option></option>
              <option value="1">Kích hoạt</option>
              <option value="2">Ẩn</option>
            </select>
          </div>
          <div class="col-12">
            <label for="inputVendor" class="form-label">Vendor</label>
            <select class="form-select" id="inputVendor">
              <option></option>
              <option value="1">One</option>
              <option value="2">Two</option>
              <option value="3">Three</option>
            </select>
          </div>
          <div class="col-12">
            <label for="inputCollection" class="form-label">Collection</label>
            <select class="form-select" id="inputCollection">
              <option></option>
              <option value="1">One</option>
              <option value="2">Two</option>
              <option value="3">Three</option>
            </select>
          </div>
          <div class="col-12">
            <label for="inputProductTags" class="form-label">Product Tags</label>
            <input type="text" class="form-control" id="inputProductTags" placeholder="Enter Product Tags">
          </div>
          <div class="col-12">
            <div class="d-grid">
              <button type="button" class="btn btn-primary">Save Product</button>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div><!--end row-->
</template>

<script>
import vue2Dropzone from 'vue2-dropzone';
import 'vue2-dropzone/dist/vue2Dropzone.min.css';

export default {
  name: "FromProduct",
  components: {
    vueDropzone: vue2Dropzone
  },
  props:['id'],
  data: function () {
    return {
      dropzoneOptions: {
        url: 'https://httpbin.org/post',
        thumbnailWidth: 150,
        maxFilesize: 0.5,
        headers: { "My-Awesome-Header": "header value" }
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
        status:0
      }
    }
  }
}
</script>

<style scoped>

</style>