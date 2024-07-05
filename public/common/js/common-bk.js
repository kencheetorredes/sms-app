

$(document).on('change', '.img_preview_load',function(e) {
    
    var file__ = $(this)[0].files[0],
        $this  =   $(this);
    
    var reader = new FileReader(); // instance of the FileReader


    reader.readAsDataURL(file__);

    reader.onload= function(){ // set image data as background of div
        $this.parent().parent().find('img').attr('src',this.result).show();
    
    }

});



$(window).scroll(function() {
    if ($(this).scrollTop() > 90 ){
      if(!$('.p-form').hasClass('b-fixed')){
          $('.p-form').addClass('b-fixed');
      }
    } else if($(this).scrollTop() < 10 ) {
      if($('.p-form').hasClass('b-fixed')){
          $('.p-form').removeClass('b-fixed');
      }
    }
});

$(".sidebar-link").hover(
    function() {
        $(this).addClass("bg-orange1");
        $(this).find('i').addClass('text-white');
    },
    function() {
        $(this).removeClass("bg-orange1");
        $(this).find('i').removeClass('text-white');
    }
);
var onTbale = true;
var errorDiv    = '<div class="alert-msg alert solid alert-danger">error</div>',
    successDiv  = '<div class="alert-msg alert solid alert-success">success-mg</div>',
    onloadpage  = $('.onloadpage'),
    loadmessage = $('.loadmessage'),
    is_verify   = $('#is_verify');

    const cars = [2000, 4000,6000,8000,10000];
            var min = 0;
            var max = 4;

            /**
     * pop up js
     */ 
     
     $(document).on('click', '.pop-up', function (e) {
        
        var template  = $(this).data('template'),
            modalSize = $(this).data('size'),
            focus_    = $(this).data('focus');

            
            $('.table').on('click-row.bs.table', function (e, row, $element) {
                return false;
            });
            
            $('#staticBackdrop .modal-dialog').removeClass('modal-xxl modal-xxxl modal-lg modal-xl');

            if(typeof modalSize !== 'undefined'){
                $('#staticBackdrop .modal-dialog').addClass("modal-"+modalSize);
            } 

            $('#pop-div').html('<center class="mt-3 mb-3"> <i class="fa fa-spinner fa-3x fa-spin"></i> <br>loading please wait</center>');
            $('#pop-div').load(template);

            if(typeof focus_ !== 'undefined'){ 
               
                $('#staticBackdrop').modal('show').on('shown.bs.modal', function() {
                    $(''+focus_+'').focus();
                });
            } else {
                $('#staticBackdrop').modal('show');
            }
            
            e.preventDefault(); 
     });

