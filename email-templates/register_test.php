<?php
// Connect to your MySQL database
$host = 'localhost';
$username = 'ebxnfpmy_attach';
$password = 'X08oeh=n&LUt';
$dbname = 'ebxnfpmy_attachments_db';
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

    // Prepare and execute SQL statement to insert user data into the database
    $stmt = $conn->prepare("INSERT INTO test_registration (registration_type, title, last_name, first_name, organisation, address, 
                           postal_code, city, country, phone, email, status, other_details) 
                           VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssssssssss",$registration_type, $title, $last_name, $first_name, $organisation, $address, 
                      $postal_code, $city, $country, $phone, $email, $status, $other_details);
    if ($stmt->execute()) {
        // Send email with user data
        send_email_with_userdata($registration_type, $title, $last_name, $first_name, $organisation, $address, 
                                 $postal_code, $city, $country, $phone, $email, $status, $other_details);
        header("Location: register-success.php");
        exit;
    } else {
        echo "Error: " . $stmt->error;
    }
}

function send_email_with_userdata($registration_type, $title, $last_name, $first_name, $organisation, $address, 
                                  $postal_code, $city, $country, $phone, $email, $status, $other_details) {
    // Configure email settings (SMTP server, sender, recipients, etc.)
    $to_admin = 'cathbertbusiku@gmail.com, aaronmwelwa@gmail.com'; // Email address of the administrator
    $to_user = $email; // User's email address
    $subject_admin = '🎉 New Registration Alert! 🎉';
    
    // Message for admin email
    $message_admin = "Dear Admin,\n\n";
    $message_admin .= "A new user has just registered:\n\n";
    $message_admin .= "Registation Type: $$registration_type\n";
    $message_admin .= "Title: $title\n";
    $message_admin .= "Last Name: $last_name\n";
    $message_admin .= "First Name: $first_name\n";
    $message_admin .= "Organisation: $organisation\n";
    $message_admin .= "Address: $address\n";
    $message_admin .= "Postal Code: $postal_code\n";
    $message_admin .= "City: $city\n";
    $message_admin .= "Country: $country\n";
    $message_admin .= "Phone: $phone\n";
    $message_admin .= "Email: $email\n";
    $message_admin .= "Status: $status\n";
    $message_admin .= "Other Details: $other_details\n";

    // Message for user email
    $e_subject = '🎉 Confirmation of your registration for PharmaConnect Africa Conference 2024 🎉';
    $e_body = "Dear $first_name,\n\n";
    $e_body .= "Congratulations! You have successfully registered for PharmaConnect Africa Conference 2024. We are thrilled to have you join us and look forward to your participation.\n\n";
    $e_payment_header = "Invoice and Payment Information:\n";
    $e_payment_detail = " Shortly, you will receive an invoice for your registration. Please note that we do not currently offer an online payment system. If you have registered before 21 June 2024, to benefit from our reduced early bird rate, you will need to initiate payment before
                        this date. Payments initiated after June 21 but before August 18 will be subject to the standard rate. Any payments received thereafter will be processed at the on-site registration rate.
                        \n\n";
    $e_reply = "Should you need any further information or have any questions, please feel free to contact us at info@pharmaconnectafrica.com.";
    $msg = wordwrap($e_body . $e_payment_header . $e_payment_detail . $e_reply, 70);

    $headers = "From: info@pharmaconnectafrica.com\r\n";
    $headers .= "Reply-To: info@pharmaconnectafrica.com\r\n";

    // Send emails to admin and user
    mail($to_admin, $subject_admin, $message_admin, $headers);
    mail($to_user, $e_subject, $msg, $headers);
}

$conn->close();
?>