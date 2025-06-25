<?php
session_start();
// Proteger la página: si el usuario no está logueado, redirigir a login
if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit();
}

// Lógica de búsqueda de usuarios
$servidor = "localhost"; $usuario_db = "root"; $clave_db = ""; $baseDeDatos = "form";
$enlace = @mysqli_connect($servidor, $usuario_db, $clave_db, $baseDeDatos);
if (!$enlace) { die("Error de conexión."); }

$results = [];
$search_query = '';
// Consulta por defecto muestra todos los usuarios
$sql = "SELECT id, nombres, apellidos, usuario FROM usuarios ORDER BY apellidos, nombres ASC";

if (isset($_GET['search']) && !empty($_GET['search'])) {
    $search_query = trim($_GET['search']);
    $safe_query = mysqli_real_escape_string($enlace, $search_query);
    // La consulta ahora busca en nombres, apellidos y usuario
    $sql = "SELECT id, nombres, apellidos, usuario FROM usuarios WHERE nombres LIKE '%$safe_query%' OR apellidos LIKE '%$safe_query%' OR usuario LIKE '%$safe_query%' ORDER BY apellidos, nombres ASC";
}

$result = mysqli_query($enlace, $sql);
if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $results[] = $row;
    }
}
mysqli_close($enlace);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buscar Usuarios</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style> body { font-family: 'Inter', sans-serif; } </style>
</head>
<body class="bg-gray-100 dark:bg-gray-900 min-h-screen">
    <div class="container mx-auto p-4 md:p-8">
        <header class="text-center mb-10">
            <h1 class="text-4xl font-bold text-gray-800 dark:text-white">Búsqueda de Usuarios del Sistema</h1>
            <p class="text-lg text-gray-600 dark:text-gray-400 mt-2">Consulta y filtra la lista de usuarios registrados.</p>
            <a href="index.php" class="mt-4 inline-flex items-center gap-2 text-indigo-600 hover:text-indigo-800">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" /></svg>
                Volver al Menú Principal
            </a>
        </header>

        <div class="w-full bg-white rounded-xl shadow-lg dark:bg-gray-800 p-6 md:p-8">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="get" class="mb-8 flex flex-col sm:flex-row gap-4">
                <input type="text" name="search" class="w-full px-4 py-2 border border-gray-300 rounded-md" placeholder="Buscar por nombres, apellidos o usuario..." value="<?php echo htmlspecialchars($search_query); ?>">
                <button type="submit" class="bg-indigo-600 text-white px-6 py-2 rounded-md hover:bg-indigo-700">Buscar</button>
            </form>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gray-50 dark:bg-gray-700">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nombres</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Apellidos</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nombre de Usuario</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800">
                        <?php if (count($results) > 0): ?>
                            <?php foreach ($results as $row): ?>
                                <tr>
                                    <td class="px-6 py-4 font-medium text-gray-900 dark:text-white"><?php echo htmlspecialchars($row['nombres']); ?></td>
                                    <td class="px-6 py-4 font-medium text-gray-900 dark:text-white"><?php echo htmlspecialchars($row['apellidos']); ?></td>
                                    <td class="px-6 py-4 text-gray-500 dark:text-gray-300"><?php echo htmlspecialchars($row['usuario']); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr><td colspan="3" class="px-6 py-8 text-center text-gray-500">No se encontraron resultados.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
