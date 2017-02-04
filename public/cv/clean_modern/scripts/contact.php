<?php
		$name = '';
        $email = '';
        $number = ''; 
        $message = ''; 
		$to = '';
        
         
        if(isset($_POST['email'])) {
        
			$name = $_POST['name'];
            $email = $_POST['email'];
            $number = $_POST['number'];
            $message = $_POST['message'];
            $to = $_POST['to'];

			
            if(get_magic_quotes_gpc()) {
                    $message = stripslashes($message);
            }

             $address = $to;

             $e_subject = 'You\'ve Received a Message From ' . $name . '.';

             $e_body = "$name has submitted contact form on your resume. \n\n $message \n\n";

             $e_reply = "You can contact $name via email: $email or phone: $number";

             $msg = $e_body . $e_reply;

             mail($address, $e_subject, $msg, "From: $name <no-reply@ressuu.me>");
    
             echo "Message Sent Successfully!";
        }
        else
		{
            echo "Message Sending Failed!";
        }