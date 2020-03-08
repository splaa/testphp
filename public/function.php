<?php

$action = isset($_GET['action']) ? $_GET['action'] : null;

if (!is_null($action)) {
    $dbh = include __DIR__ . '/db.php';
    switch ($action) {
        case 'getCity':
            $region_id = isset($_POST['region_id']) ? $_POST['region_id'] : '';
            getCity($region_id, $dbh);
            break;
    }

}
function getCity($region_id, PDO $dbh)
{
    $json = ['key'];

   $data = queryDB($dbh);
    foreach ($data as $region) {
        $json= [$region['ter_name'] => $region['ter_pid'] ];
    }
//    $json[0]['region_type'] = 'test';
//    $json[0]['name'] = 'test';
//    $json[1]['region_type'] = 'test';
//    $json[1]['name'] = 'test';
//    $json[2]['region_type'] = 'test';
//    $json[2]['name'] = 'test';
//    $json[3]['region_type'] = 'test';
//    $json[3]['name'] = 'test';



    echo json_encode($json);
}

$action = isset($_GET['action']) ? $_GET['action'] : '';




function queryDB($dbh)
{

    $sth = $dbh->prepare('select t.ter_name, t.ter_id, t.ter_pid  from testphp.t_koatuu_tree t where t.ter_type_id=0 ;');


    $sth->execute();


    return $sth->fetchAll();
}
