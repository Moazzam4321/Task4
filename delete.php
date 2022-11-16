<?php
// Anyone can access data through this api
 header('Access-Control-Allow-Origin:*');// * means not restrication for anyone else
 // return json data
 header('Content-Type:application/json');
 //Allow only delete request
 header('Access-Control-Allow-Methods:DELETE');
 // Identify type of headers
 header('Access-Control-Allow-Headers:Content-Type,Access-Control-Allow-Headers,Authorization,X-Request-With');
 //remove warning when there is an error for inserting data
 error_reporting(0);
 // this function return rawdata from postman into json form
 $data=json_decode(file_get_contents("php://input"));
 if($_SERVER['REQUEST_METHOD']== "Delete" ||$_SERVER['REQUEST_METHOD']== "POST"  )
 {
     //Db connection
     require 'db.php';
     // check product id exist or not
      if($data->id)
     {
           //query for fetch data against id for delete purpose
        $deletequery="DELETE FROM inventory WHERE id=".$data->id;
        $run=mysqli_query($db,$deletequery);
        //check if delete id or not
       if($run)
           {
              echo json_encode(['status'=>'success','msg'=>'Product deleted']);
            }
        else
           {
              echo json_encode(['status'=>'failed','msg'=>'Product not deleted']);
           } 
    } 
 else
   {
        echo json_encode(['status'=>'failed','msg'=>'Productid not found']);
    }
   }
 ?>