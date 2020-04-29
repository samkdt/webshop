<?PHP
if (!isset($_GET['k'])) {
	echo "finns ej"; 
	exit;
}
?>
<html>
<head>
<meta charset="UTF-8">
</head>
<body>
<?PHP
$path= "../orders/kvitton/".$_GET['k'].".txt";
$string=file_get_contents($path);
$arr = explode("\n",$string);
foreach($arr as $val){
echo $val."<br>";
}
?>
</body>
</html>
