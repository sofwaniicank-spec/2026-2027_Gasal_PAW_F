<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Register</title>
    <style>
        body { font-family: Verdana, Arial, sans-serif; font-size: 12px; }
        fieldset { background: #dcdcff; border: 2px solid #6666cc; width: 420px; }
        .field label { display: inline-block; width: 110px; text-align: right; margin-right: 8px; vertical-align: top; }
    </style>
</head>
<body>
    <div id="container">
        <h1>Register</h1>
        <fieldset>
            <legend>Person Details</legend>
        <?php
        $errors = array();
        if (isset($_POST['surname']))
        {
        require 'validate.inc';
        validateName($errors, $_POST, 'surname');
        if ($errors)
        {
        echo '<h1>Invalid, correct the following errors:</h1>';
        foreach ($errors as $field => $error)
        echo "$field $error</br>";
        // tampilkan kembali form
        include 'form.inc';

        }
        else {
        echo 'Form submitted successfully with no errors';
        } } else
        // tampilkan kembali form
        include 'form.inc';
        ?>
        </fieldset>
        <h3>Posted data: </h3>
<?php
foreach ($_POST as $key => $value)
    echo "($key) => ($value)<br/>";

//$surname = $_POST['surname'];
?>
    </div>
</body>
</html>