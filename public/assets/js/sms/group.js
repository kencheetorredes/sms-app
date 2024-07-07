$(document).on('click', '.removeToGroup',function(e) {

    var $this = $(this),
    msg   = $this.data('msg'),
    data  = {"id":""+$this.data('id')+"","action":""+$this.data('action')+""},
    action = $this.data('url');
    Swal.fire({
        title: 'Warning',
        text: msg,
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        confirmButtonText: 'Yes',
        showLoaderOnConfirm: true,
        allowOutsideClick:false,
        allowEscapeKey:false

    }).then(($result) => {
        if($result.value){
            fireLoading();
            var responce = DataHadler('', 'POST', action, data); 
            responce.done(function (response, textStatus, jqXHR) {
                kill_modal();
                var source = $('#'+response.target+'').data('url');
                $('#'+response.target+'').before('<div class="alert alert-success alert-msg"s>'+response.msg+'</div>');
                $('#'+response.target+'').bootstrapTable('refresh', {
                    url: source
                });
                kill_alert(); 
                killLoading();
            });
            
        }
    }); 

    e.preventDefault();
});
