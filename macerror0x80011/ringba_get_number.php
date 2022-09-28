<?php



function ringba_get_pool_number($tags, $referer) {



    $queryString = explode("?", $referer)[1];
    $ringba_tags = render_tags($tags);
    $queryParams = render_query_paths($queryString);


    $js_tag_id = $tags['rb'];


    $epoch = time();
    $params = '{ JsTagId: "' . $js_tag_id . '", CurrentEpoch: ' . $epoch . ', Tags:[ {"type":"Request","referrer":"' . $referer . '"}' . $ringba_tags . '], QueryPaths: [' . $queryParams . ']}';

    $url = "http://display.ringba.com/v2/nis/gn/";

    $ch = curl_init() ;

    curl_setopt($ch,CURLOPT_URL, $url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
    curl_setopt($ch,CURLOPT_HEADER,0);
    curl_setopt($ch,CURLOPT_TIMEOUT,30);
    curl_setopt($ch,CURLOPT_FRESH_CONNECT, 1);

    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $params);

    $response = curl_exec($ch);
    curl_close($ch);

    $response = json_decode($response, true);

    return $response['displayNumber'];

}



function render_tags ($tags) {

    $output = "";
    if (count($tags) > 0) {
        $keys = array_keys($tags);
        for ($i = 0; $i < count($keys); ++$i) {
            $output .= ', {"type": "User", "'. $keys[$i] . '":"' . $tags[$keys[$i]] . '"}';
        }
    }
    return $output;

}

function render_query_paths ($queryString) {

    $output = "";
    $params = array();
    parse_str($queryString, $params);
    if (count($params) > 0) {
        $keys = array_keys($params);
        for ($i = 0; $i < count($keys); ++$i) {
            $output .= (($i > 0) ? ", " : "") . '{"key": "'. $keys[$i] . '", "value": "' . $params[$keys[$i]] . '"}';
        }
    }
    return $output;

}

function format_number_tfn ($phone_number) {

    // This function will format your phone number like: (nnn) nnn-nnnn - Example: (800) 123-4567

    ($phone_number[0] == '1' ? $phone_number = substr($phone_number, 1): '');
    $cleaned = preg_replace('/[^[:digit:]]/', '', $phone_number);
    preg_match('/(\d{3})(\d{3})(\d{4})/', $cleaned, $matches);
    return "+1-({$matches[1]})-{$matches[2]}-{$matches[3]}";

}


function format_number_local ($phone_number) {

    // This function will format your phone number like: nnn-nnn-nnnn - Example: 222-333-4444

    ($phone_number[0] == '1' ? $phone_number = substr($phone_number, 1): '');
    $cleaned = preg_replace('/[^[:digit:]]/', '', $phone_number);
    preg_match('/(\d{3})(\d{3})(\d{4})/', $cleaned, $matches);
    return "{$matches[1]}-{$matches[2]}-{$matches[3]}";

}

?>

