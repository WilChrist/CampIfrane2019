<?php 
try {
    $db = new PDO("mysql:host=localhost;dbname=campifrane2018;", 'root', '',array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
} catch (Exception $e) {
    echo "Base de données indisponible merci de contacter le Webmaster (Francis de Safi)";
    //die('Erreur : ' . $e->getMessage());
}
$rq2=$db->prepare("UPDATE participants SET noms_et_prenoms=:nom, villes=:ville, nationalite=:nat WHERE id=:_id");
$rq=$db->prepare("SELECT * FROM `participants` ");
                            $rq->execute();

                            while ($row = $rq->fetch()) {
                              $data = array('nom' => utf8_decode($row['noms_et_prenoms']), 'ville'=>utf8_decode($row['villes']), 'nat'=> utf8_decode($row['nationalite']),'_id'=>$row['id']);
                                //var_dump($data);
                              	$rq2->execute($data);
                              	//var_dump($row);
                            }
?>