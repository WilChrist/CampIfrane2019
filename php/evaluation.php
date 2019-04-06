<?php
try {
    $db = new PDO("mysql:host=localhost;dbname=campifrane2019", 'root', '');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
} catch (Exception $e) {
    echo "Base de données indisponible merci de contacter le Webmaster (Francis de Safi)";
    //die('Erreur : ' . $e->getMessage());
}
//var_dump($_POST);
//les données obligatoires
$sexe=htmlspecialchars($_POST['sexe']);
$ville=htmlspecialchars($_POST['ville']);
$nbpart=htmlspecialchars($_POST['nbpart']);
$type=htmlspecialchars($_POST['type']);
$theme=htmlspecialchars($_POST['theme']);
$timing=htmlspecialchars($_POST['timing']);
$repos=htmlspecialchars($_POST['repos']);
$louange=htmlspecialchars($_POST['louange']);
$priere=htmlspecialchars($_POST['priere']);
$nourriture=htmlspecialchars($_POST['nourriture']);
$enseignement=htmlspecialchars($_POST['enseignement']);
$atelier=htmlspecialchars($_POST['atelier']);
$plateforme=htmlspecialchars($_POST['plateforme']);
//donnéesfacultatives
$engagement=htmlspecialchars($_POST['engagement']);
$aimepas=htmlspecialchars($_POST['aimepas']);
$proposition=htmlspecialchars($_POST['proposition']);
$projet=htmlspecialchars($_POST['projet']);
if(isset($_POST['organisation'])){$organisation=htmlspecialchars($_POST['organisation']);}
$comission=htmlspecialchars($_POST['comission']);
$email=trim(htmlspecialchars($_POST['email']));
$numero=htmlspecialchars($_POST['numero']);

$nberr=0;
$required_err=NULL;
$comission_err=NULL;
$email_err=NULL;
$numero_err=NULL;

//vérification des champs obligatoires
if(empty($sexe) || $ville=="0" || empty($nbpart) || empty($type) || empty($theme) || empty($timing) || empty($repos) || empty($louange) || empty($priere) || 
empty($nourriture) || empty($enseignement) || empty($atelier)){
	$nberr++;
	$required_err="vous devez remplir tous les champs obligatoire";
}

//vérification du choix de la comission si reponse positive pour la participation à l'organisation
if($organisation=="oui" && $comission=="0"){
	$nberr++;
		$comission_err="vous devez choisir une comission si vous voulez participez à l\'organisation du camp";
}

//verification de l'email 
if(!empty($email)){
	if(!preg_match("#^[a-zA-Z0-9._-]+@[a-zA-Z0-9._-]{2,}\.[a-z]{2,4}$#", $email)){
		$nberr++;
		$email_err="votre email est incorrecte";
	}
}

//verification du numéro de téléphone
if(!empty($numero)){
	if(!preg_match("#^[0-9]#",$numero) || strlen($numero)<9){
		$nberr++;
		$numero_err="votre numéro de télephone n'a pas un format correct";
	}
}

if($nberr>0){
	$chaine_err = $nberr . '&' . $required_err . '&' . $comission_err . '&' . $email_err . '&' . $numero_err;
}
else{
	$rq=$db->prepare("INSERT INTO evaluation VALUES(:sexe,:ville,:nbpart,:type,:theme,:timing,:repos,:louange,:priere,:nourriture,:ens,:atelier,:eng,
		:aimepas,:prop,:proj,:org,:com,:email,:numero,:plateforme)");

	$data= array('sexe' =>utf8_encode($sexe),'ville'=>utf8_encode($ville),'nbpart'=>utf8_encode($nbpart),'type'=>utf8_encode($type),'theme'=>utf8_encode($theme),'timing'=>utf8_encode($timing),'repos'=>utf8_encode($repos),'louange'=>utf8_encode($louange),'priere'=>utf8_encode($priere),'nourriture'=>utf8_encode($nourriture),'ens'=>utf8_encode($enseignement),'atelier'=>utf8_encode($atelier),'eng'=>utf8_encode($engagement),'aimepas'=>utf8_encode($aimepas),'prop'=>utf8_encode($proposition),'proj'=>utf8_encode($projet),'org'=>utf8_encode($organisation)
		,'com'=>utf8_encode($comission),'email'=>utf8_encode($email),'numero'=>utf8_encode($numero),'plateforme'=>$plateforme);

	$rq->execute($data);
	$chaine_err=$nberr.'&'."Merci pour votre contibution à l'amélioration des prochains camps";
}
//$chaine_err=str_replace(' ','_',$chaine_err);
header("Location:../evaluation.html?" . $chaine_err);
?>