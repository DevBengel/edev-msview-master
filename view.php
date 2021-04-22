<?php
$url_sensor = 'http://10.42.0.101:9002/sensor';
$data = file_get_contents($url_sensor); 
$sensors = json_decode($data);
$list = array();
foreach ($sensors as $sensor) {
  $options = array(
    'http' => array(
      'method'  => 'GET',
      'header'=>  "Content-Type: application/json"
      )
  );
  $url_temp = 'http://10.42.0.101:9001/temp/'.$sensor->sensor_id;
  $context  = stream_context_create( $options );
  $result = file_get_contents( $url_temp, false, $context );
  $response = json_decode( $result );
  $formatted_datetime = date("H:i:s d.m.y", strtotime($response[0]->temp_timestamp));
  $list[] = array('sensor_id' => $sensor->sensor_id ,'sensor_name' => $sensor->sensor_name, 'temp_value' => $response[0]->temp_value, 'temp_timestamp' => $formatted_datetime, 'sensor_location' => $sensor->sensor_location);
}
echo json_encode($list); 
?>
