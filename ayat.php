<?php 

$surah = $_GET['surat'];
$ayat = $_GET['ayat'];
$count = $_GET['jmlAyat'];

if ($ayat - 1 == 0) {
    $prev = 1;
} else {
    $prev = $ayat - 1;
}

if ($ayat + 1 > $count) {
    $next = $count;
} else {
    $next = $ayat + 1;
}

$link = "https://quran-endpoint.vercel.app/quran/$surah/$ayat";
$result = file_get_contents($link);
$data = json_decode($result, true);
$d = $data['data'];
$ayahs = $d["ayah"];

// Manggil nama surat sama arti nya
$num = $ayahs['number'];
$asma = $d['surah'];
$id = $asma['id'];
$ar = $asma['ar'];
$trans = $asma['translation'];
$text = $ayahs['text'];
$translateAyat = $ayahs['translation'];
$tafsir = $ayahs['tafsir'];
$audio = $ayahs['audio'];

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
                <h5>Ayat ke <?= $num['insurah'] ?></h5> 
                <br>
                <br>
            </div>
                <div class="d-flex justify-content-evenly">
                    <a href="ayat.php?surat=<?= $surah ?>&ayat=<?= $prev ?>&jmlAyat=<?= $count ?>" class="fw-bold prev">←</a> 
                        <a href="surah.php?surat=<?= $surah ?>" class="home">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-journal-arrow-up" viewBox="0 0 16 16">
                              <path fill-rule="evenodd" d="M8 11a.5.5 0 0 0 .5-.5V6.707l1.146 1.147a.5.5 0 0 0 .708-.708l-2-2a.5.5 0 0 0-.708 0l-2 2a.5.5 0 1 0 .708.708L7.5 6.707V10.5a.5.5 0 0 0 .5.5z"/>
                              <path d="M3 0h10a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-1h1v1a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1v1H1V2a2 2 0 0 1 2-2z"/>
                              <path d="M1 5v-.5a.5.5 0 0 1 1 0V5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0V8h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0v.5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1z"/>
                            </svg>
                        </a> 
                    <a href="ayat.php?surat=<?= $surah ?>&ayat=<?= $next ?>&jmlAyat=<?= $count ?>" class="fw-bold next">→</a>
                </div>
        </div>
        <div class="row mt-3">
            <div class="col">
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
                            <audio controls class="audioAyah me-1">
                                <source src="<?= $audio['url'] ?>" type="audio/mp3">
                            </audio>
                        </div>
                    <div class="bg-white translate">
                        <span><em><?= $translateAyat['id'] ?></em></span>
                    </div>

                    <div class="bg-white tafsir mb-4">
                        <p>Tafsir:</p>
                        <span><?= $tafsir['id'] ?></span>
                    </div>
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