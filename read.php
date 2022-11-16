<?php
// Anyone can access data through this api
 header('Access-Control-Allow-Origin:*');// * means not restrication for anyone else
 // return json data
 header('Content-Type:application/json');
 //Allow only get request
 header('Access-Control-Allow-Methods:GET');
 // Identify type of headers
 header('Access-Control-Allow-Headers:Content-Type,Access-Control-Allow-Headers,Authorization,X-Request-With');
 //remove warning when there is an error for inserting data
 error_reporting(0);
 // this function return data from postman into json object
 $data=json_decode(file_get_contents("php://input"));
 // Check request method
 if($_SERVER['REQUEST_METHOD']== "GET")
 {
    //Db connection   
   require 'db.php';
      // check product id existt or not
    if(isset($_GET['id']))
    {
        //query for read data against id
        $selectquery="SELECT * FROM inventory where id =".$_GET['id'];
      $run=mysqli_query($db,$selectquery);
      //function fetch_all return value save in db and assoc function return keys correspoding to each name
       $products=mysqli_fetch_all($run,MYSQLI_ASSOC);
      echo json_encode($products);
    }
    else
    {
          //query for read all data from database
        $selectquery="SELECT * FROM inventory";
        $run=mysqli_query($db,$selectquery);
          //function fetch_all return value save in db and assoc function return keys correspoding to each name
        $products=mysqli_fetch_all($run,MYSQLI_ASSOC);
        echo json_encode($products);
    }
  }    
?>