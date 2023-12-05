<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Søknadsskjema</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        h2 {
            text-align: center;
            color: #333;
        }

        form {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #333;
        }

        input, select, textarea {
            width: 100%;
            padding: 8px;
            margin-bottom: 16px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        textarea {
            resize: vertical;
        }

        button {
            background-color: #4caf50;
            color: #fff;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

    <h2>Fyll ut skjema for å søke</h2>

    <form action="../controllers//user.con.php" method="post"  enctype="multipart/form-data">

        <label for="firstName">Fornavn:</label>
        <input type="text" id="firstName" name="firstName" novalidate>

        <label for="lastName">Etternavn:</label>
        <input type="text" id="lastName" name="lastName" novalidate>

        <label for="email">E-post:</label>
        <input type="text" id="email" name="email"novalidate>

        <!--her skulle jeg egentlig ha brukt getAllLocations metoden-->
        <label for="city">By:</label> 
        <select id="city" name="city" novalidate>
            <option value="oslo">Oslo</option>
            <option value="bergen">Bergen</option>
        
        </select>

        <label for="address">Adresse:</label>
        <input type="text" id="address" name="address" novalidate>

        <label for="application">Søknadstekst (maks 500 ord):</label>
        <textarea id="application" name="application" maxlength="500" novalidate></textarea>

    
        <button type="submit" name="submitApplication">Send inn søknad</button>

    </form>

</body>
</html>
