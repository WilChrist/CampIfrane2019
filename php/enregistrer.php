<?php
try {
    $db = new PDO("mysql:host=localhost;dbname=campifrane2019", 'root', '');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
} catch (Exception $e) {
    echo "Base de données indisponible merci de contacter le Webmaster (Francis de Safi)";
    //die('Erreur : ' . $e->getMessage());
}


$emailhid = htmlspecialchars($_POST['emailhid']);
if(isset($_POST['part0'])){$check=1;}else{$check=0;}
var_dump($check);

    $query = $db->prepare('
       UPDATE `participants` SET `frais_paye` = :check WHERE `participants`.`email` = :email;
        ');
    $tab = array(
        'email' => utf8_encode($emailhid),
        'check' => utf8_encode($check)
        );
    $res = $query->execute($tab);
    if($res==1){
        if($check==0){
            $reussi='0&'.$emailhid.' a bien été enregistrer comme n\'ayant pas payé' ;
        }else{
            $reussi='1&'.$emailhid.' a bien été enregistrer comme ayant payé' ;
        }
        $chaine_err=$reussi;
        header("Location:liste_personnes_ayant_payes.php?" . $chaine_err);
    }
else{
    echo 'une erreur s\'est produite veuillez ressayer et si l\'erreur persiste contacter Francis';
}
        

?>
