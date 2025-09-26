<?php include 'db.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Upload Files</title>
    <link rel="icon" href="recycle final logo 2.png" type="image/png">
    <style>
        body {
            font-family: Arial;
            background: #1a1a1a;
            color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .upload-box {
            background: #000;
            padding: 20px;
            border: 2px solid gold;
            border-radius: 12px;
            text-align: center;
            box-shadow: 0px 0px 15px rgba(212, 175, 55, 0.7);
            width: 400px;
        }

        input[type="file"] {
            margin: 15px 0;
        }

        button {
            background: gold;
            border: none;
            padding: 10px 15px;
            cursor: pointer;
            font-weight: bold;
            border-radius: 8px;
        }

        button:hover {
            background: darkgoldenrod;
        }

        .messages {
            margin-top: 20px;
            text-align: left;
        }

        .success {
            color: lightgreen;
        }

        .error {
            color: red;
        }

        .warning {
            color: orange;
        }
    </style>
</head>

<body>
    <div class="upload-box">
        <h2>📂 Upload Multiple Files</h2>
        <form action="" method="post" enctype="multipart/form-data">
            <label for="fileInput" style="display: flex; flex-direction: column; align-items: center;">
                <img src="https://t3.ftcdn.net/jpg/15/01/81/42/360_F_1501814218_WW38AllTsgZUVtwjnK2yzrPwNOiAeYmm.jpg" alt="Upload" style="width: 300px; margin-bottom:10px;">
                <input 
                    type="file" 
                    name="files[]" 
                    multiple 
                    required 
                    id="fileInput"
                    style="
                        display: block;
                        margin: 0 auto 10px auto;
                        padding: 10px;
                        border: 2px solid gold;
                        border-radius: 8px;
                        background: #222;
                        color: gold;
                        font-weight: bold;
                        cursor: pointer;
                        width: 80%;
                        text-align: center;
                    "
                >
            </label>
            <br>
            <style>
                #fileInput {
                    transition: box-shadow 0.3s, border-color 0.3s;
                }
                #fileInput:focus, #fileInput:hover {
                    box-shadow: 0 0 8px gold;
                    border-color: gold;
                }
            </style>
            <button type="submit" name="upload">Upload</button>
        </form>
        <p><a href="view.php" style="color:gold;">➡ View Uploaded Files</a></p>

        <div class="messages">
            <?php
            if (isset($_POST['upload'])) {
                // ✅ Check if files are actually uploaded
                if (!empty($_FILES['files']['name'][0])) {
                    $targetDir = "uploads/";
                    if (!is_dir($targetDir)) mkdir($targetDir, 0777, true);

                    $allowTypes = array(
                        "jpg", "jpeg", "png", "gif", "pdf", "doc", "docx", "xls", "xlsx", "ppt", "pptx", "txt", "zip", "rar", "py", 
                        "js", "html", "css", "mp4", "mp3", "tcl", "sql", "json", "xml", "csv", "md", "bat", "sh", "c", "cpp", "java", 
                        "rb", "go", "rs", "php", "swift", "kt", "m", "r", "lua", "pl", "pm", "vbs", "ps1", "asm", "s", "h", "hpp", 
                        "ts", "tsx", "vue", "dart", "hs", "erl", "ex", "exs", "exe", "dll", "bin", "iso", "img", "dmg", "vmdk", 
                        "ova", "ovf", "apk", "ipa", "deb", "rpm", "msi", "7z", "tar", "gz", "bz2", "xz", "epub", "mobi", "azw3", 
                        "flac", "wav", "ogg", "aac", "wma", "mov", "avi", "mkv", "wmv", "flv", "swf", "file","c++", "c#", "visual basic"
                    );
                    $files = $_FILES['files'];

                    for ($i = 0; $i < count($files['name']); $i++) {
                        $fileName = basename($files["name"][$i]);
                        $fileType = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
                        $targetFilePath = $targetDir . time() . "_" . $fileName;

                        if (in_array($fileType, $allowTypes)) {
                            if (move_uploaded_file($files["tmp_name"][$i], $targetFilePath)) {
                                $sql = "INSERT INTO files (file_name, file_path) VALUES ('$fileName', '$targetFilePath')";
                                $conn->query($sql);
                                echo "<p class='success'>✔ Uploaded: $fileName</p>";
                            } else {
                                echo "<p class='error'>❌ Failed: $fileName</p>";
                            }
                        } else {
                            echo "<p class='warning'>⚠ Skipped (not allowed): $fileName</p>";
                        }
                    }
                } else {
                    echo "<p class='error'> No files selected!</p>";
                }
            }
            ?>
        </div>
    </div>
</body>

</html>