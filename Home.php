
<?php
session_start();

if(!isset($_SESSION['id_usuario'])){
    header("location: index.php");
    exit;
}
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Annie+Use+Your+Telescope&family=Handlee&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">

</head>
<title>Home</title>

<body>
    <div class="container">

        <h2><strong>HOME BEM VINDO ENTROU</strong></h2>
        <a href="singout.php">
        <input class="btn btn-primary" value="SINGOUT">

        </a>
      

    </div>


    

</body>

</html>