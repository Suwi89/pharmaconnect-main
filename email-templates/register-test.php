<?php
// Connect to your MySQL database
$host = 'localhost';
$username = 'psaweb__admin';
$password = 'r3KP3&5r$7V,';
$dbname = 'psaweb_pharma';
$conn = new mysqli($host, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Extract user data from the request
    $registration_type = $_POST['registration_type'];
    $title = $_POST['title'];
    $last_name = $_POST['familyname'];
    $first_name = $_POST['name'];
    $organisation = $_POST['organisation'];
    $address = $_POST['address'];
    $postal_code = $_POST['postal-code'];
    $city = $_POST['city'];
    $country = $_POST['country'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $status = "submited";
    $other_details = $_POST['comment'];

    // Get current date and time
    $create_date = date("Y-m-d H:i:s");

    // Prepare and execute SQL statement to insert user data into the database
    $stmt = $conn->prepare("INSERT INTO test_registration (registration_type, title, last_name, first_name, organisation, address, 
                        postal_code, city, country, phone, email, status, other_details, createDate) 
                        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssssssssss", $registration_type, $title, $last_name, $first_name, $organisation, $address, 
                    $postal_code, $city, $country, $phone, $email, $status, $other_details, $create_date);
    if ($stmt->execute()) {
        // Send email with user data
        send_email_with_userdata($registration_type, $title, $last_name, $first_name, $organisation, $address, 
                                $postal_code, $city, $country, $phone, $email, $status, $other_details);
        header("Location: ../register-success.php");
        exit;
    } else {
        echo "Error: " . $stmt->error;
    }
}

