$('#large-photo').hide();

$('#large-photo').on('click', function (e) {
    $('.container').fadeTo(1000, 1);
    $('#large-photo').fadeOut();
    $("#large-photo").empty();
});

$('.photo-preview').on('click', function (e) {
    console.log(e);
    $('.container').fadeTo(1000, 0.5);
    $('#large-photo').fadeTo(1000, 1);
    var photo = $("#large-photo");
    var src = $(e.target).attr('src');
    $("#my_image").attr("src", src);
    $("#large-photo").empty();
    $("#large-photo").append(`<img src="${src}"></img>`);
    photo.css('top', (window.innerHeight - photo.height()) / 2);
    photo.css('left', (window.innerWidth - photo.width()) / 2);
})