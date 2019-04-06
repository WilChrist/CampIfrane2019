<?php 
try {
    $db = new PDO("mysql:host=localhost;dbname=campifrane2018;", 'root', '',array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
} catch (Exception $e) {
    echo "Base de données indisponible merci de contacter le Webmaster (Francis de Safi)";
    //die('Erreur : ' . $e->getMessage());
}
$rq2=$db->prepare("UPDATE evaluation SET ville=:_ville, aimepas=:_aimepas, proposition=:_prop WHERE telephone=:_tel");
$rq=$db->prepare("SELECT * FROM `evaluation` ");
                            $rq->execute();

                            while ($row = $rq->fetch()) {
                              $newtel = "+212".$row['telephone'];
                              $data = array('_ville' => utf8_decode($row['ville']), '_aimepas'=>utf8_decode($row['aimepas']), '_prop'=> utf8_decode($row['proposition']),'_tel'=>$row['telephone']);
                                
                              if($row['telephone']!=0){
                                $rq2->execute($data);
                              }
                              	//$rq2->execute($data);
                              	//var_dump($row);
                            }
?>