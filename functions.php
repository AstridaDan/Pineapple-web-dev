<?php 
    function displayData(){ //with pagination
        global $result;
        global $con;
        while($row = mysqli_fetch_array($result)){ ?>
            <tr>
                <td><?php echo $row['ID']; ?></td>
                <td><?php echo $row['email']; ?></td>
                <td><input name="chk_id[]" type="checkbox" class='chkbox' value="<?php echo $row['ID']; ?>" style="float:right;"/></td>
            </tr> <?php
        }
    }
    $result = mysqli_query($con, $sql);
  
    if(isset($_POST['submit'])){
        if(!empty($_POST['sortBy']) || !empty($_POST['searchF']) != "" || !empty($_POST['search']) != ""  ){
            //Fill SORT BY
            if(isset($_POST['sortBy'])) {
                $selected = $_POST['sortBy'];
                            
                if($selected == "name"){
                    $sql = "SELECT `ID`, `email` FROM `users` ORDER BY `email`"; 
                        
                }else{
                    $sql = "SELECT `ID`, `email` FROM `users` ORDER BY `ID`";
                }
                $result= $con->query($sql);
            }
            //Fill SEARCH
            if(!empty($_POST['search'])) {
                $str = mysqli_real_escape_string($con, $_POST['search']);
                $sql = "SELECT * FROM users WHERE email LIKE '%".$str."%'";
                $result= $con->query($sql);
            }
            //Fill FILTERS
            if(!empty($_POST['searchF'])) {
                $arr = array_values(array_unique($arr, SORT_REGULAR));
                $str = mysqli_real_escape_string($con, $_POST['searchF']);
                $query = "SELECT * FROM users WHERE email LIKE '%".$str."%'";
                $result = $con->query($query);
            }
            //Results
            if(mysqli_num_rows($result) > 0){
                displayData();
            }else{
                ?>
                    <tr>
                        <td>0</td>
                        <td>Records not found</td>
                        <td></td>
                    </tr>
                <?php
            }
        //if inputs are empty and button clicked
        }else{
            if(mysqli_num_rows($result) > 0) {
                displayData();
            }
        }
    //default view
    }else{
        if(mysqli_num_rows($result) > 0) {
            displayData();
        }
    }

?>
<script>
//Select all
    $(document).ready(function(){
        $('#select_all').on('click',function(){
            if(this.checked){
                $('.chkbox').each(function(){
                    this.checked = true;
                });
            }else{
                $('.chkbox').each(function(){
                    this.checked = false;
                });
            }
        });
        
        $('.chkbox').on('click',function(){
            if($('.chkbox:checked').length == $('.chkbox').length){
                $('#select_all').prop('checked',true);
            }else{
                $('#select_all').prop('checked',false);
            }
        });
    });
</script>