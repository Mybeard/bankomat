<?php
$nominalArray = [1, 2, 5, 10, 20, 50, 100, 200, 500];
$summa = $argv[1];
$result = [];

checkMaxLimit($summa);
nominalNumCount($summa, $nominalArray, $result);
printResult($result);

function checkMaxLimit($summa)
{
    $maxLimit = 100000;
    if ($summa > $maxLimit) {
        exit('Max summ 100k' . \PHP_EOL);
    }
}

function nominalNumCount($summa, $nominalArray, &$result)
{
    $nominal = \array_pop($nominalArray);
    if ($summa <= $nominal) {
        $nominal = \array_pop($nominalArray);
    }
    if ($summa % $nominal) {
        list($total, $rest) = \explode('.', $summa / $nominal);
    } else {
        $total = $summa / $nominal;
    }
    if ($total > 0) {
        $result[$nominal] = $total;
    }
    if (isset($rest)) {
        $rest = $summa - $total * $nominal;
        nominalNumCount($rest, $nominalArray, $result);
    }
}

function printResult($result)
{
    foreach ($result as $key => $val) {
        echo "$key: $val", \PHP_EOL;
    }
}