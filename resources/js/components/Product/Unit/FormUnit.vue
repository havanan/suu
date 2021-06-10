<template>
  <div class="mb-3">
    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalPopup"><i class="bx bx-plus"></i> Tạo mới</button>
    <div class="modal fade" id="modalPopup" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="modalLabel">Tạo đơn vị</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
          <div class="form-group">
            <label>Tên đơn vị</label>
            <input type="text" class="form-control" v-model="formData.name">
          </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
            <button type="button" class="btn btn-primary" @click="action()" data-bs-dismiss="modal">Lưu</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
name: "FormUnit",
  props:{
    info:{
      type:Object,
      default:{}
    }
  },
  data(){
  return {
    formData:{
      name:""
    }
  }
  },
  methods:{
    action(){
      const vm = this
      const formData = vm.formData
      let urlApi = '/manager/sam-pham/don-vi/tao-moi';
      if (vm.info && vm.info.id){
        urlApi = '/manager/sam-pham/don-vi/cap-nhat';
        formData.id = vm.info.id
      }
      axios.post(urlApi,formData).then(function (res) {
        console.log(res)
      })
    }
  }
}
</script>