function genlogin(){
	var user, pwd = '';
	var str = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ'+'adbcdefghijklmnopqrstuvwxyz0123456789@#$';
	user=document.getElementById("mob").value;
	document.getElementById("username").value=user;

	for(let i=1; i<=8; i++){
		var char = Math.floor(Math.random()*str.length+1);
		pwd += str.charAt(char)
	}
	
	document.getElementById("pwd").value=pwd;
}
function exists(){
	alert("Students Exist");
}