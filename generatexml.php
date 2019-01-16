<?php

/** create XML file */

$mysqli = new mysqli("host", "username", "password", "db" );

/** check connection */
if ($mysqli->connect_errno) {

    echo "connect failed".$mysqli->connect_error;

    exit();
}

$query = "SELECT id, stack_name, stack_serialnumber FROM stack";

$stackarray = array();

if ($result = $mysqli->query($query)) {

    /* fetch associate array */
    while ($row = $result->fetch_assoc()) {
        array_push($stackarray, $row);
    }

    if(count($stackarray)){

        createXMLfile($stackarray);
    }

    /* free result set */
    $result->free();
}

/* close connection */
$mysqli->close();

function createXMLfile($stackarray){
    for($i=0; $i<count($stackarray); $i++){
        $filePath = "/root/stack" . $i . ".xml";
        $dom = new DOMDocument('1.0', 'utf-8');
        $root = $dom->createElement('REQUEST');
        $stackName    =  $stackarray[$i]['stack_name']; 
        $stackSERIAL      =  $stackarray[$i]['stack_serialnumber']; 
        $content = $dom->createElement('CONTENT');
        $device = $dom->createElement('DEVICE');
        $info = $dom->createElement('INFO');
        $name   = $dom->createElement('NAME', $stackName); 
        $info->appendChild($name);  
        $serial     = $dom->createElement('SERIAL', $stackSERIAL); 
        $info->appendChild($serial);
        $type     = $dom->createElement('TYPE', "NETWORKING"); 
        $info->appendChild($type);
        $device->appendChild($info);
        $root->appendChild($content);
        $module     = $dom->createElement('MODULEVERSION', "3.1");
        $content->appendChild($module);
        $process     = $dom->createElement('PROCESSNUMBER', "1");
        $content->appendChild($process);
        $content->appendChild($device);        
        $deviceid = $dom->createElement('DEVICEID', "foo");
        $root->appendChild($deviceid);
        $query     = $dom->createElement('QUERY', "SNMPQUERY");
        $root->appendChild($query);
        $dom->appendChild($root); 
        $dom->save($filePath);
    }
}