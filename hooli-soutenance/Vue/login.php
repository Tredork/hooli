<?php

session_start();
echo $_SESSION['msg'];

?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Login</title>

<style>






div{
	margin: 0 auto;
	text-align: center;

}

.div1{
	width:400px;
	height: 500px;
	border-style: groove;
	margin-top: 100px;
	background: rgba(255,255,255,0.5);
}
.div2{
	width:500px;
	height: 50px;

    /*border-bottom-color: #00A2CA;
	border-bottom-style: groove;
	border-bottom-width: 2px;
	line-height: 30px;
	font-weight: bold;
	background:lightseagreen;*/
}

.div3{
	font-size: 18px;
	font-weight: bold;

}
</style>

	</head>
	<body >
		<img src="..\Image\image_login.png " border='0'width='100%' height='100%' style='position: absolute;left:0px;top:0px;z-index: -1'/>




  <form action= "loginchk.php" method="POST" name="send" onsubmit="return ChkFields()">

		<div class="div1" style="margin-top: 150px;">
			<div class="div2" style="margin-left: -60px; margin-top: 30px;display:inline-block;">   <img src = '..\Image\logo.png';> <p style="font-family:serif;padding-top:0px;font-size: 3em;text-shadow: 0px -1px 0px #000000;0px 1px 3px #606060;color:#606060;">Login</p> </div>
        <div class="div3" style="margin-top: 25px;">
        	<br />
        	 <input type="email" name="mail" placeholder="Mail" style="width: 200px; height: 30px;background-color: white; border-style:groove;margin-top: 40px;";/>
        	<br />
        	<br />
         <input type="password"name="password" placeholder="MOT DE PASSE" style="width: 200px; height: 30px;background-color: white; border-style: groove"/>
        
        	<br />
        	<input type="button"  id="btn" value="Mot de passe oublie"  style="text-decoration:underline; color: darkblue;font-family:serif;font-size: 1em; width: 180px; height: 30px;background-color: gray; border-style: hidden;margin-top: 60px;"  />
        	<input type="submit" name="submit" value="Connexion" style="width: 180px; height: 30px;color: white;font-family:serif;font-size: 1em;background-color: gray; border-style: hidden"  />
   
<script language="javascript">
   document.getElementById('btn').onclick=function()
        {
          window.location.href="mdpoublie.php";
        }
        
</script>
        </div>
        </div>
        <br />
  </from>

<script language="javascript">
function ChkFields(){
if(document.send.mail.value==""){
   window.alert("YOUR EMAIL PLEASE")
   return false
}
if(document.send.password.value==""){
   window.alert("YOUR PASSWORD PLEASE")
   return false
}
return true
}
</script>

</body>
</html>
