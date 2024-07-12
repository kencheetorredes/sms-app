
$(document).on('click', '.seeMessages',function(e) {
    var $this = $(this),
        target = $this.data('target'),
        url = $this.data('url');

    $(''+target+'').removeClass('status-middle-bar d-flex align-items-center justify-content-center')
    .addClass('chat-messages').attr('id','middle')
    .html('<center class="mt-5"><span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading data</center>')
    .load(url);
    $('.seeMessages').removeClass('active');
    $this.addClass('active');


    e.preventDefault();
        
});

$(document).on('click', '.replyBtn',function(e) {
    var $this = $(this),
        chat_msg = $('#chat_msg').val(),
        form  = typeof $this.data('form')  === 'undefined' ? $this.closest('form') : $('#' + $this.data('form') + ''),
        action = form.attr('action'),
        method = form.attr('method').toLowerCase(),
        data   = form.serialize(),
        warningMsg = typeof form.data('error') === 'undefined' ? 'All red field are required' : form.data('error');
       

    if(chat_msg != ''){
        btnLoading($this,1);
        var responce = DataWithIMageHadler(form, method, action, data); 
        $('.form-control').each(function(e){
            $(this).removeClass('is-invalid')
        })
            responce.done(function (response, textStatus, jqXHR) {
                $(''+response.target+'').load(response.url);
            }).fail(function (response, textStatus, jqXHR) {
                killBtnLoading($this,'<i class="bx bx-paper-plane"></i>');
                $('.invalid-feedback').remove();
                $('.form-control').each(function(e){
                    $(this).removeClass('is-invalid')
                })
                window.scrollTo(0, 0);
                if(response.status == 422){
                    $.each(response.responseJSON.errors, function(key, item) 
                    {
                        
                        selector = document.getElementsByName(key);
                        
                        if(selector.length == 0){
                            selector = document.getElementsByName(key+'[]');
                        } 
                        $(selector).addClass('is-invalid').after('<div class="invalid-feedback">'+item[0]+'</div>');
                    });
                } else {
                    killBtnLoading($this,'<i class="bx bx-paper-plane"></i>');
                    Swal.fire(
                        'Oops!',
                        'Something went wrong!',
                        'error'
                    );
                }
            });
        //
    }

    e.preventDefault();
});