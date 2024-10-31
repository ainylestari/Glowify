<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Artikel kecantikan</title>
</head>
<body>
    <form method="POST" action="index.php" enctype="multipart/form-data">
        <label>Title:</label><br>
        <input type="text" name="title" placeholder="Title" required><br><br>

        <label>Pesan:</label><br>
        <textarea name="pesan" placeholder="Pesan" rows="5" cols="25" required></textarea><br><br>

        <label>Image:</label><br>
        <input type="file" name="image" required><br><br>

        <label>Category:</label><br>
        <select name="category" required>
            <option value="123123">Beauty</option>
            <option value="123231">Makeup</option>
            <option value="123321">Fashion</option>
        </select><br><br>

        <input type="submit" name="submit" value="Kirim">
    </form>
</body>
</html>
