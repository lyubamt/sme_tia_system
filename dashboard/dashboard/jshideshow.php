<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>

<section class="searchformSection" id="searchform">
        <!--------Search form----------------->
        <form class="form-inline" action="" method="post">
            <input type="search" class="form-control" name="search" id="search" >
        </form><!-------End of search form------>

</section>

<p><b>Note:</b> The element will not take up any space when the display property set to "none".</p>
<section>
<p>Click the "Try it" button to toggle between hiding and showing the DIV element:</p>

<button onclick="myFunction()">Try it</button>
</section>

<script>
function myFunction() {
  var x = document.getElementById("searchform");
  if (x.style.display === "none") {
    x.style.display = "block";
  } else {
    x.style.display = "none";
  }
}
</script>

</body>
</html>

