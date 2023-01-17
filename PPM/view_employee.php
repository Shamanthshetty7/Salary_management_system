<?php 
    session_start();
    include 'db_connect.php'; 
    $id = $_GET['id'];
    if(!empty($id)){
        $query = "SELECT e.*,d.DNAME as dname,p.PNAME as pname FROM employee e inner join department d on e.DEPT_ID = d.DEPT_ID inner join position p on e.POSITION_ID = p.POS_ID where e.EMP_ID = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $emp = $result->fetch_array();
        if($result->num_rows > 0){
            $_SESSION['employee_data'] = $emp;
            foreach($emp as $k=>$v){
                $$k=$v;
            }
        }else{
            echo "No employee found";
        }
    }else{
        echo "Invalid employee id";
    }
?>
<div class="container-fluid">
    <div class="col-md-12">
        <h5><b><small>Employee ID :</small><?php echo $EMPLOYEE_NO ?></b></h5>
        <h4><b><small>Name: </small><?php echo ucwords($LASTNAME.", ".$FIRSTNAME." ") ?></b></h4>
        <p><b>    Department : <?php echo ucwords($dname) ?></b></p>
        <p><b>   Position : <?php echo ucwords($pname) ?></b></p>
        <hr class="divider">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <span><b>CALCULATE</b></span>
                        <button class="btn btn-primary btn-sm float-right deduction" style="padding: 3px 5px" type="button" data-id="<?php echo $EMP_ID?>"><i class="fa fa-plus"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<style type="text/css">
    .list-group-item>span>p{
        margin:unset;
    }
    .list-group-item>span>p>small{
        font-weight: 700
    }
</style>
<script type="text/javascript">
    $(document).ready(function(){
        $('.deduction').click(function(){
            var $id=$(this).attr('data-id');
            uni_modal("Edit Employee","deduction.php?id="+$id);
        });
    });
</script>
