<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Enkel test med tabell</title>
</head>
<table border="1">
<tr>
<th>Navn</th>
<th>Alder</th>
</tr>
<tr>
<?php $navn = "Kristoffer"; $alder = 22;?>
<td><?php echo $navn; ?></td>
<td><?php echo $alder; ?></td>
</tr>
</table>
<body>
</body>
</html>