function check(){
	var val = document.getElementById('bool_stdin');
	var stdbox = document.getElementById('stdin');
	if(val.checked===false){
		stdbox.style.display = "none";
		var err = document.getElementById('error_msg');
		err.style.width = "760px";
		err.style.marginLeft = "0px";
		err.style.marginTop = "20px";
		err.style.marginRight = "0px";
	}else{
		stdbox.style.display = "inline";
		var err = document.getElementById('error_msg');
		err.style.width = "426px";
		err.style.marginLeft = "0px";
		err.style.marginTop = "20px";
		err.style.marginRight = "0px";	
		}
		
	};
	
