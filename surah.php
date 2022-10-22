<?php 

$surah = $_GET['surat'];
if ($surah - 1 == 0) {
    $prev = 114;
} else {
    $prev = $surah - 1;
}

if ($surah + 1 == 115) {
    $next = 1;
} else {
    $next = $surah + 1;
}

$link = "https://quran-endpoint.vercel.app/quran/$surah";
$result = file_get_contents($link);
$data = json_decode($result, true);
$d = $data['data'];
$ayahs = $d["ayahs"];

// Manggil nama surat sama arti nya

$asma = $d['asma'];
$id = $asma['id'];
$ar = $asma['ar'];
$trans = $asma['translation'];

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
                <p>"<?= $trans['id'] ?>" 
                <br>
                (<?= $d['ayahCount'] ?> Ayat)</p>
            </div>
                <div class="d-flex justify-content-evenly">
                    <a href="surah.php?surat=<?= $prev ?>" class="fw-bold" style="position: ; top: 80px; left: 60px; font-size: 1.4em; text-decoration: none; color: black;">←</a>
                    <a href="index.php" style="color: black; transform: scale(1.2);">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-house-door-fill" viewBox="0 0 16 16">
                        <path d="M6.5 14.5v-3.505c0-.245.25-.495.5-.495h2c.25 0 .5.25.5.5v3.5a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5z"/>
                        </svg>
                    </a>
                    <a href="surah.php?surat=<?= $next ?>" class="fw-bold" style="position: ; top: 80px; right: 60px; font-size: 1.4em; text-decoration: none; color: black;">→</a>
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