$(function () { 

    $('.close_side_btn').click(function(e){
        $('.customizer').removeClass('show-service-panel');
        e.preventDefault();
    });

    $('.open_side_btn').click(function(e){
        $('.customizer').addClass('show-service-panel');
        e.preventDefault();
    });
    

   
    
    /**
     * on page load
     */
    if(typeof onloadpage  !== 'undefined'){
        onloadpage.each(function(e){
        if(typeof $(this).data('nolod') === 'undefined'){
            $(this).html('<center> <i class="fa fa-spinner fa-3x fa-spin"></i> <br>loading '+$(this).data('msg')+' please wait</center>');
        }
        $(this).load($(this).data('url'));
        }); 

        
    }

    /**
     * print page
     */
    $(document).on('click', '.printBtn', function (e) {
        window.print();
        e.preventDefault();
    });

    

     

     $(document).on('click', '.changePasswordBtn', function (e) {

        var $this = $(this),
        form  = typeof $this.data('form')  === 'undefined' ? $this.closest('form') : $('#' + $this.data('form') + ''),
        action = form.attr('action'),
        method = form.attr('method').toLowerCase(),
        data      = form.serialize();


        $('.alert-msg').remove();  
   
  
        if (validation(form,false)) { 
          form.prepend(errorDiv.replace('error',warningMsg));
        } else {
            fireLoading();
            responce  = DataHadler(form, method, action, data); 
            responce.done(function (response, textStatus, jqXHR) {
                killLoading();
                if(response.code == 300){
                    form.prepend(errorDiv.replace('error',response.msg));
                } else {
                Swal.fire({
                         title: 'Success',
                         text: response.msg,
                         type: 'success',
                         showCancelButton: false,
                         confirmButtonColor: '#3085d6',
                         confirmButtonText: 'Ok',
                         showLoaderOnConfirm: true,
                         allowOutsideClick:false,
                         allowEscapeKey:false
     
                     }).then(($result) => {
                         killLoading();
                        location.reload();
                 });  
                }
               
                

            });
        }


     });
     /**
      * bootstrap table on click events
      */

    $('.table').on('click-cell.bs.table', function (e, row, $element, $el) {
       
        var ispopup     = $(this).data('ispopup'),
            tagetTYpe   = $(this).data('tagettype'),
            value       = $(this).data('row'),
            url         = $(this).data('target'),
            wildcard    = value.split(','),
            newWildcard = '',
            modalSize   = $(this).data('size'),
            is_lot      = $(this).data('is_lot'), 
            explode     = $(this).data('explode'),
            run         = true;

            if(typeof(explode) !== 'undefined'){
                var column_bkt = explode.split(',');
                for(var xx = 0; xx < column_bkt.length;xx++){
                    if(row == column_bkt[xx]){
                        run = false;
                        break;
                    }
                }
            }
           

            var random =  Math.floor(Math.random() * max);

            $('#pop-div').html('<div class="modal-body"><center><i class="fa fa-spinner fa-spin fa-2x"></i> <span style="font-size:20px">loading please wait...</span></center></div>');
            
            
            if(run){

           
            if(typeof(is_lot) === 'undefined'){
                
                for(var x = 0;x<wildcard.length;x++){
                    newWildcard += wildcard.length - 1 == x ? $el[wildcard[x]] : $el[wildcard[x]]+'/';
                }

                if(typeof(ispopup) != 'undefined'){
                    $('#staticBackdrop .modal-dialog').removeClass('modal-xl modal-xxl modal-xxxl modal-lg');

                    if(typeof modalSize !== 'undefined'){
                        $('#staticBackdrop .modal-dialog').addClass("modal-"+modalSize);
                    } 
                    $('#staticBackdrop').modal('show');

                    $('#pop-div').load(url +'/'+ newWildcard);
                    // setTimeout(
                    //     function() 
                    //     {
                    //   $('#pop-div').load(url +'/'+ newWildcard);
                        
                    // }, cars[random]);

                } else if(typeof(tagetTYpe) != 'undefined'){
               
                    if(tagetTYpe != 'no-action'){
                        window.open(url +'/'+ newWildcard, '_blank');
                    } else {
                        return false;
                    }
                } else{
                    location.href = url +'/'+ newWildcard;
                }
            }

        } else {
            return false;
        }
       
    });

    /**
     * clone html elements 
     */
     $(document).on('click', '.clone-it', function (e) {
   

        var $this       = $(this),
            cloneID     = $this.data('clone'),
            cloneHtml   = $('#'+cloneID+'').html();


        var data_start  = $(this).data('start'),
            html        = "<tr>";
            if(typeof data_start !== 'undefined'){
               
                html        += cloneHtml.replace(/start/g,data_start).replace('<td></td>','');
            } else {
                html        += cloneHtml.replace('<td></td>','');
            }

            html        += "<td><button class='btn btn-danger deleteClone'>X</div>";
            html        +="</tr>";


            $(this).data('start',parseInt(data_start) + 1);

            $('#'+cloneID+'').parent().find('tr:last').after(html);

            $('#'+cloneID+'').parent().find('tr:last').find('input').each(function(e){
                $(this).val('');
                $(this).attr('name',$(this).data('name'));
            });


            $('#'+cloneID+'').parent().find('tr:last').find('select').each(function(e){
                if($(this).hasClass('multiple')){
                    $(this).parent().html('<select class="form-control required opt_opt multiple" multiple="multiple" name="'+  $(this).attr('name')+'" style="height:36px;width:100%"></select>');
                } 
               
            });

          
            
            return false;
    });

    /**
     * delete clone data
     */
    $(document).on('click', '.deleteClone', function (e) {
       
        if(typeof($(this).data('target')) !== 'undefined'){
            $(''+$(this).data('target')+'').html('');
        }
        $(this).parent().parent().remove();
    });


});

