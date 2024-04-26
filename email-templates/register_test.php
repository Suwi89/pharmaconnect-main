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
    $organisation = $_POST['organisation'];
    $address = $_POST['address'];
    $postal_code = $_POST['postal_code'];
    $city = $_POST['city'];
    $country = $_POST['country'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $status = "submited";
    $other_details = $_POST['comment'];

    // Prepare and execute SQL statement to insert user data into the database
    $stmt = $conn->prepare("INSERT INTO test_registration (title, last_name, first_name, organisation, address, 
                           postal_code, city, country, phone, email, status, other_details) 
                           VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssssssss", $title, $last_name, $first_name, $organisation, $address, 
                      $postal_code, $city, $country, $phone, $email, $status, $other_details);
    if ($stmt->execute()) {
        // Send email with user data
        send_email_with_userdata($title, $last_name, $first_name, $organisation, $address, 
                                 $postal_code, $city, $country, $phone, $email, $status, $other_details);
        header("Location: success.html");
        exit;
    } else {
        echo "Error: " . $stmt->error;
    }
}

function send_email_with_userdata($title, $last_name, $first_name, $organisation, $address, 
                                  $postal_code, $city, $country, $phone, $email, $status, $other_details) {
    // Configure email settings (SMTP server, sender, recipients, etc.)
    $to = 'cathbertbusiku@gmail.com';
    $subject = 'New Registration';
    $message = "New user registration:\n\n";
    $message .= "Title: $title\n";
    $message .= "Last Name: $last_name\n";
    $message .= "First Name: $first_name\n";
    $message .= "Organisation: $organisation\n";
    $message .= "Address: $address\n";
    $message .= "Postal Code: $postal_code\n";
    $message .= "City: $city\n";
    $message .= "Country: $country\n";
    $message .= "Phone: $phone\n";
    $message .= "Email: $email\n";
    $message .= "Status: $status\n";
    $message .= "Other Details: $other_details\n";

    $headers = "From: info@pharmaconnectafrica.com\r\n";
    $headers .= "Reply-To: aaronmwelwa@gmail.com\r\n";

    mail($to, $subject, $message, $headers);
}

$conn->close();
?>