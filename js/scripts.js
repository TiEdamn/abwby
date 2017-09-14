$(document).ready(function(){
    $('.calc-btn').click(function(e){
        e.preventDefault();
        calc();
    });
});

function calc(){
    var cat_diam = Math.ceil(($('.cat-r').val() * 2.54 + ($('.cat-1').val() * $('.cat-2').val() / 1000) * 2) * 100) / 100;
    $('.cat-diam').text(cat_diam);

    var cat_width = Math.ceil($('.cat-1').val() / 10 * 100) / 100;
    $('.cat-width').text(cat_width);

    var cat_height = Math.ceil($('.cat-1').val() * $('.cat-2').val() / 1000 * 100) / 100;
    $('.cat-height').text(cat_height);

    var new_diam = Math.ceil(($('.new-r').val() * 2.54 + ($('.new-1').val() * $('.new-2').val() / 1000) * 2) * 100) / 100;
    $('.new-diam').text(new_diam);

    var new_width = Math.ceil($('.new-1').val() / 10 * 100) / 100;
    $('.new-width').text(new_width);

    var new_height = Math.ceil($('.new-1').val() * $('.new-2').val() / 1000 * 100) / 100;
    $('.new-height').text(new_height);

    var real_speed = Math.ceil(100 * new_diam / cat_diam) / 100;
    $('.real-speed').text(real_speed);
}