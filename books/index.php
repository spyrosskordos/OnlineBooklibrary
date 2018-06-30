<?php
include("DB.php");
 $db = new dbObj();
 $connection =  $db->getConnstring();//with dbObj we call the getConnstring function which returns the databse connection

 $request_method=$_SERVER["REQUEST_METHOD"];

switch($request_method)
	{
		case 'GET'://GET situation for searching  books

        getbook();


			break;
    case 'POST'://POST situation for saving books
    // Insert Product
        insertbook();
      break;
		default:
			// Invalid Request Method
			header("HTTP/1.0 405 Method Not Allowed");
			break;



	}



 function getbook(){
   global $connection;
		if(isset($_GET['keyword'])){//to check if keyword is set
			$keyword = $_GET['keyword'];
			$query = "SELECT * FROM books WHERE title LIKE '%" .$keyword. "%'";
		}

    $response;
    $result=mysqli_query($connection, $query);
    while($row=mysqli_fetch_assoc($result))//to save the respone into array
    {
      $response[]=$row;
    }
    header('Content-Type: application/json');
    echo json_encode($response);
	}

  function insertbook()
  	{
  		global $connection;

  		$data = json_decode(file_get_contents('php://input'), true);
  		$author=$data["author"];
  		$title=$data["title"];
  		$genre=$data["genre"];
    	$price=$data["price"];
  	 $query="INSERT INTO books SET author='".$author."', title='".$title."', genre='".$genre."', price='".$price."'";
  		if(mysqli_query($connection, $query))
  		{
  			$response="Book Added Successfully";

  		}
  		else
  		{
  			$response="Book Addition Failed";
  		}
  		header('Content-Type: application/json');
  		echo json_encode($response);
  	}


?>
