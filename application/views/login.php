<!doctype html>
<html>
<head>
    <title>Sign-in / Sign-Up</title>
    <link href="assets/css/login.css" rel="stylesheet" type="text/css" />
</head>
<body>
    <form id='form' action='/index.php/login/signin' method='POST'>
        <label for='username'>Username: </label>
        <input type='text' name='username' id='username'/><br />
        <label for='username'>Password (min. 8 char): </label>
        <input type='password' name='password' id='password'/><br />
        <a href='#' onclick='forgot();'>Forgot password ?</a><br />
        <input class='validate' type='submit' name='send' id='send' value='Sign-In'>
        <input type='hidden' name='log'>
        <input class='validate' type='submit' name='send' id='sign' value='Sign-Up' hidden>
    </form>
    <script>

    </script>
</body>
</html>