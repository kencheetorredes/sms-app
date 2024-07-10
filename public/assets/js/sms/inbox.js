
$(document).on('click', '.seeMessages',function(e) {
    var $this = $(this),
        target = $this.data('target'),
        url = $this.data('url');

    $(''+target+'').removeClass('status-middle-bar d-flex align-items-center justify-content-center')
    .addClass('chat-messages').attr('id','middle')
    .html('<center class="mt-5"><span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading data</center>')
    .load(url);

    e.preventDefault();
        
});