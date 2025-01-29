<?php
if (session_status() === PHP_SESSION_NONE) {
    session_name('admin_session'); 
    session_start();
}

ob_start(); 
require_once __DIR__ . '/../models/model.php';

function exportDatabase($backupFile) {
    $pdo = getPdo();

    try {
        $tables = [];
        $stmt = $pdo->query("SHOW TABLES");
        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $tables[] = $row[0];
        }

        $handle = fopen($backupFile, 'w');
        if (!$handle) {
            throw new Exception("Cannot open file: $backupFile");
        }

        foreach ($tables as $table) {
            fwrite($handle, "DROP TABLE IF EXISTS `$table`;\n");

            $stmt = $pdo->query("SHOW CREATE TABLE `$table`");
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            fwrite($handle, $row['Create Table'] . ";\n\n");

            $stmt = $pdo->query("SELECT * FROM `$table`");
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $row = array_map([$pdo, 'quote'], $row);
                fwrite($handle, "INSERT INTO `$table` (" . implode(", ", array_keys($row)) . ") VALUES(" . implode(", ", $row) . ");\n");
            }
            fwrite($handle, "\n");
        }

        fclose($handle);
    } catch (Exception $e) {
        throw new Exception("Error exporting database: " . $e->getMessage());
    }
}

function copyFolder($src, $dst) {
    if (!is_dir($src)) {
        throw new Exception("Source directory does not exist: $src");
    }

    if (!mkdir($dst, 0777, true) && !is_dir($dst)) {
        throw new Exception("Failed to create directory: $dst");
    }

    $dir = opendir($src);
    if ($dir === false) {
        throw new Exception("Failed to open directory: $src");
    }

    while (false !== ($file = readdir($dir))) {
        if (($file != '.') && ($file != '..')) {
            $srcPath = $src . '/' . $file;
            $dstPath = $dst . '/' . $file;

            if (is_dir($srcPath)) {
                copyFolder($srcPath, $dstPath);
            } else {
                if (!copy($srcPath, $dstPath)) {
                    throw new Exception("Failed to copy $srcPath to $dstPath");
                }
            }
        }
    }
    closedir($dir);
}

function archiveDatabase() {
    try {
        $archiveFolder = __DIR__ . '/../../archive/archive_' . date('Ymd_His');
        if (!file_exists($archiveFolder) && !mkdir($archiveFolder, 0777, true)) {
            throw new Exception("Failed to create archive folder: $archiveFolder");
        }

        $backupFile = $archiveFolder . '/database_backup.sql';
        exportDatabase($backupFile);

        $uploadsFolder = __DIR__ . '/../../uploads_workshop/uploads_PDF_Condidats';
        $destinationFolder = $archiveFolder . '/PDF_Condidats';

        if (is_dir($uploadsFolder)) {
            copyFolder($uploadsFolder, $destinationFolder);
        } else {
            throw new Exception("Uploads folder does not exist: $uploadsFolder");
        }

        $_SESSION['message'] = "Data has been saved successfully";
        ob_end_clean(); 
        header("Location: /workshop_crti/admin_page/index.php?view=Admin"); 
        exit;

    } catch (Exception $e) {
        $_SESSION['error'] = "Saving error: " . htmlspecialchars($e->getMessage());
        ob_end_clean(); 
        header("Location: /workshop_crti/admin_page/index.php?view=Admin"); 
        exit;
    }
}

function truncateTables() {
    $pdo = getPdo();

    try {
        $tables = [];
        $stmt = $pdo->query("SHOW TABLES");
        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $tables[] = $row[0];
        }

        foreach ($tables as $table) {
            $pdo->exec("DELETE FROM `$table`");
            $pdo->exec("ALTER TABLE `$table` AUTO_INCREMENT = 1");
        }

        $_SESSION['message'] = "Data has been saved successfully";
        ob_end_clean(); 
        header("Location: /workshop_crti/admin_page/index.php?view=Admin");
        exit;

    } catch (Exception $e) {
        $_SESSION['error'] = "Saving error: " . htmlspecialchars($e->getMessage());
        ob_end_clean();
        header("Location: /workshop_crti/admin_page/index.php?view=Admin");
        exit;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['archive_db'])) {
        archiveDatabase();
    }

    if (isset($_POST['truncate_db'])) {
        truncateTables();
    }
}

ob_end_flush(); 
?>