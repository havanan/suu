<template>
    <div class="row justify-content-center h-100 align-items-center">
        <div class="col-md-6">
            <div class="authincation-content">
                <div class="row no-gutters">
                    <div class="col-xl-12">
                        <div class="auth-form">
                            <div class="text-center mb-3">
                                <a href="/login"><img src="images/logo-full.png" alt=""></a>
                            </div>
                            <h4 class="text-center mb-4 text-white">Đăng nhập tài khoản</h4>
                            <div>
                                <div class="form-group">
                                    <label class="mb-1 text-white"><strong>Email</strong></label>
                                    <input type="email" class="form-control" v-model="formData.email">
                                </div>
                                <div class="form-group">
                                    <label class="mb-1 text-white"><strong>Mật khẩu</strong></label>
                                    <input type="password" class="form-control" v-model="formData.password">
                                </div>
                                <div class="form-row d-flex justify-content-between mt-4 mb-2">
<!--                                    <div class="form-group">-->
<!--                                        <div class="custom-control custom-checkbox ml-1 text-white">-->
<!--                                            <input type="checkbox" class="custom-control-input" id="basic_checkbox_1">-->
<!--                                            <label class="custom-control-label" for="basic_checkbox_1">Remember my preference</label>-->
<!--                                        </div>-->
<!--                                    </div>-->
<!--                                    <div class="form-group">-->
<!--                                        <a class="text-white" href="page-forgot-password.html">Forgot Password?</a>-->
<!--                                    </div>-->
                                </div>
                                <div class="text-center">
                                    <button type="button" class="btn bg-white text-primary btn-block" @click="login()">Đăng nhập nhé</button>
                                </div>
                            </div>


                            <!--                            <div class="new-account mt-3">-->
<!--                                <p class="text-white">Don't have an account? <a class="text-white" href="page-register.html">Sign up</a></p>-->
<!--                            </div>-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "Login",
    mounted() {
       
    },
    data(){
        return {
            formData:{
                email:'',
                password:''
            }
        }
    },
    methods: {
        async login(){
            try {
                const response = await axios.post('/api/manager/login',this.formData)
                if (response.data && response.data.status_code){
                    const message = response.data.message ? response.data.message : 'Lỗi'
                    if (response.data.status_code === 200){
                        this.$notify({
                            type: 'success',
                            text:message
                        })
                    }else {
                        this.$notify({
                            type: 'warn',
                            text:message
                        })
                    }
                }
            }catch (error){
                this.$notify({
                    type: 'error',
                    text:'err'
                })
            }

        }
    }
}
</script>
