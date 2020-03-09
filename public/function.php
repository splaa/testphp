<?php
$dbh = new \PDO('mysql:host=localhost;dbname=testphp;charset=utf8', 'splaa', 'splaa1977');


$action = isset($_GET['action']) ? $_GET['action'] : null;


function getRegion()
{
    global $dbh;
    $regions = [];

    $data = queryDB($dbh);
    foreach ($data as $region) {
        $regions[] = [
            'ter_pid' => $region['ter_id'],
            'ter_name' => $region['ter_name'],
        ];
    }

    return $regions;

}


function getCity($region_id)
{
    global $dbh;
    $json = [];


    $data = queryDBCity($dbh, $region_id);


    foreach ($data as $region) {
        $json[] = [
            'ter_pid' => $region['ter_id'],
            'ter_name' => $region['ter_name']
        ];
    }

    echo json_encode($json);
}

function getArea($region_id)
{
    global $dbh;
    $json = [];


    $data = queryDBCity($dbh, $region_id);


    foreach ($data as $region) {
        $json[] = [
            'ter_pid' => $region['ter_id'],
            'ter_name' => $region['ter_name']
        ];
    }

    echo json_encode($json);
}


function queryDB($dbh)
{

    $sth = $dbh->prepare('select t.ter_name, t.ter_id, t.ter_pid  from testphp.t_koatuu_tree t where t.ter_type_id=0 ;');


    $sth->execute();


    return $sth->fetchAll();
}

function queryDBCity($dbh, $region_id)
{
    $sth = $dbh->prepare('select t.ter_name, t.ter_id, t.ter_pid  
from testphp.t_koatuu_tree t 
where ter_id= ' . $region_id . ' or ter_pid=' . $region_id . ' ;');

    $sth->execute();
    return $sth->fetchAll();
}

function queryDBArea($dbh, $region_id)
{
    $sth = $dbh->prepare('select t.ter_name, t.ter_id, t.ter_pid  
from testphp.t_koatuu_tree t 
where t.ter_type_id=2 
  and ter_id= ' . $region_id . ' or ter_pid=' . $region_id . ' ;');

    $sth->execute();
    return $sth->fetchAll();
}


if (!is_null($action)) {
    switch ($action) {
        case 'getRegion':
            getRegion();
            break;
        case 'getCity':
            $region_id = isset($_GET['ter_id']) ? $_GET['ter_id'] : '';
            getCity($region_id);
            break;
        case 'getArea':
            $city_id = isset($_GET['ter_id']) ? $_GET['ter_id'] : '';
            getArea($city_id);
            break;

    }

}


function insertDbUser($post)
{

   if(!isMailExists($post['email'])) {

       global $dbh;
       $fio = isset($post['fio']) && !is_null($post['fio']) ? $post['fio'] : '';
       $email = isset($post['email']) && !is_null($post['email']) ? $post['email'] : '';

       $region_id = isset($post['region_id']) && !is_null($post['region_id']) ? $post['region_id'] : '';
       $city_id = isset($post['city']) && !is_null($post['city']) ? $post['city'] : '';
       $area = isset($post['area']) && !is_null($post['area']) ? $post['area'] : '';

       $territory = json_encode(
           [
               'region_id' => $region_id,
               'city_id' => $city_id,
               'area' => $area
           ]);


       $sql = "INSERT INTO user(name, email, territory, territory_json) VALUES (?,?,?,?)";
       $stmt = $dbh->prepare($sql);
       $stmt->execute([$fio, $email, $territory, $territory]);
   } else {

       $user = showModalCard(getUserByEmail($post['email']));

   }

}
function showModalCard($user){
    return $user;

}
function getUserByEmail($email)
{
    global $dbh;
    $sth = $dbh->prepare('select u.*  from testphp.user u where u.email= ? ;');
    $sth->execute([$email]);

    return $sth->fetch();
}

function isMailExists($mail)
{
    global $dbh;
    $res = $dbh->query('select count(u.email)  from testphp.user u where email= \''.$mail.'\'');
    return $res->fetchColumn()>0 ? true : false;
}


