<?php
echo "richiesta POST";
var_dump($_POST);
if($_POST && isset($_POST['submit']))
{
    var_dump($_FILES);
    var_dump($_FILES);
    $contenuto = file_get_contents($_FILES['file1']['tmp_name']);
    $contenuto_decod = json_encode($contenuto, true);
    var_dump($contenuto_decod);
    foreach($contenuto_decod as $key => $value)
    {
        var_dump($key);
        var_dump($value);
    }

    



}
?>

?>
<!DOCTYPE html>
<html>
    <body>
        <form action="" method="post" enctype="multipart/form-data">
        Select image to upload:
            <input type="file" name="fileToUpload" id="fileToUpload">
            <input type="file" name="abd" id="abd">
            <input type="submit" value="Upload Image" name="submit">
        </form>
    </body>
</html>