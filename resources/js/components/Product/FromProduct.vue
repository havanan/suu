<template>
  <b-form @submit.stop.prevent="pushData">
    <div class="row">
      <div class="col-lg-12 mb-3">
        <div class="border border-3 p-4 rounded">
          <h3>Chi tiết sản phẩm</h3>
          <div class="row mb-3">
            <div class="col-md-4 col-sm-12">
              <label class="form-label">Upload Ảnh sản phẩm</label>
              <vue-dropzone ref="myVueDropzone"
                            id="dropzone"
                            :options="dropzoneOptions"
                            v-on:vdropzone-success="uploadSuccess"
                            v-on:vdropzone-processing="uploadProcess"
                            v-on:vdropzone-complete="uploadComplete"
              ></vue-dropzone>
            </div>
            <div class="col-md-8 col-sm-12">
              <label class="form-label">Chọn ảnh sản phẩm<i class="text-danger">*</i>
                <b-icon icon="three-dots" animation="cylon" class="ml-2 text-success" id="loading" style="display: none" font-scale="1.5"></b-icon>
                <p v-if="errors.images" class="text-danger">{{errors.images}}</p>
              </label>
              <b-row class="box-image">
                <b-col cols="6" md="2" v-for="(img,index) in productImages" :key="index">
                  <label :title="img">
                    <b-img-lazy   :src="getImageUrl(img)" :alt="img" class="img-preview" :id="'popover-target-'+index"></b-img-lazy>
                    <input type="checkbox" v-model="formData.images" :id="'productImage'+index" :value="img" >
                    <b-popover :target="'popover-target-'+index" triggers="hover" placement="top">
                      <b-img-lazy   :src="getImageUrl(img)" :alt="img" class="img-product"></b-img-lazy>
                    </b-popover>
                  </label>
                </b-col>
              </b-row>
            </div>
          </div>
          <div class="mb-3">
            <div class="row">
              <div class="col-md-6 col-sm-12">
                <div class="mb-3">
                  <label for="inputProductTitle" class="form-label">Tên sản phẩm <i class="text-danger">*</i></label>
                  <input type="text" class="form-control" :class="errors.name ? 'is-invalid' : '' " id="inputProductTitle" placeholder="Nhập tên sản phẩm" v-model="formData.name" @change="getProductSlug()" >
                  <span class="text-danger" v-if="errors.name">{{errors.name}}</span>
                </div>
                <div class="mb-3">
                  <label for="inputProductTitle" class="form-label">Seo Url</label>
                  <input type="text" class="form-control" v-model="formData.slug">
                </div>
                <div class="row">
                  <div class="col-md-6 col-sm-12">
                    <label  class="form-label">Loại sản phẩm <i class="text-danger">*</i></label>
                    <div class="row">
                      <div class="col-md-10 mb-2">
                        <v-select
                                  :options="configs.categories"
                                  v-model="formData.category_id"
                                  :class="errors.category_id ? 'is-invalid' : ''"
                                  :reduce="category => category.id"
                        ></v-select>
                      </div>
                      <!-- tạo nhanh loại sản phẩm-->
                      <div class="col-md-2 text-right">
                        <button type="button" class="btn btn-primary" id="popover-button-variant">+</button>
                        <b-popover target="popover-button-variant" triggers="focus" :show.sync="popover">
                          <template #title>Tạo nhanh</template>
                          <div class="form-group">
                            <label>Tên</label>
                            <input type="text" class="form-control" v-model="formCat.name">
                            <span class="text-danger" v-if="errors.cat_name" v-html="errors.cat_name"></span>
                          </div>
                          <div class="form-group text-right">
                            <button class="btn btn-success" @click="createProductCategory()">Lưu</button>
                          </div>
                        </b-popover>
                      </div>
                      <!-- end tạo nhanh loại sản phẩm-->
                    </div>
                    <span class="text-danger" v-if="errors.category_id">{{errors.category_id}}</span>
                  </div>
                  <div class="col-md-6 col-sm-12">
                    <label  class="form-label">Đơn vị</label>
                    <div class="row">
                      <v-select class="col-md-10 mb-2"
                                :options="configs.units"
                                v-model="formData.unit"
                                :reduce="unit => unit.code"
                      ></v-select>
                      <!-- tạo nhanh đơn vị sản phẩm-->
                      <div class="col-md-2 text-right">
                        <button type="button" class="btn btn-primary" id="popover-button-unit">+</button>
                        <b-popover target="popover-button-unit" triggers="focus" :show.sync="popoverUnit">
                          <template #title>Tạo nhanh</template>
                          <div class="form-group">
                            <label>Tên</label>
                            <input type="text" class="form-control" v-model="formUnit.name">
                            <span class="text-danger" v-if="errors.unit_name" v-html="errors.unit_name"></span>
                          </div>
                          <div class="form-group text-right">
                            <button class="btn btn-success" @click="createProductUnit()">Lưu</button>
                          </div>
                        </b-popover>
                      </div>
                      <!-- end tạo nhanh đơn vị sản phẩm-->
                    </div>

                  </div>
                  <div class="col-md-6 col-sm-12">
                    <label  class="form-label">Giá nhập <i class="text-danger">*</i></label>
                    <input type="number" min="0" class="form-control" :class="errors.price_import ? 'is-invalid' : ''"  v-model="formData.price_import" >
                    <span class="text-danger" v-if="errors.price_import">{{errors.price_import}}</span>
                  </div>
                  <div class="col-md-6 col-sm-12">
                    <label  class="form-label">Giá bán <i class="text-danger">*</i></label>
                    <input type="number" min="0" class="form-control" :class="errors.price ? 'is-invalid' : ''"  v-model="formData.price" >
                    <span class="text-danger" v-if="errors.price">{{errors.price}}</span>
                  </div>
                  <div class="col-md-6 col-sm-12">
                    <label  class="form-label">Giá khuyến mại</label>
                    <input type="number" min="0" class="form-control"  v-model="formData.price_discount">
                  </div>
                  <div class="col-md-6 col-sm-12">
                    <label for="inputStarPoints" class="form-label">Tổng số lượng</label>
                    <input type="number" min="0" class="form-control" id="inputStarPoints" v-model="formData.total" readonly>
                  </div>
                </div>
              </div>
              <div class="col-md-6 col-sm-12">
                <label class="form-label">Mô tả sản phẩm</label>
                <vue-editor v-model="formData.description"></vue-editor>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-12">
        <div class="border border-3 p-4 rounded">
          <div class="row">
            <div class="col-md-9 col-sm-12">
              <h3>Thuộc tính sản phẩm</h3>
            </div>
            <div class="col-md-3 col-sm-12">
              <h4 class="text-danger">Tiền nhập: {{vnPriceFormat(formData.price_total)}}</h4>
            </div>
          </div>
          <template v-for="(detail,key) in formData.details">
            <div class="row mb-3">
              <div class="col-md-3 col-sm-12">
                <label  class="form-label">Ảnh</label>
                <div class="row detail-box-image">
                  <div v-for="(img,index) in productImages" class="col-3">
                    <label>
                      <b-img-lazy   :src="getImageUrl(img)" :alt="img" :id="'popover-detail-'+index"></b-img-lazy>
                      <input type="radio" v-model="formData.details[key].image" :id="'detailImage'+index+key" :value="img">
                      <b-popover :target="'popover-detail-'+index" triggers="hover" placement="top">
                        <b-img-lazy   :src="getImageUrl(img)" :alt="img" class="img-product"></b-img-lazy>
                      </b-popover>
                    </label>
                  </div>
                </div>
              </div>
              <div class="col-md-3 col-sm-12">
                <label  class="form-label">Trạng thái</label>
                <select v-model="formData.details[key].status" class="form-control">
                  <option v-for="(status,key) in configs.status" :value="key">{{status}}</option>
                </select>
              </div>
              <div class="col-md-3 col-sm-12">
                <label class="form-label">Màu sắc</label>
                <select v-model="formData.details[key].color" class="form-control">
                  <option v-for="(color,key) in configs.colors" :value="key">{{color}}</option>
                </select>
              </div>
              <div class="col-md-3 col-sm-12">
                <label class="form-label">Size</label>
                <select v-model="formData.details[key].size" class="form-control">
                  <option v-for="(size,key) in configs.sizes" :value="key">{{size}}</option>
                </select>
              </div>
            </div>
            <div class="row">
              <div class="col-md-3 col-sm-12">
                <label class="form-label">Số lượng</label>
                <input type="number" min="0" v-model="formData.details[key].total" class="form-control" @change="updateTotal()">
              </div>
              <div class="col-md-3 col-sm-12">
                <label  class="form-label">Giá nhập</label>
                <input type="number" min="0" class="form-control"  v-model="formData.details[key].price_import" @change="updateTotal()">
              </div>
              <div class="col-md-3 col-sm-12">
                <label  class="form-label">Giá bán</label>
                <input type="number" min="0" class="form-control"  v-model="formData.details[key].price">
              </div>
              <div class="col-md-3 col-sm-12">
                <label  class="form-label">Giá khuyến mại</label>
                <input type="number" min="0" class="form-control"  v-model="formData.details[key].price_discount">
              </div>
              <div class="col-12 text-right mt-3">
                <button class="btn btn-danger" @click="removeDetail(detail)"> <b-icon icon="trash-fill" aria-hidden="true"></b-icon></button>
              </div>

            </div>
          </template>
          <div class="row mt-3 mb-3">
            <div class="col-12 text-right">
              <button type="button" class="btn btn-success" @click="addDetail()"><b-icon icon="file-plus" aria-hidden="true"></b-icon></button>
              <button type="reset" class="btn btn-danger">Nhập lại</button>
              <button type="submit" class="btn btn-primary">Lưu</button>
            </div>
          </div>
        </div>
      </div>
    </div><!--end row-->
  </b-form>
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
    this.getAllProductImage()
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
        slug:'',
        code:'',
        price_import:0,
        price:0,
        price_discount:0,
        total:0,
        price_total:0,
        description:'',
        images:[],
        imageRemove:[],
        status:null,
        unit:null,
        category_id:null,
        details:[]
      },
      productImages: [],
      errors:{
        name:null,
        price_import:null,
        price:null,
        images:null,
        category_id:null,
        cat_name:null,
        unit_name:null
      },
      formCat:{
        name:''
      },
      popover:false,
      formUnit:{
        name:''
      },
      popoverUnit:false
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
          this.productImages.push(response.name)
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
    removeDetail(detail){
      const vm = this
      const productDetails = vm.formData.details;
      const index = productDetails.indexOf(detail);
      if(index > -1){
        productDetails.splice(index, 1);
        vm.formData.details =  productDetails;
        vm.updateTotal()
      }
    },
    addDetail(){
      const vm = this
      const productDetails = vm.formData.details;
      const price = vm.formData.price
      const price_import = vm.formData.price_import
      const price_discount =  vm.formData.price_discount
      productDetails.push({status:null,color:null,size:null,price_import:price_import,price_discount:price_discount,price:price,total:0,image:null})
    },
    getProductSlug(){
      const vm = this
      vm.formData.slug = vm.makeSlug(vm.formData.name)
    },
    makeSlug(name){
      const vm = this
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
    pushData(){
      const vm = this
      axios.post('/manager/san-pham/tao-moi',vm.formData).then(function (res) {
        console.log(res)
        console.log('done')
      }).catch(function (error) {
        if(error.response && error.response.data && error.response.data.errors) {
            vm.errors = error.response.data.errors
        }
      });
    },
    resetForm(){
      const vm = this
      vm.formData = {
        name:'',
        slug:'',
        code:'',
        price_import:0,
        price:0,
        price_discount:0,
        price_total:0,
        total:0,
        description:'',
        images:[],
        imageRemove:[],
        status:0,
        unit:null,
        category_id:null,
        color:0,
        size:0,
        details:[{status:null,color:null,size:null,price_import:null,price_discount:null,price:null,total:0,image:null}]
      }
    },
    updateTotal(){
      const vm = this
      const details = vm.formData.details
      let total = 0
      let priceTotal = 0;
      if(details.length > 0 ) {
        for (let i = 0; i < details.length;i++ ) {
          if(details[i].total) {
            const itemTotal = parseInt(details[i].total)
            const itemPrice = parseInt(details[i].price_import)

            total += itemTotal
            priceTotal += (itemTotal * itemPrice)
          }
        }
      }
      vm.formData.total = total
      vm.formData.price_total = priceTotal
    },
    async getAllProductImage(){
      const vm = this
      const res = await axios.get('/manager/san-pham/media');
      if (res.data){
        vm.productImages = res.data
      }
    },
    getImageUrl(img){
      return '/cdn/products/small/'+img;
    },
    vnPriceFormat(price){
      price = parseInt(price)
      if (price > 1000) {
        price = price.toLocaleString('it-IT', {style : 'currency', currency : 'VND'});
      }
      return price;
    },
    createProductCategory(){
      const vm = this
      const formCat = vm.formCat
      formCat.slug = vm.makeSlug(vm.formCat.name)
      axios.post('/manager/loai-san-pham/tao-moi',formCat).then(function (res){
        if (res.data){
          vm.popover = false
          vm.configs.categories = res.data
          vm.formCat.name = null
          vm.formCat.slug = null
          vm.errors.cat_name = null
        }
      }).catch(function (error) {
        if(error.response && error.response.data && error.response.data.errors) {
            vm.errors.cat_name = error.response.data.errors.name
        }
      });
    },
    createProductUnit(){
      const vm = this
      const formUnit = vm.formUnit
      axios.post('/manager/san-pham/don-vi/tao-moi',formUnit).then(function (res){
        if (res.data){
          vm.popoverUnit = false
          vm.configs.units = res.data.data
          vm.formUnit.name = null
          vm.errors.unit_name = null
        }
      }).catch(function (error) {
        if(error.response && error.response.data && error.response.data.errors) {
          vm.errors.unit_name = error.response.data.errors.name
        }
      });
    }
  }
}
</script>