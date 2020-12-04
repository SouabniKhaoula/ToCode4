<?php
  $url = 'http://localhost/mywebservice/tocode4/RWS1/produit.php';
  $id = $_POST["id"];
  $lib = $_POST["lib"];
  $prix = $_POST["prix"];
  
	$data = array('id' => $id, 'lib' => $lib, 'prix' => $prix);

	$options = array(
		'http' => array(
			'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
			'method'  => 'POST',
			'content' => http_build_query($data)
		)
	);
	$context  = stream_context_create($options);
	$result = file_get_contents($url, false, $context);
	if ($result === FALSE) { /* Handle error */ }

	var_dump($result);
?>