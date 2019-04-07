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
    <title>Participants au camp d'Ifrane 2019 du GBUM</title>
    <!-- Bootstrap Core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../css/style.css" rel="stylesheet">
    <script type="text/javascript" src="../js/scripts.js"></script>
    <!-- Custom Fonts -->
    <link href="../font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
   <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
     HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js"></script>

</head>

<body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="60" onload="changecolor(9)">

    <nav class="navbar navbar-inverse mainappcolor navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="../index.html"><img src="../images/logo.png" alt="logo du GBUM" class="img-thumbnail"> </a>
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

    <div class="container"  style="background-color:white;">
        <br><br><br>
        <center>
            <h1 class="alert alert-info oran">Statistiques de participation du camp d'Ifrane 2019!</h1>
        </center>
                <div class="row">
                    <div class="col-md-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">Répartition des Participants selon le Genre</div>
                            <div class="panel-body">
                                <canvas id="byGender" width="1600" height="900"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">Répartition des Participants selon leur adhésion au GBUM</div>
                            <div class="panel-body">
                                <canvas id="byAdhesion" width="1600" height="900"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">Répartition des Participants selon le nombre de Participation au camp d'Ifrane</div>
                            <div class="panel-body">
                                <canvas id="byParticipation" width="1600" height="900"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">Répartition des Participants selon la Nationalité</div>
                            <div class="panel-body">
                                <canvas id="byCountry" width="1600" height="900"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">Répartition des Participants selon la ville</div>
                            <div class="panel-body">
                                <canvas id="byCity" width="1600" height="900"></canvas>
                            </div>
                        </div>
                    </div>
                </div>   
        
    </div>
            

            <!-- Nombre de Participant par Genre -->
            <?php
                $labels='labels: []';
                $data='data: []';
                $rq=$db->prepare("SELECT DISTINCT sexe as genre, COUNT(sexe) as nombre FROM `evaluation` GROUP BY sexe ORDER BY sexe desc");
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
                    echo '<h2>Il n\'y a pas encore de données pour le moment<h2>';
                }else{
                    $labels= '[';
                    $data= '[';
                    for($i=0;$i<=$n;$i++){
		                    	//if ($i==0) var_dump($messagesE[$i]);
                             $labels.='"'. utf8_decode($part[$i]['genre']).'"';
                             $data.= utf8_decode($part[$i]['nombre']);
                             if($i!=$n){
                                $labels.= ',';
                                $data.= ',';
                             }
                    }
                    $labels.= ']';
                    $data.= ']';
                }
            ?>
            <script>
                var ctx = document.getElementById('byGender').getContext('2d');
                var byGender = new Chart(ctx, {
                    type: 'doughnut',
                    data: {
                        labels: <?php echo $labels ?>,
                        datasets: [{
                            label: 'Nombre de Participants par Genre',
                            data: <?php echo $data ?>,
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.6)',
                                'rgba(153, 102, 255, 0.6)',
                                'rgba(255, 159, 64, 0.6)'
                            ],
                            borderColor: [
                                'rgba(255, 99, 132, 1)',
                                'rgba(153, 102, 255, 1)',
                                'rgba(255, 159, 64, 1)'
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {}
                });
            </script>
            

            <!-- Nombre de Participant par Adhésion -->
            <?php
                $labels='labels: []';
                $data='data: []';
                $rq=$db->prepare("SELECT DISTINCT type_participant, COUNT(type_participant) as nombre FROM `evaluation` GROUP BY type_participant");
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
                    echo '<h2>Il n\'y a pas encore de données pour le moment<h2>';
                }else{
                    $labels= '[';
                    $data= '[';
                    for($i=0;$i<=$n;$i++){
		                    	//if ($i==0) var_dump($messagesE[$i]);
                             $labels.='"'. utf8_decode($part[$i]['type_participant']).'"';
                             $data.= utf8_decode($part[$i]['nombre']);
                             if($i!=$n){
                                $labels.= ',';
                                $data.= ',';
                             }
                    }
                    $labels.= ']';
                    $data.= ']';
                }
            ?>
            <script>
                var ctx = document.getElementById('byAdhesion').getContext('2d');
                var byAdhesion = new Chart(ctx, {
                    type: 'pie',
                    data: {
                        labels: <?php echo $labels ?>,
                        datasets: [{
                            label: 'Nombre de Participants selon leur adhésio au GBUM',
                            data: <?php echo $data ?>,
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.6)',
                                'rgba(54, 162, 235, 0.6)',
                                'rgba(75, 192, 192, 0.6)',
                                'rgba(153, 102, 255, 0.6)',
                                'rgba(255, 159, 64, 0.6)'
                            ],
                            borderColor: [
                                'rgba(255, 99, 132, 1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(153, 102, 255, 1)',
                                'rgba(255, 159, 64, 1)'
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {}
                });
            </script>
            

            <!-- Nombre de Participant par Participation -->
            <?php
                $labels='labels: []';
                $data='data: []';
                $rq=$db->prepare("SELECT DISTINCT nombre_de_participation, COUNT(nombre_de_participation) as nombre FROM `evaluation` GROUP BY nombre_de_participation");
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
                    echo '<h2>Il n\'y a pas encore de données pour le moment<h2>';
                }else{
                    $labels= '[';
                    $data= '[';
                    for($i=0;$i<=$n;$i++){
		                    	//if ($i==0) var_dump($messagesE[$i]);
                             $labels.='"'. utf8_decode($part[$i]['nombre_de_participation']).'"';
                             $data.= utf8_decode($part[$i]['nombre']);
                             if($i!=$n){
                                $labels.= ',';
                                $data.= ',';
                             }
                    }
                    $labels.= ']';
                    $data.= ']';
                }
            ?>
            <script>
                var ctx = document.getElementById('byParticipation').getContext('2d');
                var byParticipation = new Chart(ctx, {
                    type: 'pie',
                    data: {
                        labels: <?php echo $labels ?>,
                        datasets: [{
                            label: 'Nombre de Participants selon leur nombre de participation au camp d\'Ifrane',
                            data: <?php echo $data ?>,
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.6)',
                                'rgba(54, 162, 235, 0.6)',
                                'rgba(75, 192, 192, 0.6)',
                                'rgba(153, 102, 255, 0.6)',
                                'rgba(255, 159, 64, 0.6)'
                            ],
                            borderColor: [
                                'rgba(255, 99, 132, 1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(153, 102, 255, 1)',
                                'rgba(255, 159, 64, 1)'
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {}
                });
            </script>
            

            <!-- Nombre de Participant par Ville -->
            <?php
                $labels='labels: []';
                $data='data: []';
                $rq=$db->prepare("SELECT DISTINCT villes as ville, COUNT(email) as nombre FROM `participants` GROUP BY villes ORDER BY nombre desc");
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
                    echo '<h2>Il n\'y a pas encore de données pour le moment<h2>';
                }else{
                    $labels= '[';
                    $data= '[';
                    for($i=0;$i<=$n;$i++){
		                    	//if ($i==0) var_dump($messagesE[$i]);
                             $labels.='"'. utf8_decode($part[$i]['ville']).'"';
                             $data.= utf8_decode($part[$i]['nombre']);
                             if($i!=$n){
                                $labels.= ',';
                                $data.= ',';
                             }
                    }
                    $labels.= ']';
                    $data.= ']';
                }
            ?>
            <script>
                var ctx = document.getElementById('byCity').getContext('2d');
                var byCity = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: <?php echo $labels ?>,
                        datasets: [{
                            label: 'Nombre de Participants par ville',
                            data: <?php echo $data ?>,
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.6)',
                                'rgba(255, 99, 132, 0.4)',
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(54, 162, 235, 0.6)',
                                'rgba(54, 162, 235, 0.4)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(255, 206, 86, 0.6)',
                                'rgba(255, 206, 86, 0.4)',
                                'rgba(255, 206, 86, 0.2)',
                                'rgba(75, 192, 192, 0.6)',
                                'rgba(75, 192, 192, 0.4)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(153, 102, 255, 0.6)',
                                'rgba(153, 102, 255, 0.4)',
                                'rgba(153, 102, 255, 0.2)',
                                'rgba(255, 159, 64, 0.6)',
                                'rgba(255, 159, 64, 0.4)',
                                'rgba(255, 159, 64, 0.2)'
                            ],
                            borderColor: [
                                'rgba(255, 99, 132, 1)',
                                'rgba(255, 99, 132, 0.9)',
                                'rgba(255, 99, 132, 0.8)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(54, 162, 235, 0.9)',
                                'rgba(54, 162, 235, 0.8)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(255, 206, 86, 0.9)',
                                'rgba(255, 206, 86, 0.8)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(75, 192, 192, 0.9)',
                                'rgba(75, 192, 192, 0.8)',
                                'rgba(153, 102, 255, 1)',
                                'rgba(153, 102, 255, 0.9)',
                                'rgba(153, 102, 255, 0.8)',
                                'rgba(255, 159, 64, 1)',
                                'rgba(255, 159, 64,0.9)',
                                'rgba(255, 159, 64,0.8)'
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            yAxes: [{
                                stacked: true,
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                        }
                    }
                });
            </script>

            <!-- Nombre de Participant par Nationalité -->
            <?php
                $labels='labels: []';
                $data='data: []';
                $rq=$db->prepare("SELECT DISTINCT nationalite as 'nationalité', COUNT(email) as nombre FROM `participants` GROUP BY nationalite ORDER BY nombre desc");
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
                    echo '<h2>Il n\'y a pas encore de données pour le moment<h2>';
                }else{
                    $labels= '[';
                    $data= '[';
                    for($i=0;$i<=$n;$i++){
		                    	//if ($i==0) var_dump($messagesE[$i]);
                             $labels.='"'. utf8_decode($part[$i]['nationalité']).'"';
                             $data.= utf8_decode($part[$i]['nombre']);
                             if($i!=$n){
                                $labels.= ',';
                                $data.= ',';
                             }
                    }
                    $labels.= ']';
                    $data.= ']';
                }
            ?>
            <script>
                var ctx = document.getElementById('byCountry').getContext('2d');
                var byCountry = new Chart(ctx, {
                    type: 'horizontalBar',
                    data: {
                        labels: <?php echo $labels ?>,
                        datasets: [{
                            label: 'Nombre de Participants par Nationalité',
                            data: <?php echo $data ?>,
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.6)',
                                'rgba(255, 99, 132, 0.4)',
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(54, 162, 235, 0.6)',
                                'rgba(54, 162, 235, 0.4)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(255, 206, 86, 0.6)',
                                'rgba(255, 206, 86, 0.4)',
                                'rgba(255, 206, 86, 0.2)',
                                'rgba(75, 192, 192, 0.6)',
                                'rgba(75, 192, 192, 0.4)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(153, 102, 255, 0.6)',
                                'rgba(153, 102, 255, 0.4)',
                                'rgba(153, 102, 255, 0.2)',
                                'rgba(255, 159, 64, 0.6)',
                                'rgba(255, 159, 64, 0.4)',
                                'rgba(255, 159, 64, 0.2)'
                            ],
                            borderColor: [
                                'rgba(255, 99, 132, 1)',
                                'rgba(255, 99, 132, 0.9)',
                                'rgba(255, 99, 132, 0.8)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(54, 162, 235, 0.9)',
                                'rgba(54, 162, 235, 0.8)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(255, 206, 86, 0.9)',
                                'rgba(255, 206, 86, 0.8)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(75, 192, 192, 0.9)',
                                'rgba(75, 192, 192, 0.8)',
                                'rgba(153, 102, 255, 1)',
                                'rgba(153, 102, 255, 0.9)',
                                'rgba(153, 102, 255, 0.8)',
                                'rgba(255, 159, 64, 1)',
                                'rgba(255, 159, 64,0.9)',
                                'rgba(255, 159, 64,0.8)'
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                        }
                    }
                });
            </script>
            
            
    
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
    
    
    <!-- jQuery -->
    <script src="../js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../js/bootstrap.min.js"></script>

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
</body>

</html>
