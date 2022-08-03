<?php
if(isset($_POST['email'])) {
 
    // EDIT THE 2 LINES BELOW AS REQUIRED
    $email_to = "contact@onum.com";
    $email_subject = "Your email subject line";
 
    function died($error) {
        // your error code can go here
        echo "We are very sorry, but there were error(s) found with the form you submitted. ";
        echo "These errors appear below.<br /><br />";
        echo $error."<br /><br />";
        echo "Please go back and fix these errors.<br /><br />";
        die();
    }
 
 
    // validation expected data exists
    if(
        !isset($_POST['website']) ||
        !isset($_POST['company']) ||
        !isset($_POST['fname']) ||
        !isset($_POST['lname']) ||
        !isset($_POST['phone']) ||
        !isset($_POST['email']) ||
        !isset($_POST['name']) ||
        !isset($_POST['message'])) {
        died('We are sorry, but there appears to be a problem with the form you submitted.');
    }
 
     
 
    $url = $_POST['website']; // required
    $company = $_POST['company']; // required
    $fname = $_POST['fname']; // required
    $lname = $_POST['lname']; // required
    $phone = $_POST['phone']; // required
    $email_from = $_POST['email']; // required
    $reason = $_POST['name']; // required
    $reason1 = $reason[0];
    $reason2 = $reason[1];
    $reason3 = $reason[2];
    $reason4 = $reason[3];
    $reason5 = $reason[4];
    $reason6 = $reason[5];
    $comments = $_POST['message']; // required

 
    $error_message = "";
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
 
  if(!preg_match($email_exp,$email_from)) {
    $error_message .= 'The Email Address you entered does not appear to be valid.<br />';
  }
 
    $string_exp = "/^[A-Za-z .'-]+$/";
 
  if(!preg_match($string_exp,$fname)) {
    $error_message .= 'The First Name you entered does not appear to be valid.<br />';
  }

  if(!preg_match($string_exp,$lname)) {
    $error_message .= 'The last Name you entered does not appear to be valid.<br />';
  }
 
  if(strlen($comments) < 2) {
    $error_message .= 'The Comments you entered do not appear to be valid.<br />';
  }
 
  if(strlen($error_message) > 0) {
    died($error_message);
  }
 
    $email_message = "Form details below.\n\n";
 
     
    function clean_string($string) {
      $bad = array("content-type","bcc:","to:","cc:","href");
      return str_replace($bad,"",$string);
    }
 
     
 
    $email_message .= "URL: ".clean_string($url)."\n";
    $email_message .= "Company: ".clean_string($company)."\n";
    $email_message .= "First Name: ".clean_string($fname)."\n";
    $email_message .= "Last Name: ".clean_string($lname)."\n";
    $email_message .= "Phone: ".clean_string($phone)."\n";
    $email_message .= "Email: ".clean_string($email_from)."\n";
    $email_message .= "Reason: ".clean_string($reason1)."\n";
    $email_message .= "               ".clean_string($reason2)."\n";
    $email_message .= "               ".clean_string($reason3)."\n";
    $email_message .= "               ".clean_string($reason4)."\n";
    $email_message .= "               ".clean_string($reason5)."\n";
    $email_message .= "               ".clean_string($reason6)."\n";
    $email_message .= "Comments: ".clean_string($comments)."\n";
 
// create email headers
$headers = 'From: '.$email_from."\r\n".
'Reply-To: '.$email_from."\r\n" .
'X-Mailer: PHP/' . phpversion();
@mail($email_to, $email_subject, $email_message, $headers);  
?>
 
<!-- include your own success html here -->
 
Thank you for contacting us. We will be in touch with you very soon.
 
<?php
 
}
?>