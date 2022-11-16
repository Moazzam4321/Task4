n <?php
// Anyone can access data through this api
 header('Access-Control-Allow-Origin:*');// * means not restrication for anyone else
 // return json data
 header('Content-Type:application/json');
 //Allow only post request
 header('Access-Control-Allow-Methods:POST');
 // Identify type of headers
 header('Access-Control-Allow-Headers:Content-Type,Access-Control-Allow-Headers,Authorization,X-Request-With');
 //remove warning when there is an error for inserting data
 error_reporting(0);
 // this function return data from postman into json object
 $data=json_decode(file_get_contents("php://input"));
 //Db connection
 require 'db.php';
 //Check all keys are empty or not
 if($data->name=="")
   {
      echo json_encode(['status'=>'failed','msg'=>'name not found']);
    }
 elseif($data->quantity=="")
   {
      echo json_encode(['status'=>'failed','msg'=>'quantity not found']);
    }
 elseif($data->price=="")
   {
       echo json_encode(['status'=>'failed','msg'=>'price not found']);
    }
 elseif($data->catagory=="")
   {
       echo json_encode(['status'=>'failed','msg'=>'catagory not found']);
    }
  else
   {
    //Query for inserting data into database
     $insquery="INSERT INTO inventory(name,quantity,price,catagory)
             VALUES('$data->name','$data->quantity','$data->price','$data->catagory')";
       $run=mysqli_query($db,$insquery);
       //check if data insert suuccesfuly or not
       if($run)
       {
           echo json_encode(['status'=>'success','msg'=>'Product addedd']);
       } 
       else
       {
           echo json_encode(['status'=>'failed','msg'=>'Product not added']);
        }   
    }     
?>