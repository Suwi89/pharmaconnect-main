    <?php

    // include "../database/dbconnection.php";

    if (!$_POST) {
        exit;
    }

    // Email address verification, do not edit.
    function isEmail($email)
    {
        return(preg_match("/^[-_.[:alnum:]]+@((([[:alnum:]]|[[:alnum:]][[:alnum:]-]*[[:alnum:]])\.)+(ad|ae|aero|af|ag|ai|al|am|an|ao|aq|ar|arpa|as|at|au|aw|az|ba|bb|bd|be|bf|bg|bh|bi|biz|bj|bm|bn|bo|br|bs|bt|bv|bw|by|bz|ca|cc|cd|cf|cg|ch|ci|ck|cl|cm|cn|co|com|coop|cr|cs|cu|cv|cx|cy|cz|de|dj|dk|dm|do|dz|ec|edu|ee|eg|eh|er|es|et|eu|fi|fj|fk|fm|fo|fr|ga|gb|gd|ge|gf|gh|gi|gl|gm|gn|gov|gp|gq|gr|gs|gt|gu|gw|gy|hk|hm|hn|hr|ht|hu|id|ie|il|in|info|int|io|iq|ir|is|it|jm|jo|jp|ke|kg|kh|ki|km|kn|kp|kr|kw|ky|kz|la|lb|lc|li|lk|lr|ls|lt|lu|lv|ly|ma|mc|md|me|mg|mh|mil|mk|ml|mm|mn|mo|mp|mq|mr|ms|mt|mu|museum|mv|mw|mx|my|mz|na|name|nc|ne|net|nf|ng|ni|nl|no|np|nr|nt|nu|nz|om|org|pa|pe|pf|pg|ph|pk|pl|pm|pn|pr|pro|ps|pt|pw|py|qa|re|ro|ru|rw|sa|sb|sc|sd|se|sg|sh|si|sj|sk|sl|sm|sn|so|sr|st|su|sv|sy|sz|tc|td|tf|tg|th|tj|tk|tm|tn|to|tp|tr|tt|tv|tw|tz|ua|ug|uk|um|us|uy|uz|va|vc|ve|vg|vi|vn|vu|wf|ws|ye|yt|yu|za|zm|zw)$|(([0-9][0-9]?|[0-1][0-9][0-9]|[2][0-4][0-9]|[2][5][0-5])\.){3}([0-9][0-9]?|[0-1][0-9][0-9]|[2][0-4][0-9]|[2][5][0-5]))$/i", $email));
    }

    if (!defined("PHP_EOL")) {
        define("PHP_EOL", "\r\n");
    }

    $registrant_name     = $_POST['name'];
    $registrant_email    = $_POST['email'];
    $status = "Submitted";

    //$connection=mysqli_connect("localhost", "root", "root", "posystem");

    $connection = new PDO("mysql:host=localhost;dbname=pharma", "root", "");
    $connection -> exec("set names utf8");
    $stmt = $connection->prepare("INSERT INTO  registration (title, last_name, first_name, organisation, address, 
                           postal_code, city, country, phone, email, status, other_details) 
                         VALUES (:title, :last_name, :first_name, :organisation, :address, 
                                 :postal_code, :city, :country, :phone, :email, :status, :other_details)");

    $stmt->bindParam("title",  $_POST['title'], PDO::PARAM_STR);
    $stmt->bindParam("last_name",  $_POST['familyname'], PDO::PARAM_STR);
    $stmt->bindParam("first_name",  $_POST['name'], PDO::PARAM_STR);
    $stmt->bindParam("organisation",  $_POST['organisation'], PDO::PARAM_STR);
    $stmt->bindParam("postal_code",  $_POST['postal_code'], PDO::PARAM_STR);
    $stmt->bindParam("city",  $_POST['city'], PDO::PARAM_STR);
    $stmt->bindParam("country",  $_POST['country'], PDO::PARAM_STR);
    $stmt->bindParam("phone",  $_POST['phone'], PDO::PARAM_STR);
    $stmt->bindParam("email",  $_POST['email'], PDO::PARAM_STR);
    $stmt->bindParam("status",  $status, PDO::PARAM_STR);
    $stmt->bindParam("address",  $_POST['address'], PDO::PARAM_STR);
    $stmt->bindParam("other_details",  $_POST['comment'], PDO::PARAM_STR);



    $stmt->execute();



    $company_email_address = "admin@mets-limited.com";
    $e_subject = 'PHARMACONNECT REGISTRATION';
    $e_body = "Congratulation $registrant_name , you have successfully registered for the 2024 Pharmaconnect.." . PHP_EOL . PHP_EOL;
    $e_content = "We look forward to seeing you." . PHP_EOL . PHP_EOL;

    $e_reply = "You can contact us for any further clarifications  via email, info@pharmaconnect.com ";
    $msg = wordwrap($e_body . $e_content . $e_reply, 70);


    $host= "server334.web-hosting.com";


    $recipient1 = $registrant_email;
//    $recipient2 = "etheedentechnologies@gmail.com";

    include "PHPMailer.php";
    include "SMTP.php";
    // include "Exception.php";




    //Create an instance; passing 'true' enables exceptions
    $mail = new PHPMailer(false);

    try {
        //Server settings
        // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = $host;                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = $company_email_address;                 //SMTP username
        $mail->Password   = 'Maiwaseh@us2028';                      //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            //Enable implicit TLS encryption
        $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set 'SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS'

        //Recipients
        $mail->setFrom($company_email_address, 'Mailer');
        $mail->addAddress($registrant_email, 'Joe User');     //Add a recipient
//        $mail->addAddress($recipient2);               //Name is optional
        $mail->addReplyTo('info@pharmaconnect.com', 'Information');
        // $mail->addCC('cc@example.com');
        // $mail->addBCC('bcc@example.com');

        //Attachments
        // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
        // $mail->addAttachment('/tmp/image-min.jpg', 'new-min.jpg');    //Optional name

        //Content
        $mail->isHTML(false);                                  //Set email format to HTML
        $mail->Subject = $e_subject;
        $mail->Body    = $msg;
        // $mail->setEHLOCommand(true);


        $mail->send();
        echo 'Message has been sent';
    } catch (Exception $e) {
        // echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
