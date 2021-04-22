<?php 
 require_once('config.php');
 

 $con = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
 if(mysqli_connect_errno()) {
    echo 'Failed to connect to MySQL:<br />' . mysqli_connect_error();
 }
 $sql = ("SELECT * FROM users") or die("Error: " . mysqli_error($con));
 $result = $con->query( $sql );
 
 ?>
 
<!DOCTYPE html>
<html>
 <head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <title>Display data</title>
 </head>
 <body>

<br><br>
<div class="container">
    <h3 style="text-align: center; font-weight: bold;">PHP  FILTERS</h3>
    <br><br>
    <form action="storage.php" method="POST" class="row">
        <div class="row">
                <div class="col-lg-3">
                    <select class="form-control" name="sortBy" placeholder="Sort by..">
                        <option value="" disabled selected>Sort By</option>
                        <option value="name">Name</option>
                        <option value="data">Data</option>
                    </select>
                </div>

                <div class="col-lg-3">
                    <select name="searchF" class="form-control" >
                        <option value="" disabled selected >Filter</option>
                            <?php 
                            // get email adress only
                            $result = [];
                            $result = $con->query($sql); 
                            $arr = array();
                            foreach ($result as $sort){
                                $neww = (explode('@', $sort["email"], 3));
                                $sb = $neww[1];
                                if(!in_array($sb, $arr)){ ?>
                            <option value="@<?php echo $sb;?>">@<?php echo $sb;?></option>
                            <?php $arr[] = $sb;
                            }}?> 
                    </select>
                </div>
           
                <div class="col-lg-3">
                    <input type="text" class="form-control" name="search" placeholder="Search" value="">
                </div>
        
                <div class="col-lg-3">
                    <input type="submit" class="btn btn-primary form-control" name="submit" value="Submit">
                </div>
            </div>
            <?php require_once('delete.php'); ?>
            <br><br><br>
          
               
            <div class="row">
                <table class="table table-striped table-hover">
                <!-- RESULT TABLE -->
                    <thead>
                        <tr>
                            <th>ID</th>   
                            <th>Email</th>   
                            <th><input style="float: right;" type="checkbox" id="select_all" value=""/></th>        
                        </tr>
                    </thead>
                
                    <tbody>                     
                        <?php require_once('functions.php'); ?>
                    </tbody>
                
                </table>
                <div class="container">
                    <div class="row justify-content-end">
                   
                        <input id="submit" name="delete" type="submit" class="btn btn-danger col-2" value="Delete" />
                        <!-- <input name="csv" type="submit" class="btn btn-warning" value="Save selected as CSV" style="margin-bottom:100px;"/> -->
                    </div>
                    
                </div style="margin-bottom: 100px">
            </div>

        </form>
    </div>
</div>

</body>
</html>