<?php 

//the array should be sorted 

function binarySearch(array $numbers, int $needle, int $low, int $high): bool {
    if($high < $low) {
        return FALSE;
    }
    $mid = (int) (($low + $high) / 2 );
    if($numbers[$mid] > $needle ) {
        return binarySearch($numbers, $needle, $low, $mid-1);
    } elseif($numbers[$mid] < $needle) {
        return binarySearch($numbers, $needle, $mid + 1, $high);
    } else {
        return TRUE;
    }
}

function exponentialSearch(array $arr, int $key): int {
    $size = count($arr);

    if($size == 0)
        return -1;
    
    $bound = 1;
    while($bound < $size && $arr[$bound] < $key)
    {
        $bound  *= 2; 
    }
    return binarySearch($arr, $key, ($bound / 2), min($bound, $size-1));
}

$arr = [1,2,3,4,5,6,7,8,9,10,11,12];
$key = 2; 

if (exponentialSearch($arr, $key))
{
    echo "$key has been found";
}else {
    echo "$key has not been found";
}