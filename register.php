<!DOCTYPE html>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Registration form</title>
<link rel="stylesheet" type="text/css" href="css/view.css" media="all">
<script src="js/jquery-latest.min.js" type="text/javascript"></script>
<script type="text/javascript" src="js/validate.js"></script>

<script type="text/javascript" src="js/calendar.js"></script>
<script type="text/javascript" src="js/script_ui.js"></script>
<script type="text/javascript" src="js/view.js"></script>
<script type="text/javascript">
function checkUserName(usercheck)
{
	$.post("check_usrname.php", {user_name: usercheck} , function(data)
		{			
			   if (data != '' || data != undefined || data != null) 
			   {				   
				  $('#erruname').html(data);	
			   }else{
				   $('#erruname').html();	
				   }
          });
}
</script>
</head>
<body id="main_body" >
<img id="top" src="images/top.png" alt="">
<div id="form_container">
  <h1><a>CodeStreet Registration Form</a></h1>
  <form id="form_1076159" method="post" class="appnitro" onsubmit="return validate();" action="process_reg.php">
    <div class="form_description">
      <h2>Registration Form</h2>
    </div>
    <ul >
      <li id="li_4" >
        <label class="description" for="firstname">Name </label>
        <span>
        <input id="firstname" name= "firstname" class="element text" maxlength="255" size="8" value=""/>
        <label>First</label>
        </span> <span>
        <input id="lastname" name= "lastname" class="element text" maxlength="255" size="14" value=""/>
        <label>Last</label>
        </span>
        <p class="errmsgs" id="errfname">*Field required</p>
        <p class="errmsgs" id="errfname2">Use letters only.</p>
        <p class="guidelines" id="guide_4"><small>Enter your First and Last names</small></p>
      </li>
      <li id="li_1" >
        <label class="description" for="username">Username </label>
        <div>
          <input id="username" name="username" class="element text medium" type="text" onKeyup="checkUserName(this.value)" autocomplete="off" maxlength="255" value=""/>
          <div class="errmsgs" id="erruname"></div>
        </div>
        <p class="guidelines" id="guide_1"><small>Choose your username</small></p>
      </li>
      <li id="li_2">
        <label class="description" for="pswd">Password </label>
        <p id="temp"></p>
        <div>
          <input id="pswd" name="pswd" class="element text medium" type="password" maxlength="255" value=""/>
          <p class="errmsgs" id="errpswd1">*Field required</p>
          <p class="errmsgs" id="errpswd2">Password must contain atleast 6 characters</p>
        </div>
        <p class="guidelines" id="guide_2"><small>Your password</small></p>
      </li>
      <li id="li_3" >
        <label class="description" for="c_pswd">Re-enter password </label>
        <div>
          <input id="c_pswd" name="c_pswd" class="element text medium" type="password" maxlength="255" value=""/>
          <p class="errmsgs" id="errcpswd1">*Field required</p>
          <p class="errmsgs" id="errcpswd2">Passwords donot match</p>
        </div>
        <p class="guidelines" id="guide_3"><small>Confirm password</small></p>
      </li>
      <li id="li_8" >
        <label class="description" for="branch">Branch </label>
        <div>
          <select class="element select small" id="branch" name="branch">
            <option value="" selected="selected"></option>
            <option value="1" >IT</option>
            <option value="2" >CSE</option>
            <option value="3" >ECE</option>
            <option value="4" >EEE</option>
            <option value="5" >MECH</option>
            <option value="6" >CIVIL</option>
          </select>
          <p class="errmsgs" id="errbranch">*Field required</p>
        </div>
      </li>
      <li id="li_9" >
        <label class="description" for="year">Year </label>
        <span>
        <input id="year1" name="year" class="element radio" type="radio" value="1" />
        <label class="choice" for="year1">1</label>
        <input id="year2" name="year" class="element radio" type="radio" value="2" />
        <label class="choice" for="year2">2</label>
        <input id="year3" name="year" class="element radio" type="radio" value="3" />
        <label class="choice" for="year3">3</label>
        <input id="year4" name="year" class="element radio" type="radio" value="4" />
        <label class="choice" for="year4">4</label>
        </span>
        <p class="errmsgs" id="erryear">*Field required</p>
      </li>
      <li id="li_5" >
        <label class="description" for="email">Email </label>
        <div>
          <input id="email" name="email" class="element text medium" type="text" maxlength="255" value=""/>
          <p class="errmsgs" id="erremail">*Field required</p>
        </div>
        <p class="guidelines" id="guide_5"><small>Your mail i.d.</small></p>
      </li>
      <li id="li_6" >
        <label class="description" for="phone">Contact no. </label>
        <span>
        <input id="phone1" name="phone1" class="element text" size="3" maxlength="3" value="" onKeyUp="movetophone2()" type="text">
        -
        <label for="phone1">(###)</label>
        </span> <span>
        <input id="phone2" name="phone2" class="element text" size="3" maxlength="3" value="" onKeyUp="movetophone3()" type="text">
        -
        <label for="phone2">###</label>
        </span> <span>
        <input id="phone3" name="phone3" class="element text" size="4" maxlength="4" value="" onKeyUp="movetodob1()" type="text">
        <label for="phone3">####</label>
        </span>
        <p class="guidelines" id="guide_6"><small>Enter your phone number.</small></p>
        <p class="errmsgs" id="errphone">*Field required</p>
        <p class="errmsgs" id="errphone2">Phone no. must contain numbers only</p>
      </li>
      <li id="li_7" >
        <label class="description" for="dob">Date of Birth </label>
        <span>
        <input name="dob" id="dob" class="element text" type="date">
        <p class="errmsgs" id="errdob">*Field required</p>
        </span>
        <p class="guidelines" id="guide_7"><small>Enter your D.O.B.</small></p>
      </li>
      <li class="buttons">
        <input id="saveForm" class="button_text" type="submit" name="submit" value="Submit" onclick="validate()"/>
      </li>
    </ul>
  </form>
</div>
<img id="bottom" src="images/bottom.png" alt="">
</body>
</html>