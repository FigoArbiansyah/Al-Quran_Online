<?php 

$link = "https://quran-endpoint.vercel.app/quran";
$result = file_get_contents($link);
$data = json_decode($result, true);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/style.css">
    <title>Baca Al-Quran</title> 
</head>
<body>
    
    <div class="container mt-4">
        <div class="row">
            <div class="col text-center">
                <h2>Al-Quran Online</h2>
                <p>Baca Al-Quran gratis secara Online</p>
                    <form class="d-flex input-search" role="search">
                        <input class="form-control me-2 cari" type="search" placeholder="Cari Surat" aria-label="Search">
                        <button class="btn btn-outline-secondary" onclick="buttonUp()" type="button">Search</button>
                    </form>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col">
                <?php foreach($data['data'] as $d) {
                    $asma = $d['asma'];
                    $ar = $asma['ar'];
                    $en = $asma['en']
                    ?> 
                    <div class="card mb-2">
                        <a href="<?= $link ?>/<?= $d['number'] ?>" class="text-dark" style="text-decoration: none;">
                        <div class="card-body">
                            <span style="float: right; margin-top: auto;"><?= $d['number']; ?></span>
                            <span class="en"><?= $en['short']; ?></span>
                             - 
                             <span class="arab-surah"><?= $ar['short']; ?></span>
                             <br>
                             <span><?= $d['ayahCount']; ?> Ayat</span>
                        </div>
                        </a>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>

<script type="text/javascript">
    var buttonUp = () => {
    const input = document.querySelector(".cari");
    const cards = document.getElementsByClassName("card");
    let filter = input.value
    for (let i = 0; i < cards.length; i++) {
        let title = cards[i].querySelector(".card-body .en");
        if (title.innerText.indexOf(filter) > -1) {
            cards[i].classList.remove("d-none")
        } else {
            cards[i].classList.add("d-none")
        }
    }
}
</script>
</body>
</html>