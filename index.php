
<?php
// that empty spaces are used to fullfill the future needs of the code 
$name='';
$location='';
$id='';

$update=false;

$delete=false;
$record=false;
 

?>

<?php
// connecting to the database
  $servername="localhost";
  $username="root";
  $password="";
  $database="crud";
  $conn=mysqli_connect($servername,$username,$password,$database);  
   if(!$conn){
       die ('sorry we have failed to connect'.mysqli_connect_error());
   }
   ?>
   <!-- When we click on save button then data that we put add in the database  -->
   <?php
  if(isset($_POST['save'])){
     $id=$_POST['save'];
      $name=$_POST['name'];
      
 
     $location=$_POST['location'];
    //  $sql query is used to insert data in the database you can see the below command
      $sql="INSERT INTO `table1` ( `name`, `location`) VALUES ( '$name', '$location ')";
      $result=mysqli_query($conn,$sql);
      if($result){
        $record=true;
  }
  else{
      die ('sorry connection died').mysqli_error();
      
  }
}

  if(isset($_GET['delete'])){
//  if we write the id below then it will show an error because id has undefined identity yet  
    $id=$_GET['delete'];  
    $sql="  DELETE FROM `table1` WHERE `id` = $id";
    $result=mysqli_query($conn,$sql);
 if($result){
      $delete=true;
}
else{
    die ('sorry connection died').mysqli_error();
    
}

  }
//   when we click on the edit then there will be some digits on the form in the front end
  if(isset($_GET['edit'])){
   
    $id=$_GET['edit'];  
    $sql=" SELECT * FROM `table1` WHERE `id`= $id";
    $result=mysqli_query($conn,$sql);
     
        while($row=mysqli_fetch_assoc($result)){
         $name=$row['name'];
      
         $location=$row['location'];
         $update=true;
         
     }  



  }

//   it is used to up date the records 
  if(isset($_POST['update'])){
   
    $id=$_POST['id'];  
    $name=$_POST['name'];
    $location=$_POST['location'];
    
    $sql=" UPDATE `table1` SET `name` = '$name', `location` = '$location' WHERE `id` = $id  ";
    $result=mysqli_query($conn,$sql);
    if($result){
        $record=true; 
         
   }
   else{
       die ('sorry connection died').mysqli_error();
       
   }


  }
  
  

?>
<?php

if($delete){
    echo '  <div class="alert alert-warning alert-dismissible fade show" role="alert">
    <strong>Deleted!</strong> Your records has not been deleted successfully
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>  ';
}

if($record){
    echo '  <div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Updated!</strong> Your records has not been updated successfully
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>  ';
}




?>

<!doctype html>





<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>crud!</title>
    <style>
    .contaier {
        margin-top: 170px;
    }
    .container h1 {
        text-align: center;
        background-color: red;
        padding:25px 14px;
        
    }
    </style>
</head>

<body>
    <div class="container">
        <h1> My crud app</h1>
        <table class="table">
            <thead>
                <tr>
                    
                    <th scope="col"> NAME </th>
                    <th scope="col"> LOCATION</th>
                    <th scope="col">action</th>

                   

                </tr>
            </thead>
            <?php
              $sql="SELECT * FROM `table1`";
                      
              $result=mysqli_query($conn,$sql);

              while($row=mysqli_fetch_assoc($result)){
            
            echo '  
            <tbody>
             <tr>
                
                 <td>' .$row['name']. '</td>
                 <td> '.$row['location'].' </td>
                 <td> <a href="/crud/index.php?edit='.$row['id'].' "> 
                 <button type="button" class="btn btn-success">edit</button> </a>  </td>
                 <td> <a href="/crud/index.php?delete='.$row['id'].' "> 
                 <button type="button" class="btn btn-danger">delete</button> </a>  </td>
             </tr>
             <tr>
           
         </tbody>';}

         ?>
        </table>
    </div>


    <div class="container">

        <form action="/crud/index.php" method="POST">
            <div class="contaier">

                <div class="mb-3">

                    
                    <input type=" hidden" class="form-control"  name="id" value="<?php echo $id  ?>"> 

                    <div class="mb-3">
                        <label for="text" class="form-label">Name</label>
                        <input type="text" class="form-control" value="<?php echo $name;?> " name="name" id="name">
                    </div>
                    <div class="mb-3">
                        <label for="text" class="form-label">location</label>
                        <input type="text" class="form-control" value="<?php echo $location;?>  " name="location" id="name">
                    </div>
                    <?php
                     if($update==true){

                     
                       echo 
                       
                       ' <button type="submit" class="btn btn-primary" name="update">Update</button>';
                     }
                     else{
                         echo 
                         '<button type="submit" class="btn btn-primary" name="save">save</button>';
                     }
                     ?>


        </form>
    </div>
    </div>


    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
</body>

</html>