/**
 * validate form before submiting
 * @param object form 
 * return void 
 */
 function validation(form,scroll = true) {

    var error = false;
    $('.invalid-feedback').remove();
    var warMsg = '';
    var markerLists = '';
    $('.alert-msg').remove(); 
    form.find('input.required,select.required,textarea.required,file.required').each(function (e) {
        var $thiss = $(this);
        
        if ($thiss.val() == '') {
            error = true;
            warMsg = typeof $thiss.data('warn') != "undefined" ? $thiss.data('warn') : 'This is required field';
            
            if($thiss.hasClass('prenter-bkt')){
                $thiss.addClass('is-invalid');
                $thiss.next().after('<div class="invalid-feedback">'+warMsg+'</div>');
            } else if($thiss.hasClass('color-bkt')){
                $thiss.addClass('is-invalid');
                $thiss.parent().after('<div class="invalid-feedback">'+warMsg+'</div>');
            } else {
                $thiss.addClass('is-invalid').after('<div class="invalid-feedback">'+warMsg+'</div>');
            }
            
            if(scroll){
                window.scrollTo(0, 0);
            }
           
            if(typeof $thiss.data('mark') != "undefined" ){
                var marker = $('#'+$thiss.data('mark')+'-warning-mark').show();
            }
        } else {
            $thiss.removeClass('is-invalid');
        }
    });

    return error;

}
/**
 * handle ajax with images
 * @param {*} form 
 * @param {*} method 
 * @param {*} action 
 * @param {*} data 
 * return array
 */
function DataWithIMageHadler(form, method, action, data){

    var formData = new FormData(form[0]);
    var responses = '';
  
    return $.ajax({
        type: method, 
        url: action, 
        data: formData,
        contentType: false, 
        processData: false
    }).fail(function() {
        Swal.fire(
            'Oops!',
             'Something went wrong!',
            'error'
        );
    });

    
}


/**
 * handle ajax
 * @param {*} form 
 * @param string method 
 * @param string action 
 * @param string data 
 * return array
 */
function DataHadler(form, method, action, data){

    $('.alert-msg').remove(); 
    return $.ajax({
        type: method, 
        url: action, 
        data: data
    }).fail(function() {
        Swal.fire(
            'Oops!',
             'Something went wrong!',
            'error'
        );
    });
}

function clearForm(form){
    form.find('input.required,select.required,textarea.required,file.required').each(function (e) {
        var $thiss = $(this);
        $thiss.val('');
    });
}

function reloadSection(section){
    section.html('<center> <i class="fas fa-spinner fa-3x fa-spin"></i> <br>loading '+$(this).data('msg')+' please wait</center>');
    section.load(section.data('url'));
}



function fireLoading(msg = '',trans = 1){
     $('.modal-footer').hide();
     var message = msg == '' ? 'please wait' : msg;
     if(trans == 1){
        Swal.fire({
            title : message,
            showCancelButton: false,
            showConfirmButton: false,
         });
    
     } else {
        Swal.fire({
            showCancelButton: false,
            showConfirmButton: false,
            background: 'transparent',
         });
     }
     Swal.showLoading();
     
}

function killLoading(){
      
      Swal.close();
      $('.modal-footer').show();
}



