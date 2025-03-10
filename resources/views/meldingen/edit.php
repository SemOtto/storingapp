<?php require_once __DIR__ . '/../../../config/config.php'; ?>
<!doctype html>
<html lang="nl">

<head>
    <title>StoringApp / Meldingen</title>
    <?php require_once __DIR__ . '/../components/head.php'; ?>
</head>

<body>

    <?php require_once __DIR__ . '/../components/header.php'; ?>

    <?php
            $id = $_GET['id'];

            //1. Verbinding
            require_once '../../../config/conn.php';

            //2. Query
            $query="SELECT * FROM meldingen WHERE id = :id";

            //3. Prepare
            $statement = $conn->prepare($query);

            //4. Execute
            $statement->execute([
                ":id" => $id
            ]);

            //5. fetch
            $melding = $statement->fetch(PDO::FETCH_ASSOC);

            print_r($melding);

        ?>

    <div class="container"> 
            <form action="<?php echo $base_url; ?>/app/Http/Controllers/meldingenController.php" method="POST">
            <input type="hidden" name="action" value="edit">
            
                <input type="hidden" name="id" value="<?php echo $melding['id'];?>">

            <div class="form-group">
                <label for="attractie">Naam attractie:</label>
                <input type="text" name="attractie" id="attractie" class="form-input" value="<?php echo $melding['attractie'];?>">
            </div>

            <div class="form-group">
            <label for="prioriteit">Prioriteit?</label>
            <input type="checkbox" name="prioriteit" <?php if($melding['prioriteit'] == 1) echo "checked" ?>>
            </div>

            <div class="form-group">
                <label for="capaciteit">Capaciteit p/uur:</label>
                <input type="number" min="0" name="capaciteit" id="capaciteit" class="form-input" value="<?php echo $melding['capaciteit'];?>">
            </div>
            <div class="form-group">
                <label for="melder">Naam melder:</label>
                <input type="text" name="melder" id="melder" class="form-input" value="<?php echo $melding['melder'];?>">
            </div>
            <div class="form-group">
            <label for="overige_info">Overige info:</label>
            <textarea name="overig" id="overig" class="form-input" rows="4"><?php echo $melding['overige_info'];?></textarea>
            </div>

            <input type="submit" value="Pas melding aan">

            </form>

            <form action="<?php echo $base_url; ?>/app/Http/Controllers/meldingenController.php" method="POST">
                <input type="hidden" name="action" value="delete">
                <input type="hidden" name="id" value="<?php echo $melding['id'];?>">
                <input type="submit" value="Verwijderen">

            </form>
    </div>

</body>

</html>