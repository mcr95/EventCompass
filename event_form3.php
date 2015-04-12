<?php
    ob_start();
?>

<?php require_once("includes/base.php") ?>
<?php require_once("includes/functions.php") ?>
<?php require_once("includes/connection.php") ?>

<link href="css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Tangerine">
<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Montserrat">

<?php
    $username = $_SESSION['currentuser'];
?>

<?php
    if(isset($_GET['id']))
    {
        $id = $_GET['id'];
    }
    if(isset($_POST['submit1']))
    {
        redirect_to("event_page.php?user=$username&id=$id");
    }
    elseif (isset($_POST['submit']))
    {
        //echo $id;
        $uploadDir = 'img/';
        //chmod("img/",0600);
        $image_name = $_FILES['image']['name'];
        $image_type = $_FILES['image']['type'];
        $image_size = $_FILES['image']['size'];
        $image_tmp_name = $_FILES['image']['tmp_name'];   
        $ext = pathinfo($image_name, PATHINFO_EXTENSION);
        //echo $ext;
        //echo type($ext);
        if($ext == "pdf")
        {
            $filePath = $uploadDir . $id . '.pdf';
        }
        $result = move_uploaded_file($image_tmp_name, $filePath);
        if (!$result) 
        {
            echo "Error uploading file";
            exit;
        }
        echo "hello world";
        $query = mysql_query("UPDATE Event SET Ev_mou = '$filePath' WHERE Ev_id = '$id'"); 
        if(!$query)
        {
            echo mysql_error();
        }
        redirect_to("event_page.php?user=$username&id=$id");
    }
?>
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header text-center"><font face="Montserrat">Event Form</font></h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading text-center">
                    <h1><font face="Tangerine">Upload MOU document for your event</font></h1>
                </div>
                <div class="panel-body">
                    <div class="row col-md-offset-1">
                        <div class="col-lg-12">
                            <form enctype="multipart/form-data" role="form" method="post" action="event_form3.php?user=<?php echo $username;?>&id=<?php echo $id; ?>">
                                <div class="form-group">
                                    <label><h3><font face="Montserrat">MOU</font></h3></label>
                                    <input type="file" name="image">          
                                    <br>
                                    <button type="submit" class="btn btn-primary" name="submit" value="submit"><font face="Montserrat">Proceed to next step</font></button>
                                    <button type="submit" class="btn btn-link" name="submit1" value="submit1"><font face="Montserrat">Skip</font></button>
                                </div>
                            </form>
                        </div>
                        <!-- /.col-lg-12 (nested) -->
                    </div>  
                    <!-- /.row (nested) -->
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
</div>
<!-- /#page-wrapper -->

<!-- jQuery -->
<script src="js/jquery.min.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>

<!-- Metis Menu Plugin JavaScript -->
<script src="js/metisMenu.min.js"></script>

<!-- Custom Theme JavaScript -->
<script src="js/sb-admin-2.js"></script>

<?php require_once("includes/footer.php") ?>