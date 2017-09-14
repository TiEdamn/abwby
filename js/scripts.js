$(document).ready(function(){
    $('.calc-btn').click(function(e){
        e.preventDefault();
        calc();
    });

    $('.ajax-calc-btn').click(function(e){
        e.preventDefault();
        $form = $(this).parents('.ajax-calc');

        $.ajax({
            type: "POST",
            url: $form.attr('action'),
            data: $form.serialize(),
            dataType: 'json',
            success: function(response){
                $('#result-ajax .cat-diam').text(response.cat_diam);
                $('#result-ajax .cat-width').text(response.cat_width);
                $('#result-ajax .cat-height').text(response.cat_height);
                $('#result-ajax .new-diam').text(response.new_diam);
                $('#result-ajax .new-width').text(response.new_width);
                $('#result-ajax .new-height').text(response.new_height);
                $('#result-ajax .real-speed').text(response.real_speed);
            }
        });
    });
});

function calc(){
    var cat_diam = Math.ceil(($('.cat-r').val() * 2.54 + ($('.cat-1').val() * $('.cat-2').val() / 1000) * 2) * 100) / 100;
    $('#result .cat-diam').text(cat_diam);

    var cat_width = Math.ceil($('.cat-1').val() / 10 * 100) / 100;
    $('#result .cat-width').text(cat_width);

    var cat_height = Math.ceil($('.cat-1').val() * $('.cat-2').val() / 1000 * 100) / 100;
    $('#result .cat-height').text(cat_height);

    var new_diam = Math.ceil(($('.new-r').val() * 2.54 + ($('.new-1').val() * $('.new-2').val() / 1000) * 2) * 100) / 100;
    $('#result .new-diam').text(new_diam);

    var new_width = Math.ceil($('.new-1').val() / 10 * 100) / 100;
    $('#result .new-width').text(new_width);

    var new_height = Math.ceil($('.new-1').val() * $('.new-2').val() / 1000 * 100) / 100;
    $('#result .new-height').text(new_height);

    var real_speed = Math.ceil(100 * new_diam / cat_diam) / 100;
    $('#result .real-speed').text(real_speed);
}