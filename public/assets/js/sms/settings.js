
            $('table').bootstrapTable();
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