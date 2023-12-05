
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Company Profile Form</title>
</head>
<body>

    <h2>Company Profile</h2>
    
    <form action="/submit_company_profile" method="post" novalidate>
        <label for="companyID">Company ID:</label>
        <input type="text" id="companyID" name="companyID"><br>

        <label for="companyName">Company Name:</label>
        <input type="text" id="companyName" name="companyName"><br>

        <label for="companyLeaderID">Company Leader ID:</label>
        <input type="text" id="companyLeaderID" name="companyLeaderID"><br>

        <label for="companyEmail">Company Email:</label>
        <input type="email" id="companyEmail" name="companyEmail"><br>

        <label for="description">Description:</label><br>
        <textarea id="description" name="description" rows="4" cols="50"></textarea><br>

        <input type="submit" value="Submit">
    </form>

</body>
</html>
