<?php
session_start();

// Check if admin is logged in
$isAdmin = isset($_SESSION["is_admin"]) && $_SESSION["is_admin"] === true;

// Database connection
$host = "localhost";
$user = "root";
$pass = "";
$db = "file_upload_demo";


$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle delete only if admin
$deleteMsg = "";
if ($isAdmin && $_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["delete_id"])) {
    $fileId = intval($_POST["delete_id"]);

    $res = $conn->query("SELECT file_path FROM files WHERE id=$fileId");
    if ($res && $res->num_rows > 0) {
        $row = $res->fetch_assoc();
        $filePath = $row["file_path"];

        if (file_exists($filePath)) {
            unlink($filePath);
        }
        $conn->query("DELETE FROM files WHERE id=$fileId");
        $deleteMsg = "✅ File deleted successfully!";
    }
}

// Fetch all files
$result = $conn->query("SELECT * FROM files ORDER BY uploaded_on DESC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Uploaded Files</title>
    <link rel="icon" href="recycle final logo 2.png" type="image/png">
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #1a1a1a;
            color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        h1 {
            text-align: center;
            color: gold;
        }
        .msg {
            text-align: center;
            font-weight: bold;
            margin: 10px 0;
            color: lightgreen;
        }
        .grid {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 16px;
            margin-top: 30px;
        }
        .card {
            background: #000;
            border: 2px solid gold;
            border-radius: 12px;
            padding: 10px;
            text-align: center;
            transition: 0.3s;
            width: 160px;
            margin: 0;
            box-sizing: border-box;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .card:hover {
            transform: scale(1.05);
            box-shadow: 0 0 15px rgba(212,175,55,0.7);
        }
        .card img {
            max-width: 100px;
            height: 100px;
            object-fit: contain;
            border-radius: 8px;
            background: #222;
            padding: 5px;
        }
        .filename {
            margin: 10px 0;
            font-weight: bold;
            color: gold;
            word-break: break-all;
            text-align: center;
        }
        .btn {
            display: inline-block;
            margin: 5px 3px;
            padding: 8px 12px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            text-decoration: none;
            font-size: 0.9em;
        }
        .btn-open {
            background: gold;
            color: black;
        }
        .btn-open:hover {
            background: darkgoldenrod;
        }
        .btn-delete {
            background: red;
            color: white;
        }
        .btn-delete:hover {
            background: darkred;
        }
        .back {
            text-align: center;
            margin-top: 20px;
        }
        .back a {
            color: gold;
            text-decoration: none;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <h1>📂 Uploaded Files</h1>

    <?php if ($deleteMsg): ?>
        <p class="msg"><?php echo $deleteMsg; ?></p>
    <?php endif; ?>

    <div class="grid">
        <?php if ($result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <div class="card">
                    <?php
                    $filePath = $row["file_path"];
                    $fileName = $row["file_name"];
                    $ext = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

                    // Show image preview for images
                    if (in_array($ext, ["jpg", "jpeg", "png", "gif"])) {
                        echo "<img src='$filePath' alt='Preview'>";
                    }
                    // PDF icon
                    elseif ($ext === "pdf") {
                        echo "<img src='https://img.icons8.com/ios-filled/100/fa314a/pdf.png' alt='PDF'>";
                    }
                    // Word icon
                    elseif (in_array($ext, ["doc", "docx"])) {
                        echo "<img src='https://img.icons8.com/ios-filled/100/0078d4/ms-word.png' alt='Word'>";
                    }
                    // Excel icon
                    elseif (in_array($ext, ["xls", "xlsx"])) {
                        echo "<img src='https://img.icons8.com/ios-filled/100/21c900/ms-excel.png' alt='Excel'>";
                    }
                    // PowerPoint icon
                    elseif (in_array($ext, ["ppt", "pptx"])) {
                        echo "<img src='https://img.icons8.com/ios-filled/100/fc7f03/ms-powerpoint.png' alt='PowerPoint'>";
                    }
                    // Text file icon
                    elseif ($ext === "txt") {
                        echo "<img src='https://img.icons8.com/ios-filled/100/ffffff/txt.png' alt='Text'>";
                    }
                    // Archive icon
                    elseif (in_array($ext, ["zip", "rar"])) {
                        echo "<img src='https://img.icons8.com/ios-filled/100/ffd700/zip.png' alt='Archive'>";
                    }
                    // Python icon
                    elseif ($ext === "py") {
                        echo "<img src='https://img.icons8.com/ios-filled/100/3776ab/python.png' alt='Python'>";
                    }
                    // JavaScript icon
                    elseif ($ext === "js") {
                        echo "<img src='https://img.icons8.com/ios-filled/100/f7df1e/javascript-logo.png' alt='JavaScript'>";
                    }
                    // HTML icon
                    elseif ($ext === "html") {
                        echo "<img src='https://img.icons8.com/ios-filled/100/e34c26/html-5.png' alt='HTML'>";
                    }
                    // CSS icon
                    elseif ($ext === "css") {
                        echo "<img src='https://img.icons8.com/ios-filled/100/1572b6/css3.png' alt='CSS'>";
                    }
                    // Animation/video icon
                    elseif (in_array($ext, ["mp4"])) {
                        echo "<img src='https://img.icons8.com/ios-filled/100/ffd700/film-reel.png' alt='MP4'>";
                    }
                    // Audio icon
                    elseif ($ext === "mp3") {
                        echo "<img src='https://img.icons8.com/ios-filled/100/ffffff/audio-wave.png' alt='MP3'>";
                    }
                    // TCL icon
                    elseif ($ext === "tcl") {
                        echo "<img src='https://img.icons8.com/ios-filled/100/ffffff/code-file.png' alt='TCL'>";
                    }
                    // SQL icon
                    elseif ($ext === "sql") {
                        echo "<img src='https://img.icons8.com/ios-filled/100/00758f/database.png' alt='SQL'>";
                    }
                    // Generic file icon
                    else {
                        echo "<img src='https://img.icons8.com/ios-filled/100/ffffff/file.png' alt='File'>";
                    }
                    ?>
                    <div class="filename"><?php echo htmlspecialchars($fileName); ?></div>
                    <a href="<?php echo $filePath; ?>" target="_blank" class="btn btn-open">Open</a>
                    <?php if ($isAdmin): ?>
                        <form method="POST" style="display:inline;">
                            <input type="hidden" name="delete_id" value="<?php echo $row["id"]; ?>">
                            <button type="submit" class="btn btn-delete">Delete</button>
                        </form>
                    <?php endif; ?>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p style="text-align:center;">No files uploaded yet.</p>
        <?php endif; ?>
    </div>

    <div class="back">
        <a href="index.php">⬅ Back to Dashboard</a>
        <?php if ($isAdmin): ?>
            | <a href="logout.php">Logout Admin</a>
        <?php else: ?>
            | <a href="admin.php">Admin Login</a>
        <?php endif; ?>
    </div>
</body>
</html>
