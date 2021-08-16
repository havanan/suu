// define a mixin object
export const myMixin = {
  data() {
    return {
      validates: [],
      notifications: {},
      unread: 0
    }
  },
  methods: {
    currencyFormat(num) {
      let result = 0;
      if (num){
          result = '¥' + num.toFixed(2).replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');
      }
      return result;
    },
      numberFormat(num) {
        return new Intl.NumberFormat().format(num)
      },
    dateTimeFormat(datetime){
      return moment(datetime).format('d/m/YYYY')
    },
    alertMsg(code= 404,msg = 'Không có thông tin'){
      // type = ['success','error','warning','info','default']
      let type = '';
      switch(code) {
        case 200:
          type = 'success';
          break;
        case 500:
          type = 'error';
          break;
        default:
         type = 'warning';
      }
      this.$toast.open({
        message:msg,
        type: type,
        position: 'top-right'
      });
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
      getErrMsg(error){
        let result = {}
          if(error.response && error.response.data && error.response.data.errors) {
              result = error.response.data.errors
          }
          return result
      },
      getStatus(status){
        let res = 'Hiển thị'
          if(status === 0) {
              res = 'Ẩn'
          }
          return res
      }
  }
}
