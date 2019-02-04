<?php

function __autoload($classname)
{
    $dirs = ['Controllers', 'Requests', 'Views'];
    foreach ($dirs as $dir) {
        $file = "calculator/$dir/$classname.php";
        if (is_readable($file)) {
            include_once($file);
        }
    }
}

if (!empty($_GET)) {
    try {
        $cont = new calculatorController();

        echo (new View('calculator/Views/report.php'))
            ->render($cont->calculate(new calculatorRequest($_GET)));

        return;
    } catch (Exception $e) {
        echo 'Have errors:' . $e;

        return;
    }
}


//Draw Calculator
echo (new View('calculator/Views/calculator.php'))->render([]);