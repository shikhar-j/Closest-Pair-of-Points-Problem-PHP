<?php
include("closest_pair.php");
header('Content-type: text/plain');

$array1 = array(array(4,7),
		array(1,2),
		array(18,6),
		array(9,11),
		array(2,9),
		array(5,10),
		array(15,1),
		array(11,18));

echo "Array 1: \n\n";
print_r ($array1);
echo "\n\n Output of Closest Pair function: \n\n";
print_r (closestPair($array1));

$array2 = array(array(5,9),
		array(9,3),
		array(2,0),
		array(8,4),
		array(7,4),
		array(9,10),
		array(1,9),
		array(8,2),
		array(0,10),
		array(9,6));
echo "\n\n Array 2: \n\n";
print_r ($array2);
echo "\n\n Output of Closest Pair function: \n\n";
print_r (closestPair($array2));

$array3 = array(array(0.748501, 4.09624),
		array(3.00302, 5.26164),
		array(3.61878, 9.52232), 
		array(7.46911, 4.71611),
		array(5.7819, 2.69367),
		array(2.34709, 8.74782),
		array(2.87169, 5.97774),
		array(6.33101, 0.463131),
		array(7.46489, 4.6268),
		array(1.45428, 0.087596));
echo "\n\n Array 3: \n\n";
print_r ($array3);
echo "\n\n Output of Closest Pair function: \n\n";
print_r (closestPair($array3));

?>
