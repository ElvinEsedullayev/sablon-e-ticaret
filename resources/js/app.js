require('./bootstrap');
setTimeout(function() {
    $('.alert').slideUp(500);
}, 3000); //bualert mesajiningorunub sora yoxa cixmasi kodudu


$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
/*
$('.urun-adet-azalt, .urun-adet-artir').on('click', function() { //sepet sehifesinde yazdiq
    var id = $(this).attr('data-id');
    var adet = $(this).attr('data-adet');
    $.ajax({
        type: 'PATCH',
        url: '/sepet/guncelle/' + id,
        data: { adet: adet },
        success: function(result) {
            window.location.href = '/sepet';
        }
    });
});
*/