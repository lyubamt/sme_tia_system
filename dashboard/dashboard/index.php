<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>TEMPLATE</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- BOOTSTRAP -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <!-- FONT AWESOME ICONS -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" 
    integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

    <!------MY CSS-->
    <link rel="stylesheet" href="template.css">

</head>
<body>
    <div class="container-full">
    

        <!-- THE HEADER CONTAINER -->
        <div class="container header">

            <div class="card header">
                 
                <?php include("templateheader.php"); ?>

            </div><!------end of header card-->
    
        </div> <!---------END OF HEADER CONTAINER-->



        <!-- THE CONTENTS CONTAINER -->
        <div class="container content">
            
            <!--------content card-->
            <div class="card content">

            <?php include("templatecontent.php"); ?>

            </div><!------End of the card for content-->
            

        </div><!-----------END OF CONTENT CONTAINER-->



        <!-- THE FOOTER CONTAINER -->
        <div class="container footer">

            <div class="card footer">
                     
            <?php include("templatefooter.php"); ?>
                
            </div><!-------End of footer card---------->

        </div><!------END OF FOOTER CONTAINER---------->

    </div><!----------END OF FULL PAGE CONTAINER-------->

</body>
</html>