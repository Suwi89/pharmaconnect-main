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
    $stmt = $conn->prepare("INSERT INTO abstract (title, last_name, first_name, position, institution,
                            department, address, city, country, phone, email, abstracttitle, submissiontype, abstract, keywords, status ) 
                           VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    $stmt->bind_param("ssssssssssssssss", $title, $last_name, $first_name, $position, $institution, 
                      $department, $address, $city, $country, $phone, $email, $abstracttitle, $submissiontype, $abstract, $keywords, $status);
    if ($stmt->execute()) {
        // Send email with user data
        send_email_with_userdata($title, $last_name, $first_name, $position, $institution, 
                                 $department, $address, $city, $country, $phone, $email, $abstracttitle, $submissiontype, $abstract, $keywords, $status);
        header("Location: abstract-success.php");
        exit;
    } else {
        echo "Error: " . $stmt->error;
    }
}

function send_email_with_userdata($title, $last_name, $first_name, $position, $institution, 
                                  $department, $address, $city, $country, $phone, $email, $abstracttitle, $submissiontype, $abstract, $keywords, $status) {
    // Configure email settings (SMTP server, sender, recipients, etc.)
    $to_admin = 'cathbertbusiku@gmail.com, aaronmwelwa@gmail.com'; // Email address of the administrator
    $to_user = $email; // User's email address
    $subject_admin = 'Abstract Submission'; 
    
    // Message for admin email
    $message_admin = "Dear Admin,\n\n";
    $message_admin .= "$first_name $last_name has just submitted their abstract:\n\n";
    $message_admin .= "Title: $title\n";
    $message_admin .= "Last Name: $last_name\n";
    $message_admin .= "First Name: $first_name\n";
    $message_admin .= "Position: $position\n";
    $message_admin .= "Institution: $institution\n";
    $message_admin .= "Department: $department\n";
    $message_admin .= "Address: $address\n";
    $message_admin .= "City: $city\n";
    $message_admin .= "Country: $country\n";
    $message_admin .= "Phone: $phone\n";
    $message_admin .= "Email: $email\n";
    $message_admin .= "Abstract Title: $abstracttitle\n";
    $message_admin .= "Submission Type: $submissiontype\n";
    $message_admin .= "Abstract: $abstract\n";
    $message_admin .= "Keywords: $keywords\n";
    $message_admin .= "Status: $status\n";

    // Message for user email
    $e_subject = 'PHARMACONNECT REGISTRATION';
    $e_body = "Congratulations, $first_name! You have successfully sumbited your abstract for the 2024 Pharmaconnect." . PHP_EOL . PHP_EOL;
    $e_content = "We look forward to seeing you." . PHP_EOL . PHP_EOL;
    $e_reply = "You can contact us for any further clarifications via email, info@pharmaconnectafrica.com.";
    $msg = wordwrap($e_body . $e_content . $e_reply, 70);

    $headers = "From: info@pharmaconnectafrica.com\r\n";
    $headers .= "Reply-To: info@pharmaconnectafrica.com\r\n";

    // Send emails to admin and user
    mail($to_admin, $subject_admin, $message_admin, $headers);
    mail($to_user, $e_subject, $msg, $headers);

}


$conn->close();
?>