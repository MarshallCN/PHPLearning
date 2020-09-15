<?php
if (isset($_POST['submit'])) {
    require_once 'Calculate.php';

    $input = new Calculate($_POST['x1'],$_POST['y1'],$_POST['x2'],$_POST['y2']);

    $input->InputCheck();

    $result = $input->Total();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>Map Grid</title>
    <link href="http://cdn.bootcss.com/materialize/0.97.1/css/materialize.min.css" rel="stylesheet">
</head>
<body>

<div class="container">
    <div class="valign-wrapper" style="min-height: 600px">
        <div class="row">
            <div class="col s12 m6">
                <img class="responsive-img" src="map.png">
            </div>
            <form method="post" action="index.php">
                <div class="col s12 m6">
                    <div class="row">
                        <div class="row" style="margin-left: 10px;">
                            <span>Start point:</span>
                        </div>
                        <div class="input-field col s6">
                            <input placeholder="letter" id="x1" type="text" class="validate" name="x1" required="required">
                            <label for="x1">X1:</label>
                        </div>
                        <div class="input-field col s6">
                            <input placeholder="number" id="y1" type="number" class="validate" name="y1" required="required">
                            <label for="y1">Y1:</label>
                        </div>
                    </div>
                </div>
                <div class="col s12 m6">
                    <div class="row">
                        <div class="row" style="margin-left: 10px;">
                            <span>Destination point:</span>
                        </div>
                        <div class="input-field col s6">
                            <input placeholder="letter" id="x2" type="text" class="validate" name="x2" required="required">
                            <label for="x2">X2:</label>
                        </div>
                        <div class="input-field col s6">
                            <input placeholder="number" id="y2" type="number" class="validate" name="y2" required="required">
                            <label for="y2">Y2:</label>
                        </div>
                    </div>
                    <div class="row center">
                        <button class="waves-effect waves-light btn" type="submit" name="submit">Submit</button>
                    </div>
                </div>
            </form>
            <?php if(isset($result)){?>
                <div class="row center">
                    Start Point: <?php echo $_POST['x1'].$_POST['y1'];?><br />
                    Destination point: <?php echo $_POST['x2'].$_POST['y2'];?><br />
                    Total distance: <?php echo $input->Total();?>
                </div>
            <?php }?>
        </div>
    </div>
</div>
<script src="//cdn.bootcss.com/jquery/2.1.4/jquery.min.js"></script>
<script src="//cdn.bootcss.com/materialize/0.97.1/js/materialize.min.js"></script> 
</body>
</html>