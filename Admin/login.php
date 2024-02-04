<?php
// session_start();
require("config.php");



// if ($_SERVER['REQUEST_METHOD'] === "POST") {

//     $username = mysqli_real_escape_string($conn, $_POST['username']);
//     $password = $_POST['password']; 
    
//     $qry = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username'");

//     if (mysqli_num_rows($qry) > 0) {
//         $row = mysqli_fetch_assoc($qry);

        
//         if (password_verify($password, $row['password'])) {
//             $_SESSION['UID'] = $row['id'];
//             $_SESSION['UNAME'] = $row['username'];
//             $_SESSION['UROLE'] = $row['role'];

//             if ($_SESSION['UROLE'] == 'Admin') {
//                 // $response = array("success" => true, "message" => "Admin Login Successful");
//                 echo "<script>alert('Login Success')</script>";
//             } else {
//                 // $response = array("error" => true, "message" => "Not Admin");
//                 echo "<script>alert('Login Not')</script>";
//             }
//         } else {
//             // $response = array("error" => true, "message" => "Invalid Password");
//             echo "<script>alert('Login Invalid')</script>";
//         }
//     } else {
//         // $response = array("error" => true, "message" => "Invalid Username");
//         echo "<script>alert('Login Useername')</script>";
//     }
// } else {
//     // $response = array("error" => true, "message" => "Invalid Request");
// }






if ($_SERVER['REQUEST_METHOD'] === "POST") {

        $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = $_POST['password']; 
    
    $qry = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username'");

    if (mysqli_num_rows($qry) > 0) {
        $row = mysqli_fetch_assoc($qry);

        
        if (password_verify($password, $row['password'])) {
            $_SESSION['UID'] = $row['id'];
            $_SESSION['UNAME'] = $row['username'];
            $_SESSION['UROLE'] = $row['role'];

            if ($_SESSION['UROLE'] == 'Admin') {
                $response = array("success" => true, "message" => "Admin Login Successful");
            } else {
                $response = array("error" => true, "message" => "Not Admin");
            }
        } else {
            $response = array("error" => true, "message" => "Invalid Password");
        }
    } else {
        $response = array("error" => true, "message" => "Invalid Username");
    }
} else {
    $response = array("error" => true, "message" => "Invalid Request");
}
header('Content-Type: application/json');
echo json_encode($response);
?>