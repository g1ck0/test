<?php
$host = 'localhost';
$dbname = 'bs2_inf';
$username = 'root';
$password = '';

try {
    $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";
    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ];

    $pdo = new PDO($dsn, $username, $password, $options);
    $stmt = $pdo->query('SELECT name, role, birth_date FROM bees');
    $bees = $stmt->fetchAll();

} catch (PDOException $e) {
    die("Datenbankverbindung fehlgeschlagen: " . $e->getMessage());
}

?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienen Übersicht</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }
        th {
            background-color: #f8f8f8;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

<h1>Bienen Übersicht</h1>

<?php if (count($bees) > 0): ?>
    <table>
        <thead>
        <tr>
            <th>Name</th>
            <th>Aufgabe</th>
            <th>Geburtsdatum</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($bees as $bee): ?>
            <tr>
                <td><?= htmlspecialchars($bee['name'], ENT_QUOTES, 'UTF-8') ?></td>
                <td><?= htmlspecialchars($bee['role'], ENT_QUOTES, 'UTF-8') ?></td>
                <td><?= htmlspecialchars($bee['birth_date'], ENT_QUOTES, 'UTF-8') ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php else: ?>
    <p>Keine Bienen gefunden.</p>
<?php endif; ?>

</body>
</html>