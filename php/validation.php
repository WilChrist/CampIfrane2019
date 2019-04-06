<?php
try {
    $db = new PDO("mysql:host=localhost;dbname=campifrane2019", 'root', '');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
} catch (Exception $e) {
    echo "Base de données indisponible merci de contacter le Webmaster (Francis de Safi)";
    //die('Erreur : ' . $e->getMessage());
}


$nom = htmlspecialchars($_POST['name']);
$email = htmlspecialchars($_POST['email']);
$ville = htmlspecialchars($_POST['town']);
$tel = htmlspecialchars((int) $_POST['phone']);
$nationalite=htmlspecialchars($_POST['nationality']);
$nombre_de_participation = htmlspecialchars((int) $_POST['nombredeparticipation']);
$dateinscription = date('Y-m-d H:i:s');

// variable d'�rreurs
$nom_err1 = NULL;
$ville_err1 = NULL;
$email_err = NULL;
$tel_err = NULL;
$nationalite_err1 = NULL;
$nombre_err = NULL;

// on v�rifie l'unicit� de l'adresse mail
$query = $db->prepare('SELECT COUNT(*) AS nbr_mail FROM Utilisateur WHERE email =:semail');
$query->bindValue(':semail', $email, PDO::PARAM_STR);
$query->execute();
$email_libre = ($query->fetchColumn() == 0) ? 1 : 0;
$query->CloseCursor();

if (!$email_libre) {
    $email_err1 = "Cette adresse email est déjà utilisée par un utilisateur";
    $nbre_err++;
}
//On v�rifie la forme maintenant
if (!preg_match("#^[a-zA-Z0-9._-]+@[a-zA-Z0-9._-]{2,}\.[a-z]{2,4}$#", $email)) {
    $email_err = "Votre adresse E-Mail n'a pas un format valide";
    $nbre_err++;
} else
if (empty($email)) {
    $email_err = "Vous n'avez pas entrer d'adresse mail";
    $nbre_err++;
}
//on v�rifie que les champs ne sont pas vides
if (empty($nom)) {
    $nom_err1 = "Vous n'avez pas entrer de nom";
    $nbre_err++;
}
if (empty($ville) or $ville=="0") {
    $prenom_err1 = "Vous n'avez pas choisit de ville";
    $nbre_err++;
}
if (empty($nombredeparticipation) or $nombredeparticipation<1 or $nombredeparticipation>7 ) {
    $prenom_err1 = "Votre nombre de participation est bizarre!";
    $nbre_err++;
}
if (empty($nationalite) or $nationalite=="0") {
    $prenom_err1 = "Vous n'avez pas choisit de pays";
    $nbre_err++;
}
if (empty($tel) or strlen((string)$tel)!=9) {
    $prenom_err1 = "Votre numéro de téléphone est bizarre!";
    $nbre_err++;
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
        'noetpre' => $nom,
        'ville' => $ville,
        'email' => $email,
        'phone' => $tel,
        'nbrdepart' => $nombre_de_participation,
        'nat' => $nationalite,
        );
    $res = $query->execute($tab);

    //echo $res;

    //recup�ration des donnees
    $reussi='<p class="alert alert-success "> Bon camp '.$nom.' tu as bien été inscrit(e) :) !<p>';

} else {
    echo'<h1 class="alert alert-danger alert-dismissable"><b>Inscription interrompue</b></h1>';
    echo'<p class="alert alert-danger alert-dismissable">Une ou plusieurs erreurs se sont produites pendant l\'incription</p>';
    echo'<p class="alert alert-danger alert-dismissable">' . $nom_err1 . ' </p>';
    echo'<p class="alert alert-danger alert-dismissable">' . $ville_err1 . ' </p>';
    echo'<p class="alert alert-danger alert-dismissable">' . $email_err . ' </p>';
    echo'<p class="alert alert-danger alert-dismissable">' . $tel_err . ' </p>';
    echo'<p class="alert alert-danger alert-dismissable">' . $nationalite_err1 . ' </p>'; 
    //echo'<p>Cliquez <a href="./register.php">ici</a> pour recommencer</p>';
    $chaine_err = $nbre_err . '&' . $nom_err . '&' . $ville_err . '&' . $email_err . '&' . $tel_err . '&' . $nationalite_err . '&' .$reussi;
    header("Location:inscription.html?" . $chaine_err);
}
?>
