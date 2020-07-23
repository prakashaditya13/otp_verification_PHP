<?php 

session_start();

if(isset($_SESSION['success']) && isset($_SESSION['session_id'])){
    echo "<form action='otp-verify.php' method='post'>
            <label for='otp-enter'>Enter OTP</label>
            <input type='number' name='otp-enter' id='otp-enter' required>
            <button type='submit'>Verify</button>
            </form><br><p>Your otp will expire after 5 minutes.</p>";
}else{
    echo "<p>Not Response from the server</p>";
    header("Location: index.php");
}

?>

