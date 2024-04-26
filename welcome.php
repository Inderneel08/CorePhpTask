<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form</title>
</head>
<body>

    <h2 style="margin-left: 45%;">Submit form</h2>
    <br>
    <br>

    <form action="submit_form.php" method="post" style="margin-left: 45%;">
        <label for="full_name">Full Name:</label>
        <input type="text" name="full_name" id="full_name" required> <br> <br>

        <label for="phone_number">Phone Number:</label>
        <input type="number" name="phone_number" id="phone_number" maxlength="10" required> <br> <br>

        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required> <br> <br>

        <label for="subject">Subject:</label>
        <input type="text" name="subject" id="subject" required> <br> <br>

        <label for="message">Message:</label>
        <input type="text" name="message" id="message" required> <br> <br>

        <input type="submit" value="Submit">
    </form>


</body>
</html>