<template>
  <div class="row">
    <div class="col-lg-12 mb-3">
      <div class="border border-3 p-4 rounded">
        <h3>Chi tiết sản phẩm</h3>
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
                <div class="col-md-3 col-sm-12 mb-1 text-right" v-for="item in previewImages">
                  <img :src="'/cdn/products/small/'+item.name" style="width: 100%">
                  <p><span>{{item.name}} </span>   <i class="text-danger" @click="removeImage(item)" style="cursor: pointer">x</i></p>
                </div>
              </div>
          </div>
        </div>
        <div class="mb-3">
          <label for="inputProductTitle" class="form-label">Tên sản phẩm</label>
          <input type="text" class="form-control" id="inputProductTitle" placeholder="Nhập tên sản phẩm" v-model="formData.name" @change="makeSlug()">
        </div>
        <div class="mb-3">
          <label for="inputProductTitle" class="form-label">Seo Url</label>
          <input type="text" class="form-control" v-model="formData.slug">
        </div>
        <div class="mb-3">
          <div class="row">
            <div class="col-md-6 col-sm-12">
              <div class="row">
                <div class="col-md-6 col-sm-12">
                  <label  class="form-label">Loại sản phẩm</label>
                  <v-select :options="configs.categories" v-model="formData.category_id"></v-select>
                </div>
                <div class="col-md-6 col-sm-12">
                  <label  class="form-label">Đơn vị</label>
                  <v-select :options="configs.units" v-model="formData.unit"></v-select>
                </div>
                <div class="col-md-6 col-sm-12">
                  <label  class="form-label">Giá nhập</label>
                  <input type="number" class="form-control"  v-model="formData.price_import">
                </div>
                <div class="col-md-6 col-sm-12">
                  <label  class="form-label">Giá bán</label>
                  <input type="number" class="form-control"  v-model="formData.price">
                </div>
                <div class="col-md-6 col-sm-12">
                  <label  class="form-label">Giá khuyến mại</label>
                  <input type="number" class="form-control"  v-model="formData.price_disount">
                </div>
                <div class="col-md-6 col-sm-12">
                  <label for="inputStarPoints" class="form-label">Tổng số lượng</label>
                  <input type="number" class="form-control" id="inputStarPoints" v-model="formData.total" readonly>
                </div>
              </div>
            </div>
            <div class="col-md-6 col-sm-12">
              <label for="inputProductDescription" class="form-label">Mô tả sản phẩm</label>
              <vue-editor v-model="formData.description"></vue-editor>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-12">
      <div class="border border-3 p-4 rounded">
        <h3>Thuộc tính sản phẩm</h3>
        <template v-for="(detail,key) in formData.details">
          <div class="row mb-3">
            <div class="col-md-3 col-sm-12">
              <label  class="form-label">Ảnh</label>
              <v-select :options="previewImages" v-model="formData.details[key].image">
                <template slot="option" slot-scope="option">
                  <img :src="'/cdn/products/small/'+option.name" style="width: 50px" />
                  {{ option.name }}
                </template>
              </v-select>
            </div>
            <div class="col-md-3 col-sm-12">
              <label  class="form-label">Trạng thái</label>
              <v-select :options="configs.status" v-model="formData.details[key].status"></v-select>
            </div>
            <div class="col-md-3 col-sm-12">
              <label class="form-label">Màu sắc</label>
              <v-select :options="configs.colors" v-model="formData.details[key].color"></v-select>
            </div>
            <div class="col-md-3 col-sm-12">
              <label class="form-label">Size</label>
              <v-select :options="configs.sizes" v-model="formData.details[key].size"></v-select>
            </div>
          </div>
          <div class="row">
            <div class="col-md-3 col-sm-12">
              <label class="form-label">Số lượng</label>
              <input type="number" min="0" v-model="formData.details[key].total" class="form-control" @change="updateTotal()">
            </div>
            <div class="col-md-3 col-sm-12">
              <label  class="form-label">Giá nhập</label>
              <input type="number" class="form-control"  v-model="formData.details[key].price_import">
            </div>
            <div class="col-md-3 col-sm-12">
              <label  class="form-label">Giá bán</label>
              <input type="number" class="form-control"  v-model="formData.details[key].price">
            </div>
            <div class="col-md-3 col-sm-12">
              <label  class="form-label">Giá khuyến mại</label>
              <input type="number" class="form-control"  v-model="formData.details[key].price_disount">
            </div>
            <div class="col-12 text-right mt-3">
              <button class="btn btn-danger" @click="removeDetail(detail)"> <b-icon icon="trash-fill" aria-hidden="true"></b-icon></button>
            </div>

          </div>
        </template>
        <div class="row mt-3 mb-3">
          <div class="col-12 text-right">
            <button type="button" class="btn btn-success mr-2" @click="addDetail()"><b-icon icon="file-plus" aria-hidden="true"></b-icon></button>
            <button type="button" class="btn btn-primary" @click="pushData()">Lưu</button>
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
        slug:'',
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
        size:0,
        details:[{status:null,color:null,size:null,price_import:null,price_discount:null,price:null,total:0,image:null}]
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
      productDetails.push({status:null,color:null,size:null,price_import:null,price_discount:null,price:null,total:0,image:null})
    },
    makeSlug(){
      const vm = this
      let slug = ''
      const name = vm.formData.name
      if (name) {
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
        slug = slug.replace(/ /gi, " - ");
        //Đổi nhiều ký tự gạch ngang liên tiếp thành 1 ký tự gạch ngang
        //Phòng trường hợp người nhập vào quá nhiều ký tự trắng
        slug = slug.replace(/\-\-\-\-\-/gi, '-');
        slug = slug.replace(/\-\-\-\-/gi, '-');
        slug = slug.replace(/\-\-\-/gi, '-');
        slug = slug.replace(/\-\-/gi, '-');
        //Xóa các ký tự gạch ngang ở đầu và cuối
        slug = '@' + slug + '@';
        slug = slug.replace(/\@\-|\-\@|\@/gi, '');
      }
      vm.formData.slug = slug
    },
    pushData(){
      const vm = this
      console.log(vm.formData)
    },
    updateTotal(){
      const vm = this
      const details = vm.formData.details
      let total = 0
      if(details.length > 0 ) {
        for (let i = 0; i < details.length;i++ ) {
          if(details[i].total) {
            total += parseInt(details[i].total)
          }
        }
      }
      vm.formData.total = total
    },
  }
}
</script>