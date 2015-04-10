<?php require_once("includes/base_main_settings.php") ?>
<?php require_once("includes/functions.php") ?>
<?php require_once("includes/connection.php") ?>
<?php require_once("backend/ifnotlogin.php") ?>
<?php
    $username = $_SESSION['currentuser'];
?>

<?php require_once("backend/interest_settings_form_backend.php") ?>

<div id="main" class="row">
    <div class="row">
        <div class="col-lg-11">
            <h1 class="page-header text-center">Interest Settings</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <form role="form" action="interest_settings_form.php?user=<?php echo $username;?>" method="post">
        <div class="col-md-12">
            <div class="well-lg panel panel-default" id="toggable_box">
                <div class="panel-body">
                    <!--    <p> here comes the navigation bar</p> -->
                    <div role="tabpanel">
                        <!-- Nav tabs -->
                        <div class="col-md-9 col-sm-6 col-xs-9 personal-info">
                        
                        <?php
                            
                            $q_cat=mysql_query("SELECT * FROM Category");

                            for($i = 0; $i < mysql_num_rows($q_cat); $i++)
                            {
                                $Cat_name=mysql_result($q_cat,$i,'Cat_name');
                                $Cat_id=mysql_result($q_cat,$i,'Cat_id');
                        ?>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseP<?php echo $i+1 ?>"><?php echo $Cat_name ?></a>
                                        </h4>
                                    </div>
                                    <div id="collapseP<?php echo $i+1 ?>" class="panel-collapse collapse out">
                                    <div class="panel-body">
                        <?php
                                $q=mysql_query("SELECT * FROM Subcategory WHERE Cat_id='$Cat_id'");

                                for($j = 0; $j < mysql_num_rows($q); $j++)
                                {
                                    $Sub_Cat_name=mysql_result($q,$j,'Sub_name');
                                    $Sub_Cat_id=mysql_result($q,$j,'Sub_id');

                        ?>
                                <div class="checkbox">
                                            <label>
                                                <input type="checkbox" value="" name="<?php echo $Sub_Cat_id; ?>" ><?php echo $Sub_Cat_name; ?>
                                            </label>
                                        </div>
                        <?php }?>
                                
                                </div>
                                </div>
                            </div>
                        <?php } ?>


                            <button type="submit" class="btn btn-primary" name="submit" value="submit">Submit</button>
                            <?php 
                                    if("$username"=='admin')
                                    { 
                                ?>
                                <form action="admin.php?user=<?php echo $username; ?>" method="post">
                                    <a href="admin.php?user=<?php echo $username; ?>">Add category</button>
                                </form>

                                <?php 
                                    } 
                                ?>
                            
                        
     <!--Comments tab-->
                

        </div>
    
</div>
</div>
</div>

</div>


<?php require_once("includes/footer.php") ?>
<!--/container-->