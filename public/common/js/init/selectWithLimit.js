//$(".select2").select2({dropdownParent: $('#staticBackdrop')});
$('.selectSearch').each(function() {
    $(this).select2({
        minimumInputLength: 3 ,
        minimumResultsForSearch: 20,
        dropdownParent: $(this).parent()
    });
})
//$(".select2").select2({dropdownParent: $('#staticBackdrop .modal-content')});