function send_email_with_userdata($registration_type, $title, $last_name, $first_name, $organisation, $address, 
                                  $postal_code, $city, $country, $phone, $email, $status, $other_details) {
  
    $to_admin = 'info@pharmaconnectafrica.com, mramshaw@pharmasystafrica.com';
    $to_user = $email; // User's email address
    $subject_admin = 'ðŸŽ‰ New Registration Alert! ðŸŽ‰';
    
    // Message for admin email
    $message_admin = "
        <html>
        <head>
        <title>New User Registration</title>
        </head>
        <body>
        <p>Dear Admin,</p>
        <p>A new user has just registered:</p>
        <p><strong>Registration Type:</strong> {$registration_type}</p>
        <p><strong>Title:</strong> {$title}</p>
        <p><strong>Last Name:</strong> {$last_name}</p>
        <p><strong>First Name:</strong> {$first_name}</p>
        <p><strong>Organisation:</strong> {$organisation}</p>
        <p><strong>Address:</strong> {$address}</p>
        <p><strong>Postal Code:</strong> {$postal_code}</p>
        <p><strong>City:</strong> {$city}</p>
        <p><strong>Country:</strong> {$country}</p>
        <p><strong>Phone:</strong> {$phone}</p>
        <p><strong>Email:</strong> {$email}</p>
        <p><strong>Status:</strong> {$status}</p>
        <p><strong>Other Details:</strong> {$other_details}</p>
        </body>
        </html>
    ";

    // Message for user email
    $e_subject = 'ðŸŽ‰ Confirmation of your registration for PharmaConnect Africa Conference 2024 ðŸŽ‰';
    $e_body = "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
    <html dir='ltr' xmlns='http://www.w3.org/1999/xhtml' xmlns:o='urn:schemas-microsoft-com:office:office'>
    
    <head>
        <meta charset='UTF-8'>
        <meta content='width=device-width, initial-scale=1' name='viewport'>
        <meta name='x-apple-disable-message-reformatting'>
        <meta http-equiv='X-UA-Compatible' content='IE=edge'>
        <meta content='telephone=no' name='format-detection'>
        <title></title>
       
        <link href='https://fonts.googleapis.com/css2?family=Josefin+Sans&display=swap' rel='stylesheet'>
        
    </head>
    
    <body style='font-family: 'Kumbh Sans', sans-serif;'>
        <div dir='ltr' class='es-wrapper-color'>
           
            <table class='es-wrapper' width='100%' cellspacing='0' cellpadding='0'>
                <tbody>
                    <tr>
                        <td class='esd-email-paddings' valign='top'>
                            <table cellpadding='0' cellspacing='0' class='esd-header-popover es-header' align='center'>
                                <tbody>
                                    <tr>
                                        <td class='esd-stripe' align='center'>
                                            <table bgcolor='#ffffff' class='es-header-body' align='center' cellpadding='0' cellspacing='0' width='600'>
                                                <tbody>
                                                    <tr>
                                                        <td class='esd-structure es-p40' align='left' background='https://tlr.stripocdn.email/content/guids/CABINET_0fa486e736790bd0e3fdb2f0eb814a76/images/hectorjrivas1fxmet2u5duunsplash_1.png' style='background-image: url(https://tlr.stripocdn.email/content/guids/CABINET_0fa486e736790bd0e3fdb2f0eb814a76/images/hectorjrivas1fxmet2u5duunsplash_1.png); background-repeat: no-repeat; background-position: center top;'>
                                                            
                                                            <table cellpadding='0' cellspacing='0' class='es-left' align='left'>
                                                                <tbody>
                                                                    <tr>
                                                                        <td width='156' class='es-m-p0r es-m-p20b esd-container-frame' valign='top' align='center'>
                                                                            <table cellpadding='0' cellspacing='0' width='100%'>
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <td align='center' class='esd-block-image es-m-txt-c es-p15b' style='font-size: 0px;'><a target='_blank' href='https://pharmaconnectafrica.com/'><img src='images/PharmaConnect Logo Main.png' alt style='display: block;' height='60'></a></td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                            
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <table cellpadding='0' cellspacing='0' class='es-content' align='center'>
                                <tbody>
                                    <tr>
                                        <td class='esd-stripe' align='center'>
                                            <table bgcolor='#ffffff' class='es-content-body' align='center' cellpadding='0' cellspacing='0' width='600'>
                                                <tbody>
                                                    <tr>
                                                        <td class='esd-structure es-p40t es-p30b es-p40r es-p40l es-m-p0b' align='cnter'>
                                                            <table cellpadding='0' cellspacing='0' width='100%'>
                                                                <tbody>
                                                                    <tr>
                                                                        <td width='520' align='center' class='esd-container-frame'>
                                                                            <table cellpadding='0' cellspacing='0' width='100%'>
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <td align='center' class='esd-block-text' style='color: #dd6531;'>
                                                                                            <h2>Confirmation of your registration</h2>
                                                                                            <h2>for PharmaConnect Africa Conference 2024</h1>
                                                                                        </td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class='esd-structure es-p30b es-p40r es-p40l' align='left'>
                                                            <table cellpadding='0' cellspacing='0' width='100%'>
                                                                <tbody>
                                                                    <tr>
                                                                        <td width='520' class='esd-container-frame' align='center' valign='top'>
                                                                            <table cellpadding='0' cellspacing='0' width='100%'>
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <td align='left' class='esd-block-text'>
                                                                                            <h3>Congratulations <?php echo $first_name; ?>!</p> ðŸŒŸ</h3>
                                                                                            <p>You have successfully registered for PharmaConnect Africa Conference 2024.</p>
                                                                                            <p>We are thrilled to have you join us and look forward to your participation.</p>
                                                                                            <h3>Invoice and Payment Information:</h3>
                                                                                            <p>Shortly, you will receive an invoice for your registration. Please note that we do not currently offer an online payment system. If you have registered before 21 June 2024, to benefit from our reduced early bird rate, you will need to initiate payment before
                                                                                             this date. Payments initiated after June 21 but before August 18 will be subject to the standard rate. Any payments received thereafter will be processed at the on-site registration rate.</p>
                                                                                            <p>If you have any further questions or need assistance, please feel free to contact us at info@pharmaconnectafrica.com.<br><br></p>
          
                                                                                             <p>Warm Regards,</p>
                                                                                            <p>Mandi Ramshaw</p>
                                                                                        </td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <table cellpadding='0' cellspacing='0' class='es-content' align='center'>
                                <tbody>
                                    <tr>
                                        <td class='esd-stripe' align='center'>
                                            <table bgcolor='#ffffff' class='es-content-body' align='center' cellpadding='0' cellspacing='0' width='600'>
                                                <tbody>
                                                    <tr>
                                                        <td class='esd-structure es-p20t es-p40b es-p40r es-p40l' align='left'>
                                                           
                                                            <table cellpadding='0' cellspacing='0' class='es-right' align='center'>
                                                                <tbody>
                                                                    <tr>
                                                                        
                                                                        <td align='center' class='esd-block-text text-center'>
                                                                            <h3>PharmaConnect Africa Conference 2024 Team</h3>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                            <!--[if mso]></td></tr></table><![endif]-->
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <table cellpadding='0' cellspacing='0' class='es-footer' align='center'>
                                <tbody>
                                    <tr>
                                        <td class='esd-stripe' align='center'>
                                            <table bgcolor='#ffffff' class='es-footer-body' align='center' cellpadding='0' cellspacing='0' width='600'>
                                                <tbody>
                                                    <tr>
                                                        <td class='esd-structure es-p30t es-p30b es-p40r es-p40l' align='left' background='https://tlr.stripocdn.email/content/guids/CABINET_0fa486e736790bd0e3fdb2f0eb814a76/images/hectorjrivas1fxmet2u5duunsplash_1.png' style='background-image: url(https://tlr.stripocdn.email/content/guids/CABINET_0fa486e736790bd0e3fdb2f0eb814a76/images/hectorjrivas1fxmet2u5duunsplash_1.png); background-repeat: no-repeat; background-position: center top;'>
                                                            <!--[if mso]><table width='520' cellpadding='0' cellspacing='0'><tr><td width='194' valign='top'><![endif]-->
                                                            <table cellpadding='0' cellspacing='0' align='left' class='es-left'>
                                                                <tbody>
                                                                    <tr>
                                                                        <td width='194' class='esd-container-frame es-m-p20b' align='left'>
                                                                            <table cellpadding='0' cellspacing='0' width='100%'>
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <td align='center' class='esd-block-image es-m-txt-c es-p15b' style='font-size: 0px;'><a target='_blank' href='https://pharmaconnectafrica.com/'><img src='images/PharmaConnect Logo Main.png' alt style='display: block;' height='60'></a></td>
                                                                                    </tr>
                                                                                    
                                                                                </tbody>
                                                                            </table>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                            <!--[if mso]></td><td width='20'></td><td width='306' valign='top'><![endif]-->
                                                            <table cellpadding='0' cellspacing='0' class='es-right' align='right'>
                                                                <tbody>
                                                                    <tr>
                                                                        <td width='306' align='left' class='esd-container-frame'>
                                                                            <table cellpadding='0' cellspacing='0' width='100%'>
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <td align='center' class='esd-block-text es-p5t es-p15b'>
                                                                                          
                                                                                            <p><a target='_blank' href='mailto:info@pharmaconnectafrica.com.' style='text-decoration: underline; font-size: 14px;'>info@pharmaconnectafrica.com.</a></p>
                                                                                            <p><a > +260 97 3886276&nbsp;</a></p>
                                                                                        </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                            <!--[if mso]></td></tr></table><![endif]-->
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                           
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </body>
    
    </html>
    ";
    
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers .= "From: info@pharmaconnectafrica.com\r\n";
    $headers .= "Reply-To: info@pharmaconnectafrica.com\r\n";

    // Send emails to admin and user
    mail($to_admin, $subject_admin, $message_admin, $headers);
    mail($to_user, $e_subject, $e_body, $headers);
}


$conn->close();
?>