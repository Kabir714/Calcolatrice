<?php
$a   = $_POST["a"] ?? "";
$b   = $_POST["b"] ?? "";
$op  = $_POST["op"] ?? "";
$opz = (array) ($_POST["opz"] ?? []);
$out = "";
 
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $x = str_replace(",", ".", trim($a));
    $y = str_replace(",", ".", trim($b));
 
    if (!is_numeric($x) || !is_numeric($y)) {
        $out = "Errore: inserisci due numeri validi.";
    } elseif (!in_array($op, ["somma", "differenza", "prodotto", "quoziente"])) {
        $out = "Errore: seleziona un'operazione.";
    } elseif ($op === "quoziente" && $y == 0) {
        $out = "Errore: non si può dividere per zero.";
    } else {
        $r = match ($op) {
            "somma"      => $x + $y,
            "differenza" => $x - $y,
            "prodotto"   => $x * $y,
            "quoziente"  => $x / $y,
        };
 
        if (in_array("assoluto", $opz))  $r = abs($r);
        if (in_array("quadrato", $opz))  $r = $r ** 2;
        if (in_array("arrotonda", $opz)) $r = round($r, 2);
 
        $out = "Risultato: $r";
    }
}
 
// restituisce "checked" se la condizione è vera
function chk($cond) { return $cond ? "checked" : ""; }
?>
<!DOCTYPE html>
<html lang="it">
<head>
  <meta charset="UTF-8">
  <title>Calcolatrice</title>
</head>
<body>
<h1>Calcolatrice</h1>
 
<form method="post">
  a: <input type="text" name="a" value="<?= htmlspecialchars($a) ?>"><br>
  b: <input type="text" name="b" value="<?= htmlspecialchars($b) ?>"><br><br>
 
  <fieldset>
    <legend>Operazione</legend>
    <label><input type="radio" name="op" value="somma" <?= chk($op === "somma") ?>> somma</label><br>
    <label><input type="radio" name="op" value="differenza" <?= chk($op === "differenza") ?>> differenza</label><br>
    <label><input type="radio" name="op" value="prodotto" <?= chk($op === "prodotto") ?>> prodotto</label><br>
    <label><input type="radio" name="op" value="quoziente" <?= chk($op === "quoziente") ?>> quoziente</label>
  </fieldset><br>
 
  <fieldset>
    <legend>Opzioni</legend>
    <label><input type="checkbox" name="opz[]" value="assoluto" <?= chk(in_array("assoluto", $opz)) ?>> valore assoluto</label><br>
    <label><input type="checkbox" name="opz[]" value="quadrato" <?= chk(in_array("quadrato", $opz)) ?>> quadrato</label><br>
    <label><input type="checkbox" name="opz[]" value="arrotonda" <?= chk(in_array("arrotonda", $opz)) ?>> arrotonda a 2 decimali</label>
  </fieldset><br>
 
  <button type="submit">Calcola</button>
</form>
 
<p><?= htmlspecialchars($out) ?></p>
</body>
</html>
