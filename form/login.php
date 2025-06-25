<?php
session_start(); // Inicia la sesión para manejar el estado de login

// Si el usuario ya está logueado, redirigir al panel principal
if (isset($_SESSION['usuario_id'])) {
    header("Location: index.php");
    exit();
}

$mensaje = "";
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])) {
    // --- Conexión a la Base de Datos ---
    $servidor = "localhost"; $usuario_db = "root"; $clave_db = ""; $baseDeDatos = "form";
    $enlace = @mysqli_connect($servidor, $usuario_db, $clave_db, $baseDeDatos);
    if (!$enlace) { die("Error de conexión."); }

    $usuario = mysqli_real_escape_string($enlace, trim($_POST['usuario']));
    $clave = trim($_POST['clave']);

    if (empty($usuario) || empty($clave)) {
        $mensaje = "Debes ingresar usuario y contraseña.";
    } else {
        $sql = "SELECT id, usuario, clave FROM usuarios WHERE usuario = '$usuario'";
        $result = mysqli_query($enlace, $sql);

        if ($result && mysqli_num_rows($result) == 1) {
            $user_data = mysqli_fetch_assoc($result);
            // Verificar la contraseña hasheada
            if (password_verify($clave, $user_data['clave'])) {
                // Login exitoso: guardar datos en la sesión
                $_SESSION['usuario_id'] = $user_data['id'];
                $_SESSION['usuario_nombre'] = $user_data['usuario'];
                header("Location: index.php"); // Redirigir al panel principal
                exit();
            } else {
                $mensaje = "Usuario o contraseña incorrectos.";
            }
        } else {
            $mensaje = "Usuario o contraseña incorrectos.";
        }
    }
    mysqli_close($enlace);
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de Sesión</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style> body { font-family: 'Inter', sans-serif; } </style>
</head>
<body class="bg-gray-100 dark:bg-gray-900 flex justify-center items-center min-h-screen p-4">
    <div class="w-full max-w-sm">
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 md:p-8">
            <h2 class="text-2xl font-bold text-center text-gray-800 dark:text-white">Iniciar Sesión</h2>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="mt-8 space-y-6">
                <?php if (!empty($mensaje)): ?>
                    <div class="p-3 rounded-md text-sm bg-red-100 text-red-800"><?php echo $mensaje; ?></div>
                <?php endif; ?>
                <div>
                    <label for="usuario" class="text-sm font-medium text-gray-700 dark:text-gray-300">Nombre de Usuario</label>
                    <input type="text" name="usuario" id="usuario" class="mt-1 w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
                </div>
                <div>
                    <label for="clave" class="text-sm font-medium text-gray-700 dark:text-gray-300">Contraseña</label>
                    <input type="password" name="clave" id="clave" class="mt-1 w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
                </div>
                <button type="submit" name="login" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700">Ingresar</button>
            </form>
        </div>
        <p class="text-center text-sm text-gray-500 mt-6">
            ¿No tienes una cuenta? <a href="registrar.php" class="font-medium text-indigo-600 hover:text-indigo-500">Regístrate aquí</a>
        </p>
    </div>
</body>
</html>
