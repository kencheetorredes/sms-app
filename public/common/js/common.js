/*
Author: kenchee torredes
Email: kencheetorredes@gmail.com
File: js
*/

$.ajaxSetup({ 
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

var onTbale = true;
var errorDiv    = '<div class="alert-msg alert solid alert-danger">error</div>',
    successDiv  = '<div class="alert-msg alert solid alert-success">success-mg</div>',
    onloadpage  = $('.onloadpage');


$(function () { 

    search('.searchBtn','#list_table','#search__');

    $('.close_side_btn').click(function(e){
        $('.customizer').removeClass('show-service-panel');
        e.preventDefault();
    });

    $(document).on('change', '.get-geo',function(e) {
        var $this  = $(this), 
            val_   = $this.val(),
            url    = $this.data('url'),
            target = $this.data('target')
            name_ = $this.data('name');
           
        var responce = DataHadler('', 'get', url+'?id='+val_, {}); 
        fireLoading('',2);
        responce.done(function (response, textStatus, jqXHR) {
            if(typeof name_ !== 'undefined'){
                var html = '<option value="">Select '+name_+'</option>';
            } else {
                var html = '<option value=""></option>';
            }
            
            $.each(response, function(i, item) {
               html += '<option value="'+item.id+'">'+item.name+'</option>'
            });
            $(''+target+'').html(html);
            killLoading();
        });
    });

    /**
     * show passwword
     */
    
    $(document).on('click', '.showpasswordBtk',function(e) {
        var $this = $(this),
            show_ = $this.data('show'),
            target = $this.data('target');
        if(show_ == 0){
            $('input[name="'+target+'"]').attr('type','text');
            $this.data('show',1);
            $this.html('<i class="fas fa-eye-slash"></i>');
        } else {
            $('input[name="'+target+'"]').attr('type','password');
            $this.data('show',0);
            $this.html('<i class="fas fa-eye"></i>');
        }

    });

    /**
     * Basic Store and Update 
     */
    $(document).on('click', '.cuBtn',function(e) {

        var $this = $(this),
            form  = typeof $this.data('form')  === 'undefined' ? $this.closest('form') : $('#' + $this.data('form') + ''),
            action = form.attr('action'),
            method = form.attr('method').toLowerCase(),
            data   = form.serialize(),
            warningMsg = typeof form.data('error') === 'undefined' ? 'All red field are required' : form.data('error');
           
            $('.alert-msg').remove();  
            
            if (!validation(form,false)) { 
            
                fireLoading();
                var responce = DataWithIMageHadler(form, method, action, data); 
                    responce.done(function (response, textStatus, jqXHR) {
                        killLoading();
                        if(response.code == 300){
                            form.prepend(errorDiv.replace('error',response.msg ));
                            kill_alert();
                        } else {
                            if(response.code == 200){
                                kill_modal();
                                var source = $('#'+response.target+'').data('url');
                                $('#'+response.target+'').before('<div class="alert alert-success alert-msg"s>'+response.msg+'</div>');
                                $('#'+response.target+'').bootstrapTable('refresh', {
                                    url: source
                                });
                                kill_alert(); 
                            } else if(response.code == 201){
                               window.location.href = response.url;
                            } else if(response.code == 202){
                                kill_modal();
                                onloadpage.each(function(e){
                                    if(typeof $(this).data('nolod') === 'undefined'){
                                        $(this).html('<center> <i class="fa fa-spinner fa-3x fa-spin"></i> <br>loading '+$(this).data('msg')+' please wait</center>');
                                    }
                                    $(this).load($(this).data('url'));
                                }); 

                                if(typeof(response.target) !== 'undefined'){
                                    $(''+response.target+'').html(response.data)
                                }

                            } else if(response.code == 203){
                                form.prepend(successDiv.replace('success-mg',response.msg ));
                                kill_alert(); 
                            }
                            
                        }
                    }).fail(function (response, textStatus, jqXHR) {
                        killLoading();
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
                    });
               
            }
            e.preventDefault();
    });

            /**  * pop up js */ 
     
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

    /*** Image Preview */
    $(document).on('change', '.img_preview_load',function(e) {
    
        var file__ = $(this)[0].files[0],
            $this  =   $(this);
        
        var reader = new FileReader(); // instance of the FileReader
    
    
        reader.readAsDataURL(file__);
    
        reader.onload= function(){ // set image data as background of div
            $this.parent().parent().find('img').attr('src',this.result).show();
        
        }
    
    });


    /** load template  */
    if(typeof onloadpage  !== 'undefined'){
        onloadpage.each(function(e){
        if(typeof $(this).data('nolod') === 'undefined'){
            $(this).html('<center> <i class="fa fa-spinner fa-3x fa-spin"></i> <br>loading '+$(this).data('msg')+' please wait</center>');
        }
        $(this).load($(this).data('url'));
        }); 
    }

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
    }).fail(function(response) {
        if(response.status != 422){
            Swal.fire(
                'Oops!',
                 'Something went wrong!',
                'error'
            );
        }
       
    });;

    
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

function scrollup(){
    window.scrollTo(0, 0);
}