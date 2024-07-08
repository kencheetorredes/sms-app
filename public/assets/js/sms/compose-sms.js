$(document).on('change', '.changeType',function(e) {
    var $this = $(this),
        target = $('option:selected', this).data('target');
        $('.contact_type').addClass('d-none');
        $(''+target+'').removeClass('d-none');
});

$(document).on('change', '.getTemplate',function(e) {
    var $this = $(this),
        url  = $this.data('url'),
        target  = $this.data('target'),
        id = $this.val();
    
    fireLoading();
    var res = DataHadler('', 'post', url, {"id":""+id+"","action":"getTemplateContent"});
    res.done(function (response, textStatus, jqXHR) {
        $(''+target+'').val(response);
        killLoading();
    })
});