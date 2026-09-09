<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>C1</title>

    <link rel="stylesheet" href="css/style.css">
</head>
<body>


<form action="upload.php" method="POST" enctype="multipart/form-data"> 
  <input type="file" name="folder_files[]" webkitdirectory directory multiple required>
  <button type="submit" name="submit">Upload & Zip</button>
</form>

    
</body>
</html>