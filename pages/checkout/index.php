<!DOCTYPE html>

<head>
    <title>Checkout</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="checkout.css" rel="stylesheet">
    <link href="../../styles.css" rel="stylesheet">
    <script src="../../script.js"></script> 

    <script>
        if (location.href=='http://localhost:9000/pages/checkout')
            location.href='../pages/checkout/index.php'
    </script>

</head>

<?php
  session_start();
  if (!isset($_SESSION['clientID'])) 
    header('Location: ../error/notlogged.php');
  $rest_id = $_GET["rest"];
  require_once('../../components/TopBar/index.php');
  require('../../components/SearchComponent/index.php');

  getTopBar("../../");  
?>

<div class="all">
    <div class="size_box">
          <div class="informations">
            <h3>Morada de envio</h3>
            <label for="fname"><i class="fa fa-user"></i> Nome</label>
            <input type="text" id="fname" name="firstname" placeholder="João Silva">
            <label for="email"><i class="fa fa-envelope"></i> Email</label>
            <input type="text" id="email" name="email" placeholder="joao@exemplo.com">
            <label for="adr"><i class="fa fa-address-card-o"></i> Morada</label>
            <input type="text" id="adr" name="address" placeholder="Rua das Flores">
            <label for="city"><i class="fa fa-institution"></i> Cidade</label>
            <input type="text" id="city" name="city" placeholder="Porto">
          </div>
        <label>
          <input type="checkbox" checked="checked" name="sameadr"> Morada de envio igual à de faturação
        </label>
        <a href="../creditCard/index.php?rest=<?php echo $rest_id; ?>" >
          <input type="submit" value="Efetuar pagamento" class="btn">
        </a>
  </div>
</div> 
