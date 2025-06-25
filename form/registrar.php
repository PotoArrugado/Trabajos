<?php
$mensaje = "";
$tipo_mensaje = "";
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['registro'])) {
    // --- Conexión a la Base de Datos ---
    $servidor = "localhost"; $usuario_db = "root"; $clave_db = ""; $baseDeDatos = "form";
    $enlace = @mysqli_connect($servidor, $usuario_db, $clave_db, $baseDeDatos);
    if (!$enlace) { die("Error de conexión."); }
    
    // --- Recolección y Saneamiento de Datos ---
    $nombres = mysqli_real_escape_string($enlace, trim($_POST['nombres']));
    $apellidos = mysqli_real_escape_string($enlace, trim($_POST['apellidos']));
    $usuario = mysqli_real_escape_string($enlace, trim($_POST['usuario']));
    $clave = trim($_POST['clave']);

    // --- Validación ---
    if (empty($nombres) || empty($apellidos) || empty($usuario) || empty($clave)) {
        $mensaje = "Todos los campos son obligatorios.";
        $tipo_mensaje = "error";
    } elseif (strlen($clave) < 6) {
        $mensaje = "La contraseña debe tener al menos 6 caracteres.";
        $tipo_mensaje = "error";
    }
    else {
        // Verificar si el nombre de usuario ya existe
        $check_user_sql = "SELECT id FROM usuarios WHERE usuario = '$usuario'";
        $check_result = mysqli_query($enlace, $check_user_sql);
        
        if (mysqli_num_rows($check_result) > 0) {
            $mensaje = "El nombre de usuario ya está en uso. Por favor, elige otro.";
            $tipo_mensaje = "error";
        } else {
            // --- Inserción en la Base de Datos ---
            // Hashear la contraseña por seguridad
            $clave_hasheada = password_hash($clave, PASSWORD_DEFAULT);
            
            $insertarDatos = "INSERT INTO usuarios (nombres, apellidos, usuario, clave) VALUES ('$nombres', '$apellidos', '$usuario', '$clave_hasheada')";
            
            if (mysqli_query($enlace, $insertarDatos)) {
                $mensaje = "¡Usuario registrado con éxito! Ahora puedes iniciar sesión.";
                $tipo_mensaje = "exito";
            } else {
                $mensaje = "Error al registrar el usuario.";
                $tipo_mensaje = "error";
            }
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
    <title>Registrar Usuario</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style> body { font-family: 'Inter', sans-serif; } </style>
</head>
<body class="bg-gray-100 dark:bg-gray-900 flex flex-col justify-center items-center min-h-screen p-4">
    
    <div class="w-full max-w-md">
         <a href="login.php" class="inline-flex items-center gap-2 text-indigo-600 hover:text-indigo-800 mb-6">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" /></svg>
            Ir a Inicio de Sesión
        </a>
    </div>

    <div class="w-full max-w-md bg-white rounded-xl shadow-lg dark:bg-gray-800 p-6 md:p-8">
        <h2 class="text-2xl font-bold text-center text-gray-800 dark:text-white">Crear una Cuenta</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="mt-8 space-y-6">
            <?php if (!empty($mensaje)): ?>
                <div class="p-4 rounded-md text-sm <?php echo ($tipo_mensaje === 'exito') ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'; ?>"><?php echo $mensaje; ?></div>
            <?php endif; ?>
            
            <div class="flex flex-col sm:flex-row gap-4">
                <div class="w-full">
                    <label for="nombres" class="text-sm font-medium text-gray-700 dark:text-gray-300">Nombres</label>
                    <input type="text" name="nombres" id="nombres" class="mt-1 w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
                </div>
                <div class="w-full">
                    <label for="apellidos" class="text-sm font-medium text-gray-700 dark:text-gray-300">Apellidos</label>
                    <input type="text" name="apellidos" id="apellidos" class="mt-1 w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
                </div>
            </div>

            <div>
                <label for="usuario" class="text-sm font-medium text-gray-700 dark:text-gray-300">Nombre de Usuario</label>
                <input type="text" name="usuario" id="usuario" class="mt-1 w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
            </div>
            <div>
                <label for="clave" class="text-sm font-medium text-gray-700 dark:text-gray-300">Contraseña</label>
                <input type="password" name="clave" id="clave" class="mt-1 w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
            </div>
            <button type="submit" name="registro" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700">Registrar Cuenta</button>
        </form>
    </div>
</body>
</html>
