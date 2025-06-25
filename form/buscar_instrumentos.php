<?php
// Lógica de búsqueda de instrumentos
$servidor = "localhost"; $usuario = "root"; $clave = ""; $baseDeDatos = "form";
$enlace = @mysqli_connect($servidor, $usuario, $clave, $baseDeDatos);
if (!$enlace) { die("Error de conexión."); }

$results_grouped = [];
$search_query = '';
$sql = "SELECT id, nombre, tipo, descripcion FROM instrumentos ORDER BY tipo, nombre ASC"; // Consulta por defecto

if (isset($_GET['search']) && !empty($_GET['search'])) {
    $search_query = trim($_GET['search']);
    $safe_query = mysqli_real_escape_string($enlace, $search_query);
    $sql = "SELECT id, nombre, tipo, descripcion FROM instrumentos WHERE nombre LIKE '%$safe_query%' OR tipo LIKE '%$safe_query%' OR descripcion LIKE '%$safe_query%' ORDER BY tipo, nombre ASC";
}

$result = mysqli_query($enlace, $sql);
if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        // Agrupar por tipo de instrumento
        $tipo = $row['tipo'];
        if (!isset($results_grouped[$tipo])) {
            $results_grouped[$tipo] = [];
        }
        $results_grouped[$tipo][] = $row;
    }
}
mysqli_close($enlace);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buscar Instrumentos</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style> body { font-family: 'Inter', sans-serif; } </style>
</head>
<body class="bg-gray-100 dark:bg-gray-900 min-h-screen">
    <div class="container mx-auto p-4 md:p-8">
        <header class="text-center mb-10">
            <h1 class="text-4xl font-bold text-gray-800 dark:text-white">Búsqueda de Instrumentos</h1>
            <p class="text-lg text-gray-600 dark:text-gray-400 mt-2">Explora el catálogo de instrumentos musicales.</p>
            <a href="index.php" class="mt-4 inline-flex items-center gap-2 text-green-600 hover:text-green-800">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" /></svg>
                Volver al Menú Principal
            </a>
        </header>

        <div class="w-full bg-white rounded-xl shadow-lg dark:bg-gray-800 p-6 md:p-8">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="get" class="mb-8 flex flex-col sm:flex-row gap-4">
                <input type="text" name="search" class="w-full px-4 py-2 border border-gray-300 rounded-md" placeholder="Buscar por nombre, tipo o descripción..." value="<?php echo htmlspecialchars($search_query); ?>">
                <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded-md hover:bg-green-700">Buscar</button>
            </form>

            <?php if (count($results_grouped) > 0): ?>
                <?php foreach ($results_grouped as $tipo => $instrumentos): ?>
                    <div class="mb-8">
                        <h2 class="text-2xl font-semibold text-gray-700 dark:text-gray-300 border-b border-gray-300 pb-2 mb-4"><?php echo htmlspecialchars($tipo); ?></h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            <?php foreach ($instrumentos as $instrumento): ?>
                                <div class="bg-gray-50 dark:bg-gray-700/50 p-4 rounded-lg">
                                    <h3 class="font-bold text-lg text-green-700 dark:text-green-400"><?php echo htmlspecialchars($instrumento['nombre']); ?></h3>
                                    <p class="text-sm text-gray-600 dark:text-gray-400 mt-1"><?php echo htmlspecialchars($instrumento['descripcion']); ?></p>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="text-center py-10">
                    <p class="text-gray-500">No se encontraron instrumentos que coincidan con la búsqueda.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
