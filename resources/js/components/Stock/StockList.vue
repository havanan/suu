<template>
    <div class="row mt-2">
        <div class="container-fluid">
            <button class="btn btn-primary px-3" @click="createAction()"><i class="bx bx-plus"></i>Tạo</button>
        </div>
        <div class="col-md-9"></div>
        <div class="col-md-3">
            <div class="form-group">
                <input type="text" class="form-control" placeholder="Tìm kiếm..." @change="getList(0)" v-model="keyword">
            </div>
        </div>
        <b-table
                :fixed="true"
                :items="stocks"
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
            <template #cell(owner)="data">
                <p v-text="getOwnerInfo(data.item.owner)"></p>
            </template>
            <template #cell(parent_id)="data">
                <p v-text="getParentInfo(data.item.parent_id)"></p>
            </template>
            <template #cell(action)="data">
                <button class="btn btn-primary px-3 text-center" @click="editStock(data.item.id)"><i class="bx bx-pencil"></i></button>
                <button class="btn btn-danger px-3 text-center" @click="deleteStock(data.item.id)"><i class="bx bx-trash-alt"></i></button>
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
        <b-modal id="modalPopup" :title="action === 'create' ? 'Tạo Kho' : 'Sửa Kho'" v-model="showModel" hide-footer>
            <form method="post">
                <div class="form-group">
                    <label>Tên kho</label>
                    <input type="text" class="form-control" v-model="formData.name" :class="errors.name ? 'is-invalid' : ''">
                    <span class="text-danger" v-if="errors.name">{{errors.name}}</span>

                </div>
                <div class="form-group">
                    <label>Địa chỉ</label>
                    <input type="text" class="form-control" v-model="formData.address">
                </div>
                <div class="form-group">
                    <label>Điện thoại</label>
                    <input type="text" class="form-control" v-model="formData.phone">
                </div>
                <div class="form-group">
                    <label>Quản lý kho</label>
                    <v-select :options="configs.owners"
                              v-model="formData.owner_id"
                              :reduce="country => country.code"
                              :class="errors.owner_id ? 'is-invalid' : ''"></v-select>
                    <span class="text-danger" v-if="errors.owner_id">{{errors.owner_id}}</span>
                </div>
                <div class="form-group">
                    <label>Kho tổng</label>
                    <v-select :options="configs.parents"
                              :reduce="country => country.code"
                              v-model="formData.parent_id"></v-select>
                </div>
                <div class="form-group text-right">
                    <button type="reset" class="btn btn-danger" @click="showModel=false">Đóng</button>
                    <button type="button" class="btn btn-primary" @click="formAction()">Lưu</button>
                </div>
            </form>
        </b-modal>
    </div>
</template>

<script>
    export default {
        name: "StockList",
        data(){
            return {
                action:'create',
                formData:{
                    id:null,
                    name:null,
                    address:null,
                    phone:null,
                    parent_id:null,
                    owner_id:null,
                },
                configs:{
                    owners:[],
                    parents:[]
                },
                errors:{
                    name:null,
                    owner_id:null
                },
                stocks:[],
                fields:[
                    {
                        key:'id',
                        label:'Id',
                        sortable: true,
                    },
                    {
                        key:'name',
                        label:'Tên kho',
                        sortable: true,
                    },
                    {
                        key:'address',
                        label:'Địa chỉ',
                        sortable: true,
                    },
                    {
                        key:'phone',
                        label:'Số kho',
                        sortable: true,
                    },
                    {
                        key:'owner',
                        label:'Quản lý kho',
                        sortable: true,
                    },
                    {
                        key:'parent_id',
                        label:'Loại kho',
                        sortable: true,
                    },
                    {
                        key:'action',
                        label:'Tác vụ'
                    },
                ],
                isBusy: false,
                currentPage:1,
                totalRows:0,
                perPage:0,
                keyword:null,
                showModel:false
            }
        },
        watch:{
            currentPage: {
                handler: function (newVal, oldVal) {
                    if (newVal !== oldVal) {
                        this.getList()
                    }
                }
            },
            showModel:{
                handler: function (newVal, oldVal) {
                    if (!newVal) {
                        this.formData = {
                            id:null,
                            name:null,
                            address:null,
                            phone:null,
                            parent_id:null,
                            owner_id:null,
                        }
                    }
                }
            }
        },
        mounted() {
            this.getConfig()
            this.getList()
        },
        methods:{
            async getConfig(){
                const vm = this;
                const res = await axios.get('/manager/kho/get-config');
                if (res.data && res.data.data){
                    vm.configs = res.data.data
                }
            },
            async getList(page = false){
                const vm = this;
                const form = {
                   params:{
                       keyword:vm.keyword,
                       page : page ? page : vm.currentPage
                   }
                }
                const res = await axios.get('/manager/kho/get-list',form);
                if (res.data && res.data.items){
                    vm.stocks = res.data.items
                }
            },
            createAction(){
                const vm = this;
                vm.showModel=true;
                vm.action = 'create';
            },
            getOwnerInfo(data){
                let name = '-';
                if (data){
                    name= data.name
                }
                return name;
            },
            getParentInfo(data){
                let name = 'Kho tổng';
                if (data){
                    name= 'Kho con'
                }
                return name;
            },
            formAction(){
                const vm = this;
                const fromData = vm.formData;
                let url = '/manager/kho/tao-moi'
                if (vm.action === 'edit'){
                    url = '/manager/kho/sua/'+fromData.id
                }
                axios.post(url,fromData).then(function (res) {
                    if (res.data && res.data.items){
                        vm.stocks = res.data.items
                        vm.showModel = false
                    }

                }).catch(function (error) {
                    if(error.response && error.response.data && error.response.data.errors) {
                        vm.errors = error.response.data.errors
                    }
                });
            },
            deleteStock(id){
                if(!id){
                    return false
                }
                const vm = this
                axios.get('/manager/kho/xoa/'+id).then(function (res) {
                    if (res.data && res.data.items){
                        vm.stocks = res.data.items
                    }
                }).catch(function (error) {
                });
            },
            editStock(id){
                if(!id){
                    return false
                }
                const vm = this
                axios.get('/manager/kho/sua/'+id).then(function (res) {
                    if (res.data && res.data.data){
                        vm.formData = res.data.data
                        vm.action = 'edit'
                        vm.showModel = true
                    }
                }).catch(function (error) {
                });
            },
        }
    }
</script>