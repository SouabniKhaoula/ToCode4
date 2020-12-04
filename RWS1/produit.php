<?php
	
	include("db.php");
	$request_method = $_SERVER["REQUEST_METHOD"];

	function getProduits()
	{
		global $conn;
		$query = "SELECT * FROM `produit`";
		$response = array();
		$result = mysqli_query($conn, $query);
		while($row = mysqli_fetch_array($result))
		{
			$response[] = $row;
		}
		header('Content-Type: application/json');
		echo json_encode($response, JSON_PRETTY_PRINT);
	}
	
	function getProduit($id=0)
	{   
		global $conn;
	
		if(id != 0)
		{
			$query="SELECT * FROM `produit` WHERE id=$id";
		}
		$response = array();
		$result = mysqli_query($conn, $query);
		while($row = mysqli_fetch_array($result))
		{
			$response[] = $row;
		}
		header('Content-Type: application/json');
		echo json_encode($response, JSON_PRETTY_PRINT);
	}
	
	function AddProduit()
	{
		global $conn;
		$id = $_POST["id"];
		$lib = $_POST["lib"];
		$prix = $_POST["prix"];
		
	
		echo $query="INSERT INTO produit VALUES(".$id.", '".$lib."',".$prix.")";
		if(mysqli_query($conn, $query))
		{
			$response=array(
				'status' => 1,
				'status_message' =>'Produit ajouté avec succès.'
			);
		}
		else
		{
			$response=array(
				'status' => 0,
				'status_message' =>'ERREUR!.'. mysqli_error($conn)
			);
		}
		header('Content-Type: application/json');
		echo json_encode($response);
	}
	
	
	switch($request_method)
	{
		
		case 'GET':
			if(!empty($_GET["id"]))
			{
				$id=$_GET['id'];
				getProduit($id);
			}
			else
			{
                getProduits();
            }
			
			break;
		default:
			header("HTTP/1.0 405 Method Not Allowed");
			break;
			
		case 'POST':
			AddProduit();
			break;
			

	}
?>