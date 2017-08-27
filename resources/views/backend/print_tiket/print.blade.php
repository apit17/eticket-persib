<!DOCTYPE html>
<html>
<head>
<style type="text/css"> 
 @media screen, print{
    body{
  width: 50%;
  height: 10cm; 
border: solid 1px black;
 }
 @page{
border: solid 1px black;
  width: 50%;
  height: 10cm; 
 }
 }
</style>
  <title></title>
</head>
<body>
<div class="content">
	MATCH NAME : <img width="25px" height="25px" src='{{asset("images/{$record->image1}")}}'> {{$record->color}} <img width="25px" height="25px" src='{{asset("images1/{$record->image2}")}}'>
	<div class="content">
		TIPE TIKET : {{$record->name}}
		<div>
			MATCHDAY : {{$record->date}}
			<div>
				TIKET PRICE : {{$record->price}}
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
  document.addEventListener("DOMContentLoaded", function(event){
    window.print();
  });
</script>
</body>
</html>