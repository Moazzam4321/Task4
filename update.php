<?php
// Anyone can access data through this api
 header('Access-Control-Allow-Origin:*');// * means not restrication for anyone else
 // return json data
 header('Content-Type:application/json');
 //Allow only put request
 header('Access-Control-Allow-Methods:Put');
 // Identify type of headers
 header('Access-Control-Allow-Headers:Content-Type,Access-Control-Allow-Headers,Authorization,X-Request-With');
 //remove warning when there is an error for inserting data
 error_reporting(0);
 // this function return data from postman into json object
 $data=json_decode(file_get_contents("php://input"));
   // Check request method
 //if($_SERVER['REQUEST_METHOD']== "Put" || $_SERVER['REQUEST_METHOD']== "Post")
  //{
    //Db connection
     require 'db.php';
     //Check product id for update values
     if($data->id)
     {
          //Query for fetch data against id
        $selectquery="SELECT * FROM inventory WHERE id=".$data->id;
          //execute query with database
        $connect=mysqli_query($db,$selectquery);
          //fetch all key present against id
        $product=mysqli_fetch_assoc($connect);
          //save table keys into varaibles for further processing
        $name=$product['name'];
        $quantity=$product['quantity'];
        $price=$product['price'];
        $catagory=$product['catagory'];
        // check post values are null or not
       if($data->name!="")
       {
           $name=$data->name;
        }
       if($data->quantity!="")
       {
          $quantity=$data->quantity;
       }
       if($data->price!="")
       {
           $price=$data->price;
        }
       if($data->catagory!="")
       {
          $catagory=$data->catagory;
        }
           //query for update data
        $updatequery="UPDATE inventory SET name='$name',quantity=$quantity,price=$price,catagory='$catagory' WHERE id=".$data->id;
        $run=mysqli_query($db,$updatequery);
           //check if product update succesful or not
        if($run)
           {
              echo json_encode(['status'=>'success','msg'=>'Product update successfuly']);
            } 
        else
           {
               echo json_encode(['status'=>'failed','msg'=>'Product not update']);
            }  
      } 
    // if id not found show error messege
     else
     {
      echo json_encode(['status'=>'failed','msg'=>'Productid not found']);
      }
  //}
 ?>