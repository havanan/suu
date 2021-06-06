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
                                    <input type="email" class="form-control" placeholder="Vui lòng nhập email..." v-model="formData.email">
                                </div>
                                <div class="form-group">
                                    <label class="mb-1 text-white"><strong>Mật khẩu</strong></label>
                                    <input type="password" class="form-control" v-model="formData.password">
                                </div>
                                <div class="form-row d-flex justify-content-between mt-4 mb-2">
                                </div>
                                <div class="text-center">
                                    <button type="button" class="btn bg-white text-primary btn-block" @click="login()">Đăng nhập</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { mapActions } from "vuex";

export default {
    name: "Login",
    computed: {
      // formData: {
      //    get(){
      //      return this.$store.state.auth.user
      //    }
      //  }
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
      ...mapActions({
        loginUser:'auth/loginUser'
      }),
      async  login() {
        // try {
        //     const response = await axios.post('/api/v1/manager/login',this.formData)
        //     if (response.data && response.data.status_code){
        //         const message = response.data.message ? response.data.message : 'Lỗi'
        //         if (response.data.status_code === 200){
        //             this.$notify({
        //                 type: 'success',
        //                 text:message
        //             })
        //         }else {
        //             this.$notify({
        //                 type: 'warn',
        //                 text:message
        //             })
        //         }
        //     }
        // }catch (error){
        //     this.$notify({
        //         type: 'error',
        //         text:'err'
        //     })
        // }
        // this.$store.dispatch('auth/loginUser', this.formData);
        try {
          await this.loginUser(this.formData);
          // const message = response.data.message ? response.data.message : 'Lỗi'
          this.$notify({
            type: 'success',
            text:'Đăng nhập thành công !'
          })
          this.$router.push({name:'managerDashboard'});

        } catch (error) {
          this.$notify({
                    type: 'error',
                    text:'Lỗi còn lâu mới đăng nhập được'
                })
        }

      }
    }
}
</script>
