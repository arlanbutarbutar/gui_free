<script src="../resources/lib/jquery/jquery.min.js"></script>
<script src="../resources/lib/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../resources/lib/ionicons/ionicons.js"></script>
<script src="../resources/js/jquery.cookie.js" type="text/javascript"></script>
<script src="../resources/js/jquery.cookie.js" type="text/javascript"></script>
<script src="../resources/js/azia.js"></script>
<script>
    const messageSuccess = $('.message-success').data('message-success');
    const messageInfo = $('.message-info').data('message-info');
    const messageWarning = $('.message-warning').data('message-warning');
    const messageDanger = $('.message-danger').data('message-danger');

    if(messageSuccess){
        Swal.fire({
            icon: 'success',
            title: 'Berhasil Terkirim',
            text: messageSuccess,
        })
    }

    if(messageInfo){
        Swal.fire({
            icon: 'info',
            title: 'For your information',
            text: messageInfo,
        })
    }
    if(messageWarning){
        Swal.fire({
            icon: 'warning',
            title: 'Peringatan!!',
            text: messageWarning,
        })
    }
    if(messageDanger){
        Swal.fire({
            icon: 'error',
            title: 'Kesalahan',
            text: messageDanger,
        })
    }
</script>
<script>
  $(function(){
    'use strict'
  });
</script>