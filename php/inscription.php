<?php
try {
    $db = new PDO("mysql:host=localhost;dbname=campifrane2019", 'root', '');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
} catch (Exception $e) {
    echo "Base de données indisponible merci de contacter le Webmaster (Francis de Safi)";
    //die('Erreur : ' . $e->getMessage());
}


$nom = htmlspecialchars($_POST['name']);
$email = trim(htmlspecialchars($_POST['email']));
$ville = htmlspecialchars($_POST['town']);
$tel = htmlspecialchars((int) $_POST['phone']);
$nationalite=htmlspecialchars($_POST['nationality']);
$nombredeparticipation = htmlspecialchars((int) $_POST['nombredeparticipation']);
$dateinscription = date('Y-m-d H:i:s');

// variable d'�rreurs
$nom_err = NULL;
$ville_err = NULL;
$email_err = NULL;
$tel_err = NULL;
$nationalite_err = NULL;
$nombre_err = NULL;
$nbre_err=0;

// on v�rifie l'unicit� de l'adresse mail
$query = $db->prepare('SELECT COUNT(*) AS nbr_mail FROM Participants WHERE email =:semail');
$query->bindValue(':semail', $email, PDO::PARAM_STR);
$query->execute();
$email_libre = ($query->fetchColumn() == 0) ? 1 : 0;
$query->CloseCursor();

if (!$email_libre) {
    $email_err = "Cette adresse email est déjà utilisée par un autre utilisateur";
    $nbre_err++;//echo '<script>alert("1")</script>';
}
//On v�rifie la forme maintenant
if (!preg_match("#^[a-zA-Z0-9._-]+@[a-zA-Z0-9._-]{2,}\.[a-z]{2,4}$#", $email)) {
    $email_err = "Votre adresse Email n'a pas un format valide";
    $nbre_err++;//echo '<script>alert("2")</script>';
} else
if (empty($email)) {
    $email_err = "Vous n'avez pas entré d adresse mail";
    $nbre_err++;//echo '<script>alert("3")</script>';
}
//on v�rifie que les champs ne sont pas vides
if (empty($nom)) {
    $nom_err1 = "Vous n'avez pas entré de nom";
    $nbre_err++;//echo '<script>alert("4")</script>';
}
if (empty($ville) or $ville=="0") {
    $prenom_err1 = "Vous n'avez pas choisit de ville";
    $nbre_err++;//echo '<script>alert("5")</script>';
}
if (empty($nombredeparticipation) or ($nombredeparticipation<1 and $nombredeparticipation>7) ) {
    $prenom_err1 = "Votre nombre de participation est bizarre!";
    $nbre_err++; 
    //echo $nombredeparticipation;
    //echo '<script>alert("6")</script>';
}
if (empty($nationalite) or $nationalite=="0") {
    $prenom_err1 = "Vous n'avez pas choisit de pays";
    $nbre_err++;//echo '<script>alert("7")</script>';
}
$query = $db->prepare('SELECT COUNT(*) AS nbr_mail FROM Participants WHERE phone =:phone');
$query->bindValue(':phone', $tel, PDO::PARAM_STR);
$query->execute();
$tel_libre = ($query->fetchColumn() == 0) ? 1 : 0;
$query->CloseCursor();
if (!$tel_libre) {
    $tel_err = "Ce numéro de téléphone est déjà utilisée par un autre utilisateur";
    $nbre_err++;//echo '<script>alert("9")</script>';
}
if (empty($tel) or strlen((string)$tel)!=9) {
    $tel_err = "Votre numero de téléphone est bizarre!";
    $nbre_err++;//echo '<script>alert("8")</script>';
}

if ($nbre_err == 0) {


    //echo $datenaissance;
    //La ligne suivante sera comment�e plus bas
    //$nomavatar=(!empty($_FILES['avatar']['size']))?move_avatar($_FILES['avatar']):''; 

    $query = $db->prepare('
        INSERT INTO 
        participants(
        noms_et_prenoms,
        villes,
        email,
        phone,
        nombre_de_participation,
        date_inscription ,
        nationalite
        )
        VALUES
        (
        :noetpre, 
        :ville, 
        :email, 
        :phone, 
        :nbrdepart, 
        NOW(), 
        :nat
        )
        ');
    $tab = array(
        'noetpre' => utf8_encode($nom),
        'ville' => utf8_encode($ville),
        'email' => utf8_encode($email),
        'phone' => utf8_encode($tel),
        'nbrdepart' => utf8_encode($nombredeparticipation),
        'nat' => utf8_encode($nationalite),
        );
    $res = $query->execute($tab);
//echo'7';
    //var_dump($res);

    //recup�ration des donnees
    $reussi=$nbre_err.'&'."Bon camp $nom tu as bien été inscrit(e) :) ";
    
$chaine_err=$reussi;
} else {//var_dump($res);

    $reussi="";
    echo'<h1 class="alert alert-danger alert-dismissable"><b>Inscription interrompue</b></h1>';
    echo'<p class="alert alert-danger alert-dismissable">Une ou plusieurs erreurs se sont produites pendant l\'incription</p>';
    echo'<p class="alert alert-danger alert-dismissable">' . $nom_err . ' </p>';
    echo'<p class="alert alert-danger alert-dismissable">' . $ville_err . ' </p>';
    echo'<p class="alert alert-danger alert-dismissable">' . $email_err . ' </p>';
    echo'<p class="alert alert-danger alert-dismissable">' . $tel_err . ' </p>';
    echo'<p class="alert alert-danger alert-dismissable">' . $nationalite_err . ' </p>'; 
    //echo'<p>Cliquez <a href="./register.php">ici</a> pour recommencer</p>';
    $chaine_err = $nbre_err . '&' . $nom_err . '&' . $ville_err . '&' . $email_err . '&' . $tel_err . '&' . $nationalite_err . '&' .$reussi;
   
}
//$chaine_err=str_replace(' ','_',$chaine_err);
header("Location:../inscription.html?" . $chaine_err);
?>
