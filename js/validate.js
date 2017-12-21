function validate(){
	var passed = true;
	var fname = document.getElementById('firstname').value
	var lname = document.getElementById('lastname').value
	if(fname==''||lname==''){
			document.getElementById('errfname').style.display="inline"
			passed = false
		}else{
			document.getElementById('errfname').style.display="none"
			}
	var i=0
	var flag = true;
	for(i=0;i<fname.length;i++){
		if(fname.charAt(i)<'A'||(fname.charAt(i)>'Z'&&fname.charAt(i)<'a')||fname.charAt(i)>'z'){
				passed = false
				flag = false
				document.getElementById('errfname2').style.display="inline"
				document.getElementById('errfname').style.display="none"
			}
		}
	for(i=0;i<lname.length;i++){
		if(lname.charAt(i)<'A'||(lname.charAt(i)>'Z'&&lname.charAt(i)<'a')||lname.charAt(i)>'z'){
				passed = false
				flag = false
				document.getElementById('errfname2').style.display="inline"
				document.getElementById('errfname').style.display="none"
			}
		}
		if(flag){
				document.getElementById('errfname2').style.display="none"
				if(fname==''||lname==''){
					passed = false;
					document.getElementById('errfname').style.display="inline";	
				}
			}
	
		var pass = document.getElementById('pswd').value
	if(pass==''){
			document.getElementById('errpswd1').style.display="inline"
			passed = false
		}
	else if(pass<6){
			document.getElementById('errpswd2').style.display="inline"
			passed = false
		}else{
				document.getElementById('errpswd1').style.display="none"
				document.getElementById('errpswd2').style.display="none"
			}
	var cpass = document.getElementById('c_pswd').value
	if(cpass==''){
			document.getElementById('errcpswd1').style.display="inline";
			document.getElementById('errcpswd2').style.display="none";
			passed = false;
		}else if(cpass!=pass){
			document.getElementById('errcpswd2').style.display="inline";
			document.getElementById('errcpswd1').style.display="none";
			passed = false
			}else{
				document.getElementById('errcpswd1').style.display="none";
				document.getElementById('errcpswd2').style.display="none";
				}
	if(document.getElementById('branch').selectedIndex==0){
			document.getElementById('errbranch').style.display="inline"
			passed = false
		}else{
				document.getElementById('errbranch').style.display="none"
			}
	if(document.getElementById('year1').checked||document.getElementById('year2').checked||document.getElementById('year3').checked||document.getElementById('year4').checked){
			document.getElementById('erryear').style.display="none"
		}
		else{
				document.getElementById('erryear').style.display="inline"
				passed = false
			}
	if(document.getElementById('email').value==''){
			document.getElementById('erremail').style.display="inline"
			passed = false
		}else{
				document.getElementById('erremail').style.display="none"
			}
			var ph_flag = true;
			var phone = [document.getElementById('phone1').value,document.getElementById('phone2').value,document.getElementById('phone3').value];
	if(phone[0]==''||phone[1]==''||phone[2]==''){
			document.getElementById('errphone').style.display="inline";
			passed = false;
		}else{
				document.getElementById('errphone').style.display="none";
				for(i=0;i<phone.length;i++){
					for(var j=0;j<phone[i].length;j++){
						if(phone[i][j]<'0'||phone[i][j]>'9'){
								ph_flag=false;
								passed = false;
								document.getElementById('errphone2').style.display="inline";
								document.getElementById('errphone').style.display="none";
						}	
					}
				}
			}
			if(ph_flag){
				document.getElementById('errphone2').style.display="none";
				if(phone[0]==''||phone[1]==''||phone[2]==''){
						document.getElementById('errphone').style.display="inline";
						passed = false;
				}
			}
	
		if(!document.getElementById('dob').value){
			document.getElementById('errdob').style.display="inline";	
		}else{
			document.getElementById('errdob').style.display="none";	
		}
		
	
		return passed;
	};
	
	

