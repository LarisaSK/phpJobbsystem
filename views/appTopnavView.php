

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../css/style.css">
  <title>Header</title>

  <style>
    .topnav {
    overflow: hidden;
    background-color: #e9e9e9;
  }
  
  /* Style the links inside the navigation bar */
  .topnav a {
    float: left;
    display: block;
    color: black;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
    font-size: 17px;
  }
  
  /* Style the search box inside the navigation bar */
  .topnav input[type=text] {
    float: right;
    padding: 6px;
    border: none;
    margin-top: 8px;
    margin-right: 16px;
    font-size: 17px;
  }
  
  /* When the screen is less than 600px wide, stack the links and the search field vertically instead of horizontally */
  @media screen and (max-width: 600px) {
    .topnav a, .topnav input[type=text] {
      float: none;
      display: block;
      text-align: left;
      width: 100%;
      margin: 0;
      padding: 14px;
    }
    .topnav input[type=text] {
      border: 1px solid #ccc;
    }
  }

</style>
</head>
<body>
  <div class ="topnav">
    <!--Må legge til følgene filer til sidene-->
        <a href="#logg_ut">Logg Ut</a>
        <a href="#Jobb_profil">Min profil</a>
        <a href="appliDachboardView.php">Ledige stillinger</a>
        <a href="appliCvView.php">Min CV</a>
        <input type="text" placeholder="Søk..">
    </div>
  </div>
</body>
</html>



