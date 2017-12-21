function validate_lgn(){
	var passed = true;
	var uname = document.getElementById("username").value
	for(i=0;i<uname.length;i++){
		if((uname.charAt(i)!='-'&&uname.charAt(i)<'0')||(uname.charAt(i)>'9'&&uname.charAt(i)<'A')||(uname.charAt(i)>'Z'&&uname.charAt(i)<'a')&&(uname.charAt(i)!='_')||uname.charAt(i)>'z'){
				passed = false
				document.getElementById('lgn_err_usrname').style.display="inline"
			}
		}
		if(passed===true){
				document.getElementById('lgn_err_usrname').style.display="none"
				return true
			}
		else{
				return false
			}
			
	}