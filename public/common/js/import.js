$(document).on('click', '.importBtnBkt',function(e) {
   
    var $this = $(this),
        form  = typeof $this.data('form')  === 'undefined' ? $this.closest('form') : $('#' + $this.data('form') + ''),
        action = form.attr('action'),
        method = form.attr('method').toLowerCase(),
        data   = form.serialize();
     
        
        if (validation(form,false)) { 
            form.prepend(errorDiv.replace('error',warningMsg));
        } else{
            btnLoading($this);
            var responce = DataWithIMageHadler(form, method, action, data); 
                responce.done(function (response, textStatus, jqXHR) {
                    killBtnLoading($this);
                    if(response.code == 300){
                        form.prepend(errorDiv.replace('error',response.msg ));
                    } else {
                        load_updated(response.percentage);
                        $('#loader_modal').modal('show');
                        $('#process_loading_url').val(response.url);
                        $('#msg_impoty').html('Importing data please wait');
                        process(response.file,response.current_page,response.data);
                        kill_modal();
                        kill_alert();
                    }
                    
            }).fail(function (response, textStatus, jqXHR) {
                killBtnLoading($this);
                $('.invalid-feedback').remove();
                $('.form-control').each(function(e){
                    $(this).removeClass('is-invalid')
                })
                window.scrollTo(0, 0);
                if(response.status == 422){
                    $.each(response.responseJSON.errors, function(key, item) 
                    {
                        selector = document.getElementsByName(key);
                        $(selector).addClass('is-invalid').after('<div class="invalid-feedback">'+item[0]+'</div>');
                    });
                } else {
                    Swal.fire(
                        'Oops!',
                        'Something went wrong!',
                        'error'
                    );
                }
            });;
        }

        e.preventDefault();
});

function load_updated(percentage){
    $('.my_progerss_').css('width',percentage+'%').attr('aria-valuenow',percentage);
}

function process(file,counter,data){

    var action = $('#process_loading_url').val(),
        data = {"file":""+file+"","current_page":""+counter+"","data":""+data+""},
        method = 'post';

        var responce = DataHadler('', method, action, data); 
            responce.done(function (response, textStatus, jqXHR) {
                if(response.code == 300){
                    
                    Swal.fire({
                        title: 'Error',
                        text: response.msg,
                        type: 'error',
                        showCancelButton: false,
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'Ok',
                        showLoaderOnConfirm: true,
                        allowOutsideClick:false,
                        allowEscapeKey:false
    
                    }).then(($result) => {
                        $('#loader_modal').modal('hide');
                    });  
                } else {
                    if(response.is_last){
                        load_updated(response.percentage);
                        if(response.error > 0){
                            window.location = response.error_url;
                        }
                        var myInterval = setInterval(function () {
                            $('#loader_modal').modal('hide');
                            var source = $('#'+response.table+'').data('url');
                            $('#'+response.table+'').before('<div class="alert alert-success solid alert-msg"s>'+response.msg+'</div>');
                            $('#'+response.table+'').bootstrapTable('refresh', {
                                url: source
                            });
                            kill_alert();
                            clearInterval(myInterval);
                        },5000);
                    
                    } else {
                        load_updated(response.percentage);
                        
                        var myInterval = setInterval(function () {
                            process(response.file,response.current_page,response.data);
                            clearInterval(myInterval);
                        },2000);
                    }
                }
            });

}