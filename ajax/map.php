<?php

if($_POST)
{
    $data = [];
    $result = [];
    $count = 0;
    foreach ($_POST['address'] as $address)
    {
        $response = json_decode(file_get_contents('https://geocode-maps.yandex.ru/1.x/?format=json&geocode='.$address));
        if($response->response->GeoObjectCollection->metaDataProperty->GeocoderResponseMetaData->found == 1)
        {
            $position = explode(' ', $response->response->GeoObjectCollection->featureMember[0]->GeoObject->Point->pos);
            $response_result = [
                'status'    => true,
                'text'      => $response->response->GeoObjectCollection->featureMember[0]->GeoObject->metaDataProperty->GeocoderMetaData->text,
                'lang'      => $position[0],
                'lat'       => $position[1],
            ];
            $count++;
        } else {
            $response_result = [
                'status'    => false,
            ];
        }
        array_push($data, $response_result);
    }
    $result['count'] = $count;
    $result['data'] = $data;
    echo json_encode($result);
} else {
    header("Location: /");
}