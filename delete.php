<?php 
    if(isset($_POST['delete'])){
        if(isset($_POST['chk_id'])){
            $arr = $_POST['chk_id'];
            
            foreach ($arr as $id) {
                $result = mysqli_query($con,"DELETE FROM users WHERE ID = " . $id);
            }
           //header("Location: storage.php");
            echo "Deleted successfully";
        }else{
            echo "Mark at leat one checkbox";
            
        }
    }
?>