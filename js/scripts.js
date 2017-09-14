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

    var _template = '<div class="form-group"><input type="text" class="form-control" name="address[]" placeholder="Минск, пр-т Машерова 17" /><button class="btn btn-danger btn-delete">X</button></div>'

    $('.btn-add').click(function(e){
        e.preventDefault();
        $('.form-block').append(_template);
    });

    $('body').on('click', '.btn-delete', function(e){
        e.preventDefault();
        $(this).parent().remove();
    });

    ymaps.ready(init);

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

function init() {
    var myMap = new ymaps.Map("map", {
            center: [55.76, 37.64],
            zoom: 10
        }, {
            searchControlProvider: 'yandex#search'
        }),

    // Создаем геообъект с типом геометрии "Точка".
        myGeoObject = new ymaps.GeoObject({
            // Описание геометрии.
            geometry: {
                type: "Point",
                coordinates: [55.8, 37.8]
            },
            // Свойства.
            properties: {
                // Контент метки.
                iconContent: 'Я тащусь',
                hintContent: 'Ну давай уже тащи'
            }
        }, {
            // Опции.
            // Иконка метки будет растягиваться под размер ее содержимого.
            preset: 'islands#blackStretchyIcon',
            // Метку можно перемещать.
            draggable: true
        }),
        myPieChart = new ymaps.Placemark([
            55.847, 37.6
        ], {
            // Данные для построения диаграммы.
            data: [
                {weight: 8, color: '#0E4779'},
                {weight: 6, color: '#1E98FF'},
                {weight: 4, color: '#82CDFF'}
            ],
            iconCaption: "Диаграмма"
        }, {
            // Зададим произвольный макет метки.
            iconLayout: 'default#pieChart',
            // Радиус диаграммы в пикселях.
            iconPieChartRadius: 30,
            // Радиус центральной части макета.
            iconPieChartCoreRadius: 10,
            // Стиль заливки центральной части.
            iconPieChartCoreFillStyle: '#ffffff',
            // Cтиль линий-разделителей секторов и внешней обводки диаграммы.
            iconPieChartStrokeStyle: '#ffffff',
            // Ширина линий-разделителей секторов и внешней обводки диаграммы.
            iconPieChartStrokeWidth: 3,
            // Максимальная ширина подписи метки.
            iconPieChartCaptionMaxWidth: 200
        });

    myMap.geoObjects
        .add(myGeoObject)
        .add(myPieChart)
        .add(new ymaps.Placemark([55.684758, 37.738521], {
            balloonContent: 'цвет <strong>воды пляжа бонди</strong>'
        }, {
            preset: 'islands#icon',
            iconColor: '#0095b6'
        }))
        .add(new ymaps.Placemark([55.833436, 37.715175], {
            balloonContent: '<strong>серобуромалиновый</strong> цвет'
        }, {
            preset: 'islands#dotIcon',
            iconColor: '#735184'
        }))
        .add(new ymaps.Placemark([55.687086, 37.529789], {
            balloonContent: 'цвет <strong>влюбленной жабы</strong>'
        }, {
            preset: 'islands#circleIcon',
            iconColor: '#3caa3c'
        }))
        .add(new ymaps.Placemark([55.782392, 37.614924], {
            balloonContent: 'цвет <strong>детской неожиданности</strong>'
        }, {
            preset: 'islands#circleDotIcon',
            iconColor: 'yellow'
        }))
        .add(new ymaps.Placemark([55.642063, 37.656123], {
            balloonContent: 'цвет <strong>красный</strong>'
        }, {
            preset: 'islands#redSportIcon'
        }))
        .add(new ymaps.Placemark([55.826479, 37.487208], {
            balloonContent: 'цвет <strong>фэйсбука</strong>'
        }, {
            preset: 'islands#governmentCircleIcon',
            iconColor: '#3b5998'
        }))
        .add(new ymaps.Placemark([55.694843, 37.435023], {
            balloonContent: 'цвет <strong>носика Гены</strong>',
            iconCaption: 'Очень длиннный, но невероятно интересный текст'
        }, {
            preset: 'islands#greenDotIconWithCaption'
        }))
        .add(new ymaps.Placemark([55.790139, 37.814052], {
            balloonContent: 'цвет <strong>голубой</strong>',
            iconCaption: 'Очень длиннный, но невероятно интересный текст'
        }, {
            preset: 'islands#blueCircleDotIconWithCaption',
            iconCaptionMaxWidth: '50'
        }));
}