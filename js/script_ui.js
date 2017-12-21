function movetophone2(){
	if(document.getElementById('phone1').value.length==3)
		document.getElementById('phone2').focus()
	}
	
function movetophone3(){
	if(document.getElementById('phone2').value.length==3)
		document.getElementById('phone3').focus()
	}
	
function movetodob1(){
	if(document.getElementById('phone3').value.length==4){
		document.getElementById('dob1').focus()	
		}
	}

function movetodob2(){
	if(document.getElementById('dob1').value.length==2){
		document.getElementById('dob2').focus()	
		}
	}

function movetodob3(){
	if(document.getElementById('dob2').value.length==2){
		document.getElementById('dob3').focus()	
		}
	}
function movetosubmit(){
	if(document.getElementById('dob3').value.length==4){
		document.getElementById('saveForm').focus()	
		}
	}