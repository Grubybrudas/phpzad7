<?php

require_once 'funkcjezad7.php';


$uczniowie = [
    ["imie" => "Adam", "punkty" => 85],
    ["imie" => "Kasia", "punkty" => 92],
    ["imie" => "Marek", "punkty" => 48],
    ["imie" => "Ola", "punkty" => 67],
    ["imie" => "Tomek", "punkty" => 35]
];


$liczbaUczniow = count($uczniowie);
$sumaPunktow = 0;

for ($i = 0; $i < $liczbaUczniow; $i++) {
    $sumaPunktow += $uczniowie[$i]["punkty"];
}

$sredniaPunktow = $sumaPunktow / $liczbaUczniow;


$komentarz = "";
switch (true) {
    case ($sredniaPunktow < 40):
        $komentarz = "Bardzo słaby wynik klasy";
        break;
    case ($sredniaPunktow >= 40 && $sredniaPunktow <= 59):
        $komentarz = "Wynik klasy jest niezadowalający";
        break;
    case ($sredniaPunktow >= 60 && $sredniaPunktow <= 79):
        $komentarz = "Dobry wynik klasy";
        break;
    case ($sredniaPunktow >= 80):
        $komentarz = "Bardzo dobry wynik klasy";
        break;
}


$zdali = [];
$nieZdali = [];
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Raport wyników testu</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f0f2f5;
            color: #333;
            display: flex;
            justify-content: center;
            padding: 30px;
            margin: 0;
        }
        .raport-container {
            background-color: #ffffff;
            padding: 25px 35px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            width: 100%;
            max-width: 450px;
        }
        h2, h3 {
            color: #2c3e50;
            margin-top: 0;
            border-bottom: 2px solid #e1e4e8;
            padding-bottom: 10px;
        }
        .uczen-karta {
            background-color: #f8f9fa;
            border-left: 4px solid #3498db;
            padding: 10px 15px;
            margin-bottom: 12px;
            border-radius: 4px;
        }
        .uczen-karta.niezaliczony {
            border-left-color: #e74c3c;
        }
        .podsumowanie {
            margin-top: 25px;
            padding-top: 15px;
            border-top: 2px dashed #bdc3c7;
            line-height: 1.6;
        }
        .zaliczony-tekst { color: #27ae60; font-weight: bold; }
        .niezaliczony-tekst { color: #c0392b; font-weight: bold; }
    </style>
</head>
<body>

<div class="raport-container">
    <h2>RAPORT WYNIKÓW TESTU INFORMATYCZNEGO</h2>

    <?php

    foreach ($uczniowie as $uczen) {
        $imie = $uczen["imie"];
        $punkty = $uczen["punkty"];
        $procent = obliczProcent($punkty);
        $ocena = przyznajOcene($punkty);
        $zdal = czyZdal($punkty);

        if ($zdal) {
            $statusTekst = "<span class='zaliczony-tekst'>ZALICZONY</span>";
            $klasaKarty = "";
            $zdali[] = $imie;
        } else {
            $statusTekst = "<span class='niezaliczony-tekst'>NIEZALICZONY</span>";
            $klasaKarty = "niezaliczony";
            $nieZdali[] = $imie;
        }

        echo "<div class='uczen-karta $klasaKarty'>";
        echo "<strong>$imie</strong><br>";
        echo "Punkty: $punkty<br>";
        echo "Procent: $procent<br>";
        echo "Ocena: $ocena<br>";
        echo "Status: $statusTekst";
        echo "</div>";
    }
    ?>

    <div class="podsumowanie">
        <h3>PODSUMOWANIE KLASY</h3>
        Liczba uczniów: <strong><?= $liczbaUczniow ?></strong><br>
        Suma punktów: <strong><?= $sumaPunktow ?></strong><br>
        Średnia punktów: <strong><?= $sredniaPunktow ?></strong><br>
        Zaliczyło: <strong><?= count($zdali) ?></strong><br>
        Nie zaliczyło: <strong><?= count($nieZdali) ?></strong><br>
        Osoby, które nie zaliczyły: <strong><?= empty($nieZdali) ? "Brak" : implode(", ", $nieZdali) ?></strong><br>
        Komentarz: <strong><?= $komentarz ?></strong>
    </div>
</div>

</body>
</html>
