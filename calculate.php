<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Calculation Results</title>
    <link rel="stylesheet" href="style.css">
    <style>
        @keyframes fadeSlideDown { from { opacity: 0; transform: translateY(-18px); } to { opacity: 1; transform: translateY(0); } }
        @keyframes floatIcon { 0%, 100% { transform: translateY(0) rotate(0deg); } 50% { transform: translateY(-6px) rotate(2deg); } }
        @keyframes popIn { 0% { opacity: 0; transform: scale(.92) translateY(10px); } 60% { opacity: 1; transform: scale(1.02) translateY(-2px); } 100% { opacity: 1; transform: scale(1) translateY(0); } }
        @keyframes rowIn { from { opacity: 0; transform: translateX(-14px); } to { opacity: 1; transform: translateX(0); } }
        @keyframes pulseGlow { 0%, 100% { box-shadow: 0 0 0 0 currentColor; filter: brightness(1); } 50% { box-shadow: 0 0 16px 2px currentColor; filter: brightness(1.15); } }
        @keyframes btnRipple { from { transform: scale(0); opacity: .55; } to { transform: scale(2.8); opacity: 0; } }
        @keyframes shake { 10%, 90% { transform: translateX(-1px); } 20%, 80% { transform: translateX(2px); } 30%, 50%, 70% { transform: translateX(-4px); } 40%, 60% { transform: translateX(4px); } }

        #top { animation: fadeSlideDown .6s ease both; }
        #top img { animation: floatIcon 3.2s ease-in-out infinite; }
        #dane { animation: popIn .55s cubic-bezier(.26,1.14,.44,1) .15s both; }

        #dane input, #dane select {
            transition: transform .25s ease, box-shadow .25s ease, filter .25s ease;
        }
        #dane input:focus, #dane select:focus {
            transform: translateY(-2px) scale(1.02);
            filter: brightness(1.06);
            box-shadow: 0 0 0 3px currentColor;
            outline: none;
        }
        #dane input[type="submit"] {
            position: relative;
            overflow: hidden;
            cursor: pointer;
            transition: transform .18s ease, filter .18s ease, box-shadow .25s ease;
        }
        #dane input[type="submit"]:hover { transform: translateY(-3px); filter: brightness(1.08); box-shadow: 0 10px 20px -8px currentColor; }
        #dane input[type="submit"]:active { transform: translateY(0) scale(.95); }

        .ripple { position: absolute; border-radius: 50%; background: currentColor; opacity: .5; pointer-events: none; animation: btnRipple .6s ease-out forwards; }
        .shake { animation: shake .45s; }

        #tab table { animation: popIn .5s ease .25s both; }
        #tab tr { opacity: 0; animation: rowIn .4s ease forwards; transition: transform .2s ease, filter .2s ease; }
        #tab tr:hover { transform: scale(1.015); filter: brightness(1.05); }
        #tab tr:nth-child(1) { animation-delay: .05s; }
        #tab tr:nth-child(2) { animation-delay: .12s; }
        #tab tr:nth-child(3) { animation-delay: .19s; }
        #tab tr:nth-child(4) { animation-delay: .26s; }
        #tab tr:nth-child(5) { animation-delay: .33s; }
        #tab tr:nth-child(6) { animation-delay: .40s; }
        #tab tr:nth-child(7) { animation-delay: .47s; }
        #tab tr:nth-child(8) { animation-delay: .54s; }
        .active-row { animation: rowIn .4s ease forwards, pulseGlow 1.8s ease-in-out .65s infinite; }

        @media (prefers-reduced-motion: reduce) {
            *, *::before, *::after { animation-duration: .001ms !important; animation-iteration-count: 1 !important; transition-duration: .001ms !important; }
        }
    </style>
</head>
<body>

<div id="top">
    <img src="Zrzut ekranu 2023-11-19 111439.png" alt="icon">
    <br><h1>Length Unit Converter</h1>
</div>

<div id="data">
      <form action="calculate.php" method="post">
        <input
          type="number"
          name="value"
          id="value"
          step="any"
          placeholder="Value"
        />

        <select name="unit" id="unit">
          <option value="Kilometer">Kilometer</option>
          <option value="Meter">Meter</option>
          <option value="Decimeter">Decimeter</option>
          <option value="Centimeter">Centimeter</option>
          <option value="Millimeter">Millimeter</option>
          <option value="Inch">Inch</option>
          <option value="Foot">Foot</option>
        </select>

        <input type="submit" id="submit" value="Convert" />
      </form>
    </div>