function chatHeaderNoticationTemplate(){
    var html = '';
    html += '<li>';
        html += '<a href="url" class="list-group-item d-flex hide-show-toggler">';
            html += '<div class="flex-grow-1">';
                html += '<p class="mb-0 line-height-20 d-flex justify-content-between">sender_name</p>';
                html += '<div class="small text-muted">';
                    html += ' <span class="mr-2">time</span>';
                    html += '<span>body</span>';
                html += '</div>';
            html += '</div>';
        html += '</a>';
    html += '</li>';
    return html;
}

function chatboxTemplate($location = ''){
    var html = '';
    html += '<div class="message-item ">';
    html += '<div class="message-item-content">body</div>';
    html += '<p class="time small text-muted font-italic">time</span>';
    html += '</div>';
   
    var mediaDiv = '';
    mediaDiv += '<div class="message-item  message-media">';
    mediaDiv += '<img src="imgto" alt="image">';
    mediaDiv += '<span class="time small text-muted font-italic">time</span>';
    mediaDiv += '</div>';

    return $location == '' ? html : mediaDiv;
}



function GFG_Fun(str,obj) { 
    var html = str.replace(/imgto|sender_name|time|body|url/gi, function(matched){ 
        return obj[matched]; 
    }); 

    return html;
} 


/**
 * getTableSummary summary
 * @param object form 
 * return void
 */
function tableSummary(source_data) {

    var html = '',
        source = $('#'+source_data+'');
    
    if(source.hasClass('valueonly')){
        $('#'+source_data+'_summary').html(html);
        $('#'+source_data+'').find('tr').each(function(e){
           var  cleanUp = $(this).clone(true);
           cleanUp.find('td:last').remove();
           cleanUp.find('input').each(function(e){
                $(this).attr('disabled','disabled');
           });
           $('#'+source_data+'_summary').append(cleanUp);
        });
    } else {
        $('#'+source_data+'').find('tr').each(function(e){
            html += '<tr>';
            $(this).find('input,select').each(function(e){

                html += '<td>';
                html +=  !$(this).is("select") ? $(this).val() :$('option:selected', this).text();
                html += '</td>';
            });
            html += '</tr>';
        });
        $('#'+source_data+'_summary').html(html);
    }
   

}

/**
 * getFormSection summary
 * @param object form 
 * return void
 */
function getFormSection(source_data) {

    var html = '';
    $('#'+source_data+'').find('input.fetch,select.fetch,textarea.fetch').each(function(e){
                             
        var $this = $(this);

        $('#'+source_data+'_image').hide();

        if($this.is('select')){
            html += '<p>';
            html += $this.data('title')+' : '+$('option:selected',this).text();
            html += '</p>';
        } else if($this.is('input:file')){

            if($this.val() != ''){
                var file__ = $this[0].files[0],
                img_src    = '';
                
                var reader = new FileReader(); // instance of the FileReader


                reader.readAsDataURL(file__);

                reader.onload= function(){ // set image data as background of div

                    $('#'+source_data+'_image').attr('src',this.result).show();
                
                }
            }

        } else{
            html += '<p>';
            html += $this.data('title')+' : '+$this.val();
            html += '</p>';
        }
      
      
    });
  $('#'+source_data+'_summary').html(html);

}
function clearBtn($btn,$table){
    $(document).on('click', $btn, function (e) {
        var url = $(this).data('url');
        $(''+$table+'').bootstrapTable('refresh', {
            url: url
        });
        e.preventDefault();
    });
}
function search($btn,$table,$target,$loadpage = ''){
   
    $(document).on('click', $btn, function (e) {
       
        var source = $(''+$table+'').data('url'),
            checkQueryString = source.split('?'),
            queryFirstString = checkQueryString.length > 1 ? '&' : '?',
            html    = '';

        

        $(''+$target+'').find('input,select').each(function(e){
            var $this = $(this);
            if($this.val() != ''){
                html += html  == '' ? queryFirstString+$this.attr('name')+'='+$this.val() : '&'+$this.attr('name')+'='+$this.val();
            }
        })

        if($loadpage != ''){
            
                $(''+$loadpage+'').html('<center> <i class="fa fa-spinner fa-3x fa-spin"></i> <br>loading '+$(''+$loadpage+'').data('msg')+' please wait</center>');
                $(''+$loadpage+'').load($(''+$loadpage+'').data('source')+html);
           
        }
        

        $(''+$table+'').bootstrapTable('refresh', {
            url: source+html
        });
       

        e.preventDefault();
        

    });
}

