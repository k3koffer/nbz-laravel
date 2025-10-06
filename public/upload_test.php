<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    echo '<pre>';
    var_dump($_FILES);
    echo '</pre>';
}
?>
<form action="" method="post" enctype="multipart/form-data">
    <input type="file" name="testfile">
    <button type="submit">Upload</button>
</form>