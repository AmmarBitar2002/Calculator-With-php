<?php



function calculate($input) {

    $input = preg_replace('/[^0-9\+\-\*\/\.\%]/', '', $input);
   
    try {
        eval("\$result = $input;");
    } catch (Exception $e) {
        return 'Error';
    }
    return isset($result) ? $result : 'Error';
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $display = $_POST['display'];
    $button = $_POST['button'];

    switch ($button) {
        case 'C':
            $display = '0';
            break;
        case 'Del':
            $display = substr($display, 0, -1);
            if ($display === '') {
                $display = '0';
            }
            break;
        case '=':
            $display = calculate($display);
            break;
        default:
            if ($display === '0' || $display === 'Error') {
                $display = $button;
            } else {
                $display .= $button;
            }
            break;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculator</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f0f0f0;
        }
        .calculator {
            width: 220px;
            background-color: #50c0bc;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }
        .display {
            width: 100%;
            height: 50px;
            background-color: white;
            border-radius: 5px;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            justify-content: flex-end;
            font-size: 24px;
            padding: 10px;
            box-sizing: border-box;
        }
        .buttons {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 10px;
        }
        .button {
            width: 100%;
            height: 50px;
            background-color: white;
            border: none;
            border-radius: 5px;
            font-size: 18px;
            cursor: pointer;
            transition: background-color 0.2s;
        }
        .button:hover {
            background-color: #e0e0e0;
        }
        .button.operator {
            background-color: #ffcf70;
        }
        .button.operator:hover {
            background-color: #ffb900;
        }
        .button.zero {
            grid-column: span 2;
        }
    </style>
</head>
<body>
    <div class="calculator">
        <form method="post" action="">
            <div class="display" id="display"><?php echo isset($display) ? $display : '0'; ?></div>
            <input type="hidden" name="display" id="hiddenDisplay" value="<?php echo isset($display) ? $display : '0'; ?>">
            <div class="buttons">
                <button type="submit" name="button" value="C" class="button">C</button>
                <button type="submit" name="button" value="Del" class="button">Del</button>
                <button type="submit" name="button" value="%" class="button operator">%</button>
                <button type="submit" name="button" value="/" class="button operator">/</button>
                <button type="submit" name="button" value="7" class="button">7</button>
                <button type="submit" name="button" value="8" class="button">8</button>
                <button type="submit" name="button" value="9" class="button">9</button>
                <button type="submit" name="button" value="*" class="button operator">*</button>
                <button type="submit" name="button" value="4" class="button">4</button>
                <button type="submit" name="button" value="5" class="button">5</button>
                <button type="submit" name="button" value="6" class="button">6</button>
                <button type="submit" name="button" value="-" class="button operator">-</button>
                <button type="submit" name="button" value="1" class="button">1</button>
                <button type="submit" name="button" value="2" class="button">2</button>
                <button type="submit" name="button" value="3" class="button">3</button>
                <button type="submit" name="button" value="+" class="button operator">+</button>
                <button type="submit" name="button" value="0" class="button zero">0</button>
                <button type="submit" name="button" value="." class="button">.</button>
                <button type="submit" name="button" value="=" class="button operator">=</button>
            </div>
        </form>
    </div>
</body>
</html>
