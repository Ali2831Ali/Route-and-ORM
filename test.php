
    <!DOCTYPE html>
    <html lang="en">
    <head>

        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>SabzLearn | js | 16</title>
    </head>
    <body>

    <?php
    $hostname = 'localhost';
    //data base config
    $DBname = 'quees_mvc';
    $DBusername = 'root';
    $DBpassword = '';
    try {
        $attr = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');
        $conn = new PDO('mysql:host=' . $hostname . ';dbname=' . $DBname, $DBusername, $DBpassword, $attr);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die("Connection failed: " . $e->getMessage());
    }

    var_dump($conn);
    ?>

    <!--<script src="js/script.js"></script>-->
    </body>
    </html>

