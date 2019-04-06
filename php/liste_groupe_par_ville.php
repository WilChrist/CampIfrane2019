<?php 
try {
    $db = new PDO("mysql:host=localhost;dbname=campifrane2019", 'root', '');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
} catch (Exception $e) {
    echo "Base de données indisponible merci de contacter le Webmaster (Francis de Safi)";
    //die('Erreur : ' . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    
    <!-- Bootstrap -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="information Camp d'Ifrane 2018">
    <meta name="author" content="Francis et Willy">
    <title>Bienvenue au camp d'Ifrane 2018 du GBUM</title>
    <!-- Bootstrap Core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../css/style.css" rel="stylesheet">
    <script type="text/javascript" src="../js/scripts.js"></script>
    <!-- Custom Fonts -->
    <link href="../font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="60" onload="changecolor(0)">

    <nav class="navbar navbar-inverse mainappcolor navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="../index.html"><img src="../images/logo.jpeg" alt="logo du GBUM" class="img-thumbnail"> </a>
            </div>
            <div id="navbar" class="collapse navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="index.html">Accueil</a></li>
                    <li><a href="inscription.html">Inscription</a></li>
                    <li><a href="evaluation.html">Evaluation Camp</a></li>
                    <li><a href="liste_participants.php">Liste participants</a></li>
                    <li><a href="apropos.html">à Propos</a></li>
                </ul>
            </div>
            <!--/.nav-collapse -->
        </div>
    </nav>

    <div class="container">
        <br><br><br>
        <center>
            <div class="jumbotron">

                <h2 class="alert alert-info oran">Listes des participants au camp déjà inscrits!</h2>

            </div>
            <p class="lead">Il se peut que certains ne soient pas encore inscrit:</p>
            <?php
                $rq=$db->prepare("SELECT noms_et_prenoms,villes FROM `participants` ORDER BY villes asc ");
                            $rq->execute();
                            //affichage des messages
                            $n=0;
                            while ($row = $rq->fetch()) {
                                $part[$n]=$row;
                                //var_dump($row);
                              $n++;
                            }
                            $n--;
                if($n<0){
                    echo '<h2>Il n\'y a pas encore de participant inscrit<h2>';
                }else{
                                echo '
                                <div class="table-responsive"> 
                                <table class="table table-bordered table-striped">  
                                    <thead>  
                                    <tr>  
                                    <th>N_°</th>
                                    <th>Noms et Prénoms</th>  
                                    <th>Villes</th>
                                    </tr>  
                                    </thead>
                                    <tbody>' ;
                    for($i=0;$i<=$n;$i++){
		                    	//if ($i==0) var_dump($messagesE[$i]);
		                     echo '<tr><td>'.
                                 ($i+1).'</td><td>'.
                                 utf8_decode($part[$i]['noms_et_prenoms']).'</td><td>'.
                                 utf8_decode($part[$i]['villes']).'</td><td>';
                    }
		                    echo '</tbody>  
								</table>
                                </div>';
                }
            ?>
        </center>
    </div>
    <!-- /.container -->

    <footer class="container-fluid text-center">
        <a href="#myPage" title="To Top">
            <span class="fa fa-chevron-up faws"></span>
        </a>
        <br>
        <a href="https://www.facebook.com/gbum" title="Groupe Facebook du GBUM">
            <i class="fa fa-facebook faws" aria-hidden="true">acebook</i>
        </a>
        <p>Projet réalisé avec Joie et Amour par les Gbussiens de Safi!</p>
    </footer>
    <script>
        $(document).ready(function() {
            // Add smooth scrolling to all links in navbar + footer link
            $(".navbar a, footer a[href='#myPage']").on('click', function(event) {

                // Make sure this.hash has a value before overriding default behavior
                if (this.hash !== "") {

                    // Prevent default anchor click behavior
                    event.preventDefault();

                    // Store hash
                    var hash = this.hash;

                    // Using jQuery's animate() method to add smooth page scroll
                    // The optional number (900) specifies the number of milliseconds it takes to scroll to the specified area
                    $('html, body').animate({
                        scrollTop: $(hash).offset().top
                    }, 900, function() {

                        // Add hash (#) to URL when done scrolling (default click behavior)
                        window.location.hash = hash;
                    });
                } // End if
            });
        })

    </script>
    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
</body>

</html>
