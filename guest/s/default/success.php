
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <title>SyncSpot Success</title>
  <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
  <link rel="stylesheet" href="css/test-style.css">
  <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
  <link rel="icon" href="favicon.ico" type="image/x-icon">
</head>

<body>
  <h1>SyncSpot Success!</h1>
  <h2>
    You have been granted internet access!
  </h2>
  <?php
  if(isset($_GET['redirect'])){

   ?>
  <h3>Redirecting you to where you want to be (in <span id='seconds'>5</span> seconds...)</h3>
  <script type="text/javascript">
  window.seconds = 5;
    window.setInterval(()=>{
      if(window.seconds >= 1){
        window.seconds--;
        document.getElementById("seconds").innerHTML = window.seconds;
      } else {
        document.getElementById("seconds").parentElement.innerHTML = "Redirecting...";
        window.location = "<?php echo $_GET['redirect']; ?>";
      }
    },1000);
  </script>
<?php } ?>
</body>

</html>
