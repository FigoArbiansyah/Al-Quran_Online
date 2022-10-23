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
$download = $d['recitation'];

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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
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
                <br>
            </div>
                <div class="d-flex justify-content-evenly">
                    <a href="surah.php?surat=<?= $prev ?>" class="fw-bold prev">←</a> 
                        <a href="index.php" class="home">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-house-door-fill" viewBox="0 0 16 16">
                            <path d="M6.5 14.5v-3.505c0-.245.25-.495.5-.495h2c.25 0 .5.25.5.5v3.5a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5z"/>
                            </svg>
                        </a> 
                    <a href="surah.php?surat=<?= $next ?>" class="fw-bold next">→</a>
                </div>
        </div>
        <div class="row mt-3">
            <div class="col">
                <?php foreach ($ayahs as $ayah) {
                    $num = $ayah['number'];
                    $text = $ayah['text'];
                    $translate = $ayah['translation'];
                    $tafsir = $ayah['tafsir'];
                    $audio = $ayah['audio'];
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
                        <div id="audio" class="justify-content-end d-flex align-items-center">
                            <audio controls class="audioAyah me-2">
                                <source src="<?= $audio['url'] ?>" type="audio/mp3">
                            </audio>
                            <a href="ayat.php?surat=<?= $surah ?>&ayat=<?= $num['insurah'] ?>&jmlAyat=<?= $d['ayahCount'] ?>" class="badge rounded-pill btn btn-secondary me-1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-book-fill" viewBox="0 0 16 16">
                                  <path d="M8 1.783C7.015.936 5.587.81 4.287.94c-1.514.153-3.042.672-3.994 1.105A.5.5 0 0 0 0 2.5v11a.5.5 0 0 0 .707.455c.882-.4 2.303-.881 3.68-1.02 1.409-.142 2.59.087 3.223.877a.5.5 0 0 0 .78 0c.633-.79 1.814-1.019 3.222-.877 1.378.139 2.8.62 3.681 1.02A.5.5 0 0 0 16 13.5v-11a.5.5 0 0 0-.293-.455c-.952-.433-2.48-.952-3.994-1.105C10.413.809 8.985.936 8 1.783z"/>
                                </svg>
                            </a>
                        </div>
                    <div class="bg-white translate">
                        <span><em><?= $translate['id'] ?></em></span>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>


    <?php include('footer.php') ?>

   <!--  <script type="text/javascript">
        const showTafsir = () => {
            const tafsir = document.querySelector(".tafsirnya");
            tafsir.classList.remove("show-tafsir")
            tafsir.classList.add("hide-tafsir")
        }
    </script> -->
</body>
</html>