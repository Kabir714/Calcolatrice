<?php
error_reporting(0);

$numero1 = $_POST["a"];
$numero2 = $_POST["b"];
$operazione = $_POST["op"];

$risultato_finale = "";

if ($_POST["calcola"] == "SI") {
    
    if ($operazione == "somma") {
        $risultato_finale = $numero1 + $numero2;
    }
    
    if ($operazione == "differenza") {
        $risultato_finale = $numero1 - $numero2;
    }
    
    if ($operazione == "prodotto") {
        $risultato_finale = $numero1 * $numero2;
    }
    
    if ($operazione == "quoziente") {
        if ($numero2 == 0) {
            $risultato_finale = "ERRORE NON SI PUO DIVIDERE PER ZERO SCEMO!!";
        } else {
            $risultato_finale = $numero1 / $numero2;
        }
    }

    if ($_POST["assoluto"] == "on") {
        if ($risultato_finale < 0) {
            $risultato_finale = $risultato_finale * -1;
        }
    }
    
    if ($_POST["quadrato"] == "on") {
        $risultato_finale = $risultato_finale * $risultato_finale;
    }
    
    if ($_POST["arrotonda"] == "on") {
        $risultato_finale = round($risultato_finale, 2);
    }
}
?>

<html>
<head>
    <title>La mia prima calcolatrice</title>
</head>
<body bgcolor="#ccffff">

    <center>
        <h1><font color="red">CALCOLATRICE BELLISSIMA</font></h1>
    </center>

    <form method="POST">
        
        METTI IL PRIMO NUMERO: 
        <input type="text" name="a" value="<?php echo $numero1; ?>">
        <br><br>
        
        METTI IL SECONDO NUMERO: 
        <input type="text" name="b" value="<?php echo $numero2; ?>">
        <br><br>

        <b>CHE OPERAZIONE VUOI FARE???</b><br>
        <input type="radio" name="op" value="piu"> Somma (+)<br>
        <input type="radio" name="op" value="meno"> Sottrazione (-)<br>
        <input type="radio" name="op" value="per"> Moltiplicazione (X)<br>
        <input type="radio" name="op" value="diviso"> Divisione (/)<br>
        <br>

        <b>OPZIONI MAGICHE:</b><br>
        <input type="checkbox" name="assoluto"> Fallo diventare positivo<br>
        <input type="checkbox" name="quadrato"> Fai il quadrato<br>
        <input type="checkbox" name="arrotonda"> Arrotonda<br>
        <br><br>

        <input type="submit" name="calcola" value="SI">
        
    </form>

    <br>
    
    <h2>
        <font color="blue">
            <?php 
            if ($risultato_finale != "") {
                echo "IL RISULTATO E' ---> " . $risultato_finale; 
            }
            ?>
        </font>
    </h2>

</body>
</html>