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
    $abstract_theme = $_POST['abstract_theme'];
    $title = $_POST['title'];
    $last_name = $_POST['last_name'];
    $first_name = $_POST['first_name'];
    $position = $_POST['position'];
    $institution = $_POST['institution'];
    $department = $_POST['department'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $country = $_POST['country'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $abstracttitle = $_POST['abstracttitle'];
    $submissiontype = $_POST['submissiontype'];
    $abstract = $_POST['abstract'];
    $keywords = $_POST['keywords'];
    $status = "submited";
  
    // Prepare and execute SQL statement to insert user data into the database
    $stmt = $conn->prepare("INSERT INTO abstract (abstract_theme, title, last_name, first_name, position, institution,
                            department, address, city, country, phone, email, abstracttitle, submissiontype, abstract, keywords, status ) 
                           VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    $stmt->bind_param("sssssssssssssssss", $abstract_theme, $title, $last_name, $first_name, $position, $institution, 
                      $department, $address, $city, $country, $phone, $email, $abstracttitle, $submissiontype, $abstract, $keywords, $status);
    if ($stmt->execute()) {
        // Send email with user data
        send_email_with_userdata($abstract_theme, $title, $last_name, $first_name, $position, $institution, 
                                 $department, $address, $city, $country, $phone, $email, $abstracttitle, $submissiontype, $abstract, $keywords, $status);
        header("Location: ../abstract-success.php");
        exit;
    } else {
        echo "Error: " . $stmt->error;
    }
}

function send_email_with_userdata($abstract_theme, $title, $last_name, $first_name, $position, $institution, 
                                  $department, $address, $city, $country, $phone, $email, $abstracttitle, $submissiontype, $abstract, $keywords, $status) {
    // Configure email settings (SMTP server, sender, recipients, etc.)
    $to_admin = 'info@pharmaconnectafrica.com, mramshaw@pharmasystafrica.com';
    // Email address of the administrator
    $to_user = $email; // User's email address
    $subject_admin = 'Abstract Submission'; 
    
    // Message for admin email
    $message_admin = "
    <html>
    <head>
    <title>Abstract Submission</title>
    </head>
    <body>
    <p>Dear Admin,</p>
    <p>{$first_name} {$last_name} has just submitted their abstract:</p>
    <p><strong>Abstract Theme:</strong> {$abstract_theme}</p>
    <p><strong>Title:</strong> {$title}</p>
    <p><strong>Last Name:</strong> {$last_name}</p>
    <p><strong>First Name:</strong> {$first_name}</p>
    <p><strong>Position:</strong> {$position}</p>
    <p><strong>Institution:</strong> {$institution}</p>
    <p><strong>Department:</strong> {$department}</p>
    <p><strong>Address:</strong> {$address}</p>
    <p><strong>City:</strong> {$city}</p>
    <p><strong>Country:</strong> {$country}</p>
    <p><strong>Phone:</strong> {$phone}</p>
    <p><strong>Email:</strong> {$email}</p>
    <p><strong>Abstract Title:</strong> {$abstracttitle}</p>
    <p><strong>Submission Type:</strong> {$submissiontype}</p>
    <p><strong>Abstract:</strong> {$abstract}</p>
    <p><strong>Keywords:</strong> {$keywords}</p>
    <p><strong>Status:</strong> {$status}</p>
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
                                                                                            <h2>Confirmation of your abstract submission </h2>
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
                                                                                            <p>You have successfully submitted your abstract for PharmaConnect Africa Conference 2024. We appreciate your contribution and look forward to potentially including it in our conference program..</p>
                                                                                            <p>Please note that you will be informed about the acceptance of your abstract by 14 June 2024. Should your abstract be accepted, we encourage you to register for the conference as soon as possible to take advantage of our early bird rate, which is available until 21 June 2024.</p>
                                                                                            <p>Should you need any further information or have any questions regarding your submission or the registration process, please feel free to contact us at info@pharmaconnectafrica.com.</p>
                                                                                            <p>We are excited about your interest in the PharmaConnect Conference 2024 and eagerly anticipate your participation.    </p>
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