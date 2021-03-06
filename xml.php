<?
/*$max = 2;
$xml = simplexml_load_file('xml/autoru2.xml');
for ($i = 0; $i < $xml->offers->offer->count(); $i++){
    echo $i.' '.$xml->offers->offer[$i]->url;
    echo date('Y-m-d H:i:s', strtotime($xml->offers->offer[$i]->date));
    echo $xml->offers->offer[$i]->sell-city;
    echo "<br/>";
    echo $i.' '.$xml->offers->offer[$i]->image[0];
    echo "<br/>";
}*/
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Starter Template for Bootstrap</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>

<nav class="navbar navbar-inverse">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/">Project name</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li ><a href="/">Home</a></li>
                <li ><a href="/calc.html">Calc</a></li>
                <li ><a href="/map.html">Map</a></li>
                <li class=active><a href="/xml.php">XML</a></li>
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</nav>
<div class="container">

    <div class="row">
        <div class="col-md-12 text-center">
            <h2>Выгрузка данных из XML</h2>
            <p class="lead">Файл autoru.xml должен быть загружен через ftp в папку xml (xml/autoru.xml)</p>
            <button class="btn btn-success btn-lg btn-import"><span class="glyphicon glyphicon-repeat" aria-hidden="true"></span> Импорт</button>
            <p id="result" class="hidden">Обработано <span class="count"></span> из <span class="total"></span></p>
        </div>
        <div class="col-md-12"></div>
    </div>

</div><!-- /.container -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="//api-maps.yandex.ru/2.1/?lang=ru_RU" type="text/javascript"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/scripts.js"></script>
</body>
</html>