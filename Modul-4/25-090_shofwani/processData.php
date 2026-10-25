<h3>Posted data: </h3>
<?php
foreach ($_POST as $key => $value)
    echo "($key) => ($value)<br/>";

//$surname = $_POST['surname'];

require 'validate.inc'; if
(validateName($_POST, 'surname'))
echo 'Data OK!';
else
echo 'Data invalid!';
?>