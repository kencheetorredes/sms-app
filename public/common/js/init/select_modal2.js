//$(".select2").select2({dropdownParent: $('#staticBackdrop')});
$('.select2').each(function() {
    $(this).select2({
        dropdownParent: $(this).parent()
    });
})
//$(".select2").select2({dropdownParent: $('#staticBackdrop .modal-content')});