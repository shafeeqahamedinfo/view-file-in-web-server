<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>File Upload Dashboard</title>
    <link rel="icon" href="recycle final logo 2.png" type="image/png">
    <style>
        /* Basic Styles */
        body {
            font-family: 'Arial', sans-serif;
            background: #1a1a1a;
            color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        header {
            text-align: center;
            padding: 50px 20px 20px;
            animation: fadeInDown 1.5s ease;
        }

        h1 {
            font-size: 3em;
            color: gold;
            margin: 0;
        }

        p {
            font-size: 1.2em;
            margin-top: 10px;
            color: lightgray;
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: calc(100vh - 150px);
        }

        .card {
            background: #000;
            border: 2px solid gold;
            border-radius: 15px;
            padding: 30px 50px;
            margin: 0 20px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
            animation: fadeInUp 1.5s ease;
        }

        .card:hover {
            transform: scale(1.1);
            box-shadow: 0px 0px 20px rgba(212,175,55,0.8);
        }

        .card h2 {
            font-size: 2em;
            color: gold;
        }

        .card p {
            color: #f4f4f4;
            margin-top: 10px;
            font-size: 1em;
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        /* Animations */
        @keyframes fadeInDown {
            from { opacity: 0; transform: translateY(-50px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(50px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Footer */
        footer {
            text-align: center;
            padding: 20px;
            color: lightgray;
            font-size: 0.9em;
        }
    </style>
</head>
<body>
    <header>
        <h1>📁 File Manager</h1>
        <p>Upload, view, and manage your files with style!</p>
    </header>

    <div class="container">
        <a href="upload.php">
            <div class="card">
                <h2>Upload Files</h2>
                <p>Select single or multiple files to upload.</p>
            </div>
        </a>
        <a href="view.php">
            <div class="card">
                <h2>View Files</h2>
                <p>Preview and delete uploaded files.</p>
            </div>
        </a>
    </div>

    <footer>
        &copy; <?php echo date("Y"); ?> Your File Upload System
    </footer>
</body>
</html>
