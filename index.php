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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <title>Baca Al-Quran</title> 
</head>
<body>
    
    <div class="container mt-4">
        <div class="row">
            <div class="col text-center">
                <h2>Al-Quran Online</h2>
                <p>Baca Al-Quran secara Online <br> 114 Surah</p>
                    <div class="d-flex form input-search justify-content-center" role="search">
                        <input class=" me-2 cari" type="text" placeholder="Cari Surah" aria-label="Search">
                        <button class="btn btn-outline-secondary" onclick="buttonUp()" type="button">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                              <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                            </svg>
                        </button>
                    </div>
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
                        <a href="surah.php?surat=<?= $d['number'] ?>" class="text-dark" style="text-decoration: none;">
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

    <?php include('footer.php') ?>

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