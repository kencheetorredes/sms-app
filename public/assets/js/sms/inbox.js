
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
        chat_msg = $('#chat_msg').val();

    if(chat_msg != ''){
        btnLoading($this,1);
        killBtnLoading($this,'<i class="bx bx-paper-plane"></i>');
    }

    e.preventDefault();
});