/**
 * kill alert warning in 5secs
 */
function kill_alert(){
    setTimeout(function() {
        $(".alert-msg").remove();
      }, 5000);
}

/**
 * close dynamic modal
 */
function kill_modal(){
    $('#staticBackdrop').modal('hide');
}

/**
 * popup call function 
 */

 function popup(template,size = '',elem_to_focus = ''){
    
    
    $('#staticBackdrop .modal-dialog').removeClass('modal-xxl modal-xxxl modal-lg modal-xl');

    if(size != ''){
        $('#staticBackdrop .modal-dialog').addClass("modal-"+size);
           
    } 

    $('#pop-div').html('<center class="mt-3 mb-3"> <i class="fa fa-spinner fa-3x fa-spin"></i> <br>loading please wait</center>');
    $('#pop-div').load(template);

    if(elem_to_focus != ''){
         
        $('#staticBackdrop').modal('show').on('shown.bs.modal', function() {
            $(''+elem_to_focus+'').focus();
        });
    } else {
        $('#staticBackdrop').modal('show');
    }

   return false;
 
}
$(document).on('click', '.deleteBtn_', function (e) {

    Swal.fire({
        title: 'Warning',
        text: $(this).data('question'),
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        confirmButtonText: 'Ok',
        showLoaderOnConfirm: true,
        allowOutsideClick:false,
        allowEscapeKey:false

    }).then(($result) => {
        if($result['value']){
            fireLoading();
            var responce = DataHadler('', 'post', $(this).data('url'), {"id":""+$(this).data('id')+""}); 
                responce.done(function (response, textStatus, jqXHR) {
                    killLoading();
                    kill_modal();
                    
                    var source = $('#'+response.table+'').data('url');
                     $('#'+response.table+'').bootstrapTable('refresh', {
                            url: source
                    });
                    $('#'+response.table+'').parent().parent().parent().before('<div class="alert alert-success alert-msg">'+response.msg+'</div>');
                   
                    
                    kill_alert();
                });
        }
    });  

});

function scrollup(){
    window.scrollTo(0, 0);
}

search('.searchBtn','#list_table','#search__');
$(".select3").select2();


$(document).on('click', '.UpdatePasswordBtn',function(e) {

    var $this = $(this),
    form  = typeof $this.data('form')  === 'undefined' ? $this.closest('form') : $('#' + $this.data('form') + ''),
    action = form.attr('action'),
    method = form.attr('method').toLowerCase(),
    data   = form.serialize(),
    warningMsg = typeof form.data('error') === 'undefined' ? 'All red field are required' : form.data('error');
   
    if (validation(form,false)) { 
        form.prepend(errorDiv.replace('error',warningMsg));
    } else{ 
        fireLoading();
            var responce = DataHadler(form, method, action, data); 
            responce.done(function (response, textStatus, jqXHR) {
                    killLoading();
                    if(response.code == 300){
                        form.prepend(errorDiv.replace('error',response.msg ));
                    } else {
                        kill_modal();
                        Swal.fire({
                            title: 'Success',
                            text: response.msg,
                            type: 'success',
                            showCancelButton: false,
                            confirmButtonColor: '#f48031',
                            confirmButtonText: 'Ok',
                            showLoaderOnConfirm: true,
                            allowOutsideClick:false,
                            allowEscapeKey:false
                
                        }).then(($result) => {
                                window.location = response.url
                        }); 
                       
                    }
            });
        
    } 

    e.preventDefault();

});