<?php 
$owner = $_GET['owner'];
$add_one = $_GET['address_one'];
$add_two = $_GET['address_two'];
$zip = $_GET['zip'];
if (isset($_POST["submit"])) {
	$name = $_POST['element_1_1']." ".$_POST['element_1_2'];
	$phone = $_POST['element_2_1']."-".$_POST['element_2_2']."-".$_POST['element_2_3'];
	$email = $_POST['element_3'];
	$explain = $_POST['element_4'];
	$experience = $_POST['element_5'];
	$contract = $_POST['element_6'];
	$file = fopen("vacant2vital.txt","w+");
	fwrite($file, "OWNER INFO\n".$owner."\t".$add_one."\t".$add_two."\t".$zip."\r\n");
	fwrite($file, "SEEKER INFO\n".$name."\t".$phone."\t".$email."\r\n");
	fwrite($file, "EXTRA INFO\n".$explain."\t".$experience."\t".$contract."\r\n");
	fclose($file);

	require 'vendor/autoload.php';

$file = file_get_contents('front.html');
$back = file_get_contents('back.html');


$lob = new \Lob\Lob('test_e17cf73fd6ce6ee1c68e9e85bae7adf0b25');

$to_address = $lob->addresses()->create(array(
  'name'          => $owner,
  'address_line1' => $add_one,
  'address_line2' => $add_two,
  'address_city'  => 'San Francisco',
  'address_state' => 'CA',
  'address_zip'   => '27518'
));

$from_address = $lob->addresses()->create(array(
  'name'          => 'The Big House',
  'address_line1' => '1201 S Main St',
  'address_line2' => '',
  'address_city'  => 'Ann Arbor',
  'address_state' => 'MI',
  'address_zip'   => '48104',
  'email'         => 'goblue@umich.edu',
  'phone'         => '734-647-2583'
));

$postcard = $lob->postcards()->create(array(
  'to'          => $to_address['id'],
  'from'        => $from_address['id'],
  'front'       => $file,
  'back'        => $back,
 // 'message'     => 'This is the name!',
  'data[name]'  => 'Harry',
  'data[line1]'    => $to_address['address_line1'],
  'data[line2]'   => $to_address['address_line2'],
  'data[city]'   => $to_address['address_city'],
  'data[zip]'   => $to_address['address_zip'],
  'data[state]' => $to_address['address_state'],
  'data[seekername]'  => $name,
  'data[explain]'  => $explain,
  'data[email]'  => $email,
  'data[phone]'  => $phone,
  'data[experience]'  => $experience,
  'data[contract]'  => $contract
));



echo '<script language="javascript">';
echo 'alert("Your postcard has been sent to the owner.")';

echo '</script>';
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Vacant2Vital</title>
<link rel="stylesheet" type="text/css" href="css/view.css" media="all">
<script src='https://www.google.com/recaptcha/api.js'></script>
<script type="text/javascript" src="js/view.js"></script>

</head>
<body id="main_body" >
	
	<img id="top" src="images/top.png" alt="">
	<div id="form_container">
	
		<h1><a>Vacant2Vital</a></h1>
		<form id="form_1126356" class="appnitro"  method="post" action="">
					<div class="form_description">
			<h2>Vacant2Vital</h2>
			<p>Please fill this form to contact owner.</p>
		</div>						
			<ul >
					<li id="li_1" >
		<label class="description" for="element_1">Name </label>
		<span>
			<input id="element_1_1" name= "element_1_1" class="element text" maxlength="255" size="8" value="" required/>
			<label>First</label>
		</span>
		<span>
			<input id="element_1_2" name= "element_1_2" class="element text" maxlength="255" size="14" value="" required/>
			<label>Last</label>
		</span> 
		</li>		<li id="li_2" >
		<label class="description" for="element_2">Phone </label>
		<span>
			<input id="element_2_1" name="element_2_1" class="element text" size="3" maxlength="3" value="" type="number" min="100" max="999" required> -
			<label for="element_2_1">(###)</label>
		</span>
		<span>
			<input id="element_2_2" name="element_2_2" class="element text" size="3" maxlength="3" value="" type="number" min="000" max="999" required> -
			<label for="element_2_2">###</label>
		</span>
		<span>
	 		<input id="element_2_3" name="element_2_3" class="element text" size="4" maxlength="4" value="" type="number" min="0000" max="9999" required>
			<label for="element_2_3">####</label>
		</span>
		 
		</li>		<li id="li_3" >
		<label class="description" for="element_3">Email </label>
		<div>
			<input id="element_3" name="element_3" class="element text medium" type="email" maxlength="255" value="" required/> 
		</div> 
		</li>		<li id="li_4" >
		<label class="description" for="element_4">Explain how would you use this land </label>
		<div>
			<textarea id="element_4" name="element_4" class="element textarea medium" required></textarea> 
		</div> 
		</li>		<li id="li_5" >
		<label class="description" for="element_5">Do you have experience
 </label>
		<div>
		<select class="element select medium" id="element_5" name="element_5" required> 
			<option value="" selected="selected" ></option>
<option value="<1 year" ><1 year</option>
<option value=">1 year and <2 years" >>1 year and <2 years</option>
<option value=">2 years" >>2 years</option>

		</select>
		</div> 
		</li>		<li id="li_6" >
		<label class="description" for="element_6">Sign contract </label>
		<span>
			<input id="element_6_1" name="element_6" class="element radio" type="radio" value="Yes" required/>
<label class="choice" for="element_6_1">Yes</label>
<input id="element_6_2" name="element_6" class="element radio" type="radio" value="No" />
<label class="choice" for="element_6_2">No</label>

		</span><p class="guidelines" id="guide_6"><small>Are you willing to sign a contract?.</small></p> 
		</li>
			
					<li class="buttons">
			    <input type="hidden" name="form_id" value="1126356" />
			    <div class="g-recaptcha" data-sitekey=6LcTVR4TAAAAAAnMQk-rYsLHeJm18Qk_K1tkU-ZZ></div>
				<input id="saveForm" class="button_text" type="submit" name="submit" value="Submit" />
		</li>
			</ul>
		</form>	
		<div id="footer">
			Vacant2Vital Seeker Form</a>
			<a href="info.html">Go to Info page</a>
		</div>
	</div>
	<img id="bottom" src="images/bottom.png" alt="">

	</body>
</html>