<?php
$inputValue = isset($_POST["value"]) ? (float)$_POST["value"] : 0;
$selectedUnit = isset($_POST["unit"]) ? $_POST["unit"] : "";

$kilometers = 0;
$meters = 0;
$decimeters = 0;
$centimeters = 0;
$millimeters = 0;
$inches = 0;
$feet = 0;

if ($selectedUnit == "Kilometer") {
    $kilometers = $inputValue;
    $meters = $inputValue * 1000;
    $decimeters = $inputValue * 10000;
    $centimeters = $inputValue * 100000;
    $millimeters = $inputValue * 1000000;
    $inches = $inputValue * 39370.08;
    $feet = $inputValue * 3280.84;
} elseif ($selectedUnit == "Meter") {
    $kilometers = $inputValue / 1000;
    $meters = $inputValue;
    $decimeters = $inputValue * 10;
    $centimeters = $inputValue * 100;
    $millimeters = $inputValue * 1000;
    $inches = $inputValue * 39.37;
    $feet = $inputValue * 3.28;
} elseif ($selectedUnit == "Decimeter") {
    $kilometers = $inputValue / 10000;
    $meters = $inputValue / 10;
    $decimeters = $inputValue;
    $centimeters = $inputValue * 10;
    $millimeters = $inputValue * 100;
    $inches = $inputValue * 3.94;
    $feet = $inputValue / 3.048;
} elseif ($selectedUnit == "Centimeter") {
    $kilometers = $inputValue / 100000;
    $meters = $inputValue / 100;
    $decimeters = $inputValue / 10;
    $centimeters = $inputValue;
    $millimeters = $inputValue * 10;
    $inches = $inputValue / 2.54;
    $feet = $inputValue / 30.48;
} elseif ($selectedUnit == "Millimeter") {
    $kilometers = $inputValue / 1000000;
    $meters = $inputValue / 1000;
    $decimeters = $inputValue / 100;
    $centimeters = $inputValue / 10;
    $millimeters = $inputValue;
    $inches = $inputValue / 25.4;
    $feet = $inputValue / 304.8;
} elseif ($selectedUnit == "Inch") {
    $kilometers = $inputValue * 0.0000254;
    $meters = $inputValue * 0.0254;
    $decimeters = $inputValue * 0.254;
    $centimeters = $inputValue * 2.54;
    $millimeters = $inputValue * 25.4;
    $inches = $inputValue;
    $feet = $inputValue / 12;
} elseif ($selectedUnit == "Foot") {
    $kilometers = $inputValue * 0.0003048;
    $meters = $inputValue * 0.3048;
    $decimeters = $inputValue * 3.048;
    $centimeters = $inputValue * 30.48;
    $millimeters = $inputValue * 304.8;
    $inches = $inputValue * 12;
    $feet = $inputValue;
}
?>

<div id="tab">
    <table>
        <tr id="HeadTbl">
            <th>Name</th>
            <th>Symbol</th>
            <th>Result</th>
        </tr>
        <tr>
            <td>Kilometer</td>
            <td>Km</td>
            <td><?php echo $kilometers; ?></td>
        </tr>
        <tr>
            <td>Meter</td>
            <td>M</td>
            <td><?php echo $meters; ?></td>
        </tr>
        <tr>
            <td>Decimeter</td>
            <td>Dm</td>
            <td><?php echo $decimeters; ?></td>
        </tr>
        <tr>
            <td>Centimeter</td>
            <td>Cm</td>
            <td><?php echo $centimeters; ?></td>
        </tr>
        <tr>
            <td>Millimeter</td>
            <td>Mm</td>
            <td><?php echo $millimeters; ?></td>
        </tr>
        <tr>
            <td>Inch</td>
            <td>"</td>
            <td><?php echo $inches; ?></td>
        </tr>
        <tr>
            <td>Foot</td>
            <td>Ft</td>
            <td><?php echo $feet; ?></td>
        </tr>
    </table>
</div>

</body>
</html>