<?php 
$weather="";
$error="";
if(array_key_exists('city', $_GET)){
	$_GET['city']=str_replace(' ', '', $_GET['city']);
	
$file_headers = @get_headers("https://www.weather-forecast.com/locations/".$_GET['city']."/forecasts/latest");

if($file_headers[0] == 'HTTP/1.1 404 Not Found') {
    $error.="that city could not be found.";
}
else{

$forecastPage=file_get_contents("https://www.weather-forecast.com/locations/".$_GET['city']."/forecasts/latest");

$pageArray=explode('</h2> (1–3 days)</div><p class="b-forecast__table-description-content"><span class="phrase">', $forecastPage);

    if(sizeOf($pageArray) > 1){

$secondPageArray=explode('</span></p></td><td class="b-forecast__table-description-cell--js" colspan="9">',$pageArray[1]);
    
	if(sizeOf($secondPageArray) > 1){

$weather= $secondPageArray[0];
	    }
		else{
			
		$error.="that city could not be found.";
           }	
			
		
	} 
   else{
   $error.="that city could not be found.";
     }
   	   
}
}

?>


<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>Weather Scrapper</title>
	<style type="text/css">
	.container{
		text-align:center;
		position:relative;
		bottom:900px;
		font-size:25px;
		font-weight:bold;
		width:450px;
	}
	input{
		margin:15px;
	}
	#weather{
		margin-top:15px;
		font-size:20px;
	}
	
	
	
	</style>
  </head>
  <body>
   <img src="https://images.unsplash.com/photo-1581320546160-0078de357255?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=500&q=60"width="1349px" height="1000px">
  
  <div class="container">
  
   <h1> What's the Weather?</h1>
   
   <form>
  <div class="form-group">
    <label for="city">Enter the name of a city</label>
    <input type="text" class="form-control" id="city" name="city" placeholder="eg: mumbai,chandigarh" value="<?php 
	
	if(array_key_exists('city', $_GET)){
	
	echo $_GET['city'];
	}
	?>">
</div>
 
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
<div id="weather"><?php

if($weather){
	echo '<div class="alert alert-success" role="alert">
  '.$weather.'
</div>';
}
else if($error){
	echo '<div class="alert alert-danger" role="alert">
  '.$error.'
</div>';
}



?></div>
</div>
   <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>