<?php 

$surah = $_GET['surat'];
$link = "https://quran-endpoint.vercel.app/quran/$surah";
$result = file_get_contents($link);
$data = json_decode($result, true);
$d = $data['data'];
$ayahs = $d["ayahs"];

// Manggil nama surat sama arti nya

$asma = $d['asma'];
$id = $asma['id'];
$ar = $asma['ar'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/surah.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <title>Baca Al-Quran</title> 
</head>
<body>
    
    <div class="container mt-4">
        <div class="row">
            <div class="col text-center">
                <p>Surah</p>
                <h4><?= $id['short'] ?> - <?= $ar['short'] ?></h4>
                <p>Baca Al-Quran gratis secara Online</p>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col">
                <?php foreach ($ayahs as $ayah) {
                    $num = $ayah['number'];
                    $text = $ayah['text'];
                    $translate = $ayah['translation'];
                    ?>
                    <div class="card mb-2">
                        <span class="num"><?= $num['insurah'] ?></span>
                        <div class="card-body">
                            <div class="text-end">
                                <span class="arab"><?= $text['ar'] ?></span>
                                <br>
                                <br>
                                <span><em><?= $text['read'] ?></em></span>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white translate">
                        <span><em><?= $translate['id'] ?></em></span>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>


    <?php include('footer.php') ?>
</body>
</html>