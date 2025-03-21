<?php
session_start();

if(!isset($_SESSION['userid'])) {
    $msg = "Je moet ingelogd zijn om deze pagina te zien!";
    header("Location: ../login/login.php?msg=.$msg");
}

?>


<?php require_once __DIR__ . '/../../../config/config.php'; ?>
<!doctype html>
<html lang="nl">

<head>
    <title>StoringApp / Meldingen</title>
    <?php require_once __DIR__ . '/../components/head.php'; ?>
</head>

<body>

    <?php require_once __DIR__ . '/../components/header.php'; ?>

    <div class="container">
        <h1>Meldingen</h1>
        <a href="create.php">Nieuwe melding &gt;</a>

        <?php if (isset($_GET['msg'])) {
            echo "<div class='msg'>" . $_GET['msg'] . "</div>";
        } ?>

        <div style="height: 300px; background: #ededed; display: flex; justify-content: center; align-items: center; color: #666666;">
            <?php
            //1. Verbinding
            require_once '../../../config/conn.php';

            //2. Query
            $query="SELECT * FROM meldingen";

            //3. Prepare
            $statement = $conn->prepare($query);

            //4. Execute
            $statement->execute();

            //5. fetch
            $meldingen = $statement->fetchAll(PDO::FETCH_ASSOC);

            ?>

            <table>
                <tr>
                    <th>Attractie</th>
                    <th>Type</th>
                    <th>Capaciteit</th>
                    <th>Melder</th>
                    <th>Gemeld op</th>
                    <th>Overige info</th>
                    <th>Aanpassen</th>
                </tr>

            <?php


            // foreach($meldingen as $melding) {

            // }
            ?>

            <?php foreach($meldingen as $melding): ?>
                <tr>
                    <td><?php echo $melding['attractie']; ?></td>
                    <td><?php echo $melding['type']; ?></td>
                    <td><?php echo $melding['capaciteit']?></td>
                    <td><?php echo $melding['melder']; ?></td>
                    <td><?php echo $melding['gemeld_op']; ?></td>
                    <td><?php echo $melding['overige_info']; ?></td>
                    <td><a href="edit.php?id=<?php echo $melding['id']; ?>">aanpassen</td>
                </tr>
                <?php endforeach; ?>

            </table>
        </div>
    </div>

</body>

</html>