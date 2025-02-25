 <?php
// Ejemplo de cómo deberían estar en config.php
define("BASE_PATH", "C:/xampp/htdocs/Dashboard_index");
define("UPLOAD_PATH", BASE_PATH . "uploads");
define("UPLOAD_DIR", "/uploads"); // Ruta relativa para URLs y BD
// Para depuración (puedes eliminar después)
if (isset($_GET['debug'])) {
    echo "Información de rutas:<br>";
    echo "BASE_PATH: " . BASE_PATH . "<br>";
    echo "UPLOAD_DIR: " . UPLOAD_DIR . "<br>";
    echo "UPLOAD_PATH: " . UPLOAD_PATH . "<br>";
    echo "¿Existe UPLOAD_PATH? " . (file_exists(UPLOAD_PATH) ? "Sí" : "No") . "<br>";
    if (file_exists(UPLOAD_PATH)) {
        echo "Permisos: " . substr(sprintf('%o', fileperms(UPLOAD_PATH)), -4) . "<br>";
        echo "Contenido: <pre>";
        print_r(scandir(UPLOAD_PATH));
        echo "</pre>";
    }
}
?> 