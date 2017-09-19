<?php
include ('../classes/Auto.php');

if($_POST)
{
    $xml = simplexml_load_file('../xml/autoru.xml');
    $data = [];

    if((int) $_POST['start'] == 0) {
        $total = $xml->offers->offer->count();
        $import_date = date('Y-m-d H:i:s');
    } else {
        $total = (int) $_POST['total'];
        $import_date = $_POST['import_date'];
    }

    $limit = 200;
    $last = $_POST['start'] + $limit;

    if($last > $total)
        $last = $total;

    for ($i = (int) $_POST['start']; $i < $last; $i++){

        $auto = new Auto($xml->offers->offer[$i], $import_date);
        $auto->saveAuto();

        if($last == $total)
            $auto->removeAuto();
    }
    $response = [
        'total' => $total,
        'current' => $last,
        'import_date' => $import_date,
    ];

    echo json_encode($response);
} else {
    header("Location: /");
}