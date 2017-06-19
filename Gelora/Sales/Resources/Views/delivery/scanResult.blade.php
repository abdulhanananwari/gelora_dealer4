<!DOCTYPE html>
<head>
    <title>Scan Result</title>
</head>

<style type="text/css">
	h4 ,p ,span{
		text-align: center;
		font-size: 200%;
	}

button {
	height:20px;
	position:relative; 
	margin: -20px -50px; 
	width:100px; 
	top:50%; 
	left:50%;}

</style>

<body>
@if(isset($viewData['errors']))
<h4>Scan unit Gagal !</h4>

<p>unit yang anda scan tidak sesuai dengan Sj</p>

<button  onClick="window.close();">Tutup</button>

@else
<h4>Scan Berhasil !</h4>
<div style="text-align: center;">
	<span id="countdown">5</span>	
</div>
<button  onClick="window.close();">Tutup</button>
<script type="text/javascript">
	var time = 5;
		setInterval(function() {
		time--;	
		if(time<0) {
			window.close();
		}else{
		document.getElementById("countdown").innerHTML = time;
	}
	}, 1000);
</script>
@endif
</body>
</html>