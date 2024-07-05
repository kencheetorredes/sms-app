

var is_async_step = false;


(function($) {
    "use strict"

    $(document).on('change', '.entiry', function (e) {
        var $this  = $(this),
            val    = $this.val(),
            target = $('option:selected',this).data('id');
    
        $('.bkt_switcher').find('input.required,select.required').each(function(e){
            $(this).val('');
            $(this).removeClass('required');
        });
    
        $('.bkt_switcher').find('input.is_fetch,select.is_fetch').each(function(e){
            $(this).val('');
            $(this).removeClass('fetch');
        });
    
        $('.'+target+'').find('input,select').each(function(e){
            if(!$(this).hasClass('not_required')){
                $(this).addClass('required');
            }
           
        });
    
        $('.'+target+'').find('input.is_fetch,select.is_fetch').each(function(e){
            $(this).addClass('fetch');
        });
    
        $('.bkt_switcher').addClass('hide_it');
        $('.'+target+'').removeClass('hide_it');
    
        e.preventDefault();
    
    });

    $(document).on('change', '.selectProvince', function (e) {
       
            var $this  = $(this),
                data_  = $('option:selected', this).data('city'),
                html    = '<option value=""></option>',
                city = $this.parent().parent().find('.city');

                $.each(data_, function(k, v) {
                        html += '<option value="'+v.id+'">'+v.name+'</option>';
                });
          
            city.html(html);

                
    });

    

    var form = $("#step-form-horizontal");
    form.children('div').steps({
        headerTag: "h4", 
        bodyTag: "section",
        transitionEffect: "slideLeft",
        autoFocus: true, 
        transitionEffect: "slideLeft",
        titleTemplate: '<span class="wizard-index">#index#</span> #title#',
        onStepChanging: function (event, currentIndex, newIndex)
        {
            
            var source_data = $('#steps-uid-0-p-'+currentIndex+'').data('source');
            var validate = validation($('#'+source_data+''));

            if(!validate){ 

                if (currentIndex < newIndex) {
                    if(currentIndex > 0){
                        tableSummary(source_data);
                    } else {
                        getFormSection(source_data);
                    }
                    return true;
                 
                } else {
                    return true;
                }

            }
            
        },onFinishing: function (event, currentIndex)
        {
            fireLoading();
            $('#step-form-horizontal').submit();
        },
    });

})(jQuery);


                    

