<?php
require_once 'models/model.php'; 

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
        echo "The database has been successfully exported to the file: $backupFile<br>";
    } catch (Exception $e) {
        echo "Error exporting the database: " . $e->getMessage() . "<br>";
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
                    echo "Failed to copy $srcPath to $dstPath<br>";
                }
            }
        }
    }
    closedir($dir);
}

function archiveDatabase() {
    try {
        $archiveFolder = 'archive_' . date('Ymd_His');
        if (!file_exists($archiveFolder) && !mkdir($archiveFolder, 0777, true)) {
            throw new Exception("Failed to create archive folder: $archiveFolder");
        }

        $backupFile = $archiveFolder . '/database_backup.sql';
        exportDatabase($backupFile); 

        // Determine the path of the uploads folder
        $uploadsFolder = __DIR__ . '/uploads';
        $destinationFolder = $archiveFolder . '/uploads_backup';

        if (is_dir($uploadsFolder)) {
            copyFolder($uploadsFolder, $destinationFolder); 
            echo "The folder $uploadsFolder has been successfully copied to $destinationFolder.<br>";
        } else {
            echo "The uploads folder does not exist at the specified path: $uploadsFolder<br>";
        }

    } catch (Exception $e) {
        echo "Error during archiving: " . $e->getMessage() . "<br>";
    }
}

function truncateTables() {
    $pdo = getPdo(); // Obtain a PDO connection using the getPdo() function

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
        
        echo "All tables have been successfully emptied.<br>";
    } catch (Exception $e) {
        echo "Error truncating the tables: " . $e->getMessage() . "<br>";
    }
}

if (isset($_POST['archive_db'])) {
    archiveDatabase();
}

if (isset($_POST['truncate_db'])) {
    truncateTables();
}
?>

<!-- Archiving Button -->
<form method="POST" action="">
    <button type="submit" name="archive_db">Archive Data</button>
</form>

<!-- Data Truncation Button -->
<form method="POST" action="">
    <button type="submit" name="truncate_db" onclick="return confirm('Have you backed up the data in the archive? Are you sure you want to delete the data?');">Empty Data</button>
</form>
