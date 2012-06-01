<?php
/**
 * Recursive Divide & Conquer Function for Closest Pair of points problem (PHP)
 * @author Shikhar Jaiswal
 * @version 1.0
 */
 
/**
 * Finds distance between two points.
 */
function getDistance(array $p1, array $p2) {

	//Square root is skipped as for comparing distance between two points, it doesn't make a difference.
	$distance = pow(($p1[0]-$p2[0]),2) + pow(($p1[1]-$p2[1]),2);
	return $distance;
	
}
/**
 * Brute force method for calculating closest pair of points and the distance between them.
 */
function bruteForce(array $points) {

	$size = sizeof($points);
	
	//declare variables
	$closest = false;
	$closestpair = false;
	
	//calculate minimum distance
	for ($i = 0; $i < $size - 1; $i++) {
		for ($j = $i+1; $j < $size; $j++) {
			$distance = getDistance($points[$i],$points[$j]);
			if($closest === false || $distance < $closest) {
				$closest = $distance;
				$closestpair = array($points[$i],$points[$j]);
			}
		}
	}
	
	return array($closest,$closestpair);
}

/**
 * Custom function for sorting the array by x axis for usort
 */
function sort_x($a,$b) {
	
	//each variable is a point. Each point is an array with two values: x coordinate (a[0]) and y coordinate (a[1])
	return $a[0] - $b[0];
	
}

/**
 * Custom function for sorting the array by y axis for usort
 */
function sort_y($a,$b) {
	
	//each variable is a point. Each point is an array with two values: x coordinate (a[0]) and y coordinate (a[1])
	return $a[1] - $b[1];
	
}

/**
 * Helper function to sort input array by x axis and y axis before passing them to _closestPair function.
 * @param array $P array of all the points, each point is inturn array with two elements - x coordinate and y coordinate 
 */
function closestPair(array $P) {

	$xP = $yP = $P;
	
	//sort $xP by x axis and $yP by y axis using custom functions
	usort($xP, 'sort_x'); usort($yP, 'sort_y');
	
	//call the _closestPair function to recursively calculate closest pair of points.
	return _closestPair($xP,$yP);
	
}

/**
 * Recursively calculates the closest pair of points.
 * @param array $xP Array of points sorted by x axis
 * @param array $yP Array of points sorted by y axis
 * @return array Minimum distance and Closest pair of points
 */
function _closestPair(array $xP, array $yP) {

	$size = sizeof($xP);
	
	//if array size is less than 3 then use bruteForce to calculate necessary values
	if($size <= 3) {
		list($closest,$closestPair) = bruteforce($xP);
		return array($closest,$closestPair);
	}
	
	//slice array sorted by x axis into left and right half
	$xL = array_slice($xP,0,$size/2);
	$xR = array_slice($xP,$size/2);
	$xm = $xP[$size/2];
	
	//slice array sorted by y axis into left and right half
	$yL = array();
	$yR = array();
	
	foreach ($yP as $p) {
		($p[1] < $xm[1]) ? $yL[] = $p : $yR[] = $p;
	}
	
	//recursively call _closestPair on both left and right half
	list($LClosest,$LClosestPair) = _closestPair($xL, $yL);
	list($RClosest,$RClosestPair) = _closestPair($xR, $yR);
	$minD = $LClosest; $minDPair = $LClosestPair;
	
	//if right side has the closest pair then update values with the ones from right half of the array
	if($RClosest < $minD) {
		$minD = $RClosest; $minDPair = $RClosestPair;
	}
	
	//calculate points near the median of array (xm) within the distance (xm + minD) and (xm - minD)
	$pointsY = array();
	
	foreach ($yP as $p) {
		(getDistance($p,$xm) < $minD) ? $pointsY[] = $p : '';
	}
	
	$sizeY = sizeof($pointsY);
	
	$closestD = $minD;
	$closestPair = $minDPair;
	
	//find if there exists a pair that is the closest within the distance (xm + minD) and (xm - minD)
	if($sizeY > 1) {
		for($i = 0; $i < min(6,$sizeY-1); $i++) {
			for($j = 1; $j < min(7,$sizeY); $j++) {
				if (getDistance($pointsY[$i],$pointsY[$j]) < $minD) {
					$closestD = getDistance($pointsY[$i],$pointsY[$j]);
					$closestPair = array($pointsY[$i],$pointsY[$j]);
				}
			}
		}
	}
	
	//return an array with the distance betwwen closest pair of points and the points.
	return array($closestD, $closestPair);
}

header('Content-type: text/plain');
print_r (closestPair(array(
	array(4,7),
	array(1,2),
	array(18,6),
	array(9,11),
	array(2,9),
	array(5,10),
	array(15,1),
	array(11,18),
)));
print_r (closestPair(array(
	array(5,9),
	array(9,3),
	array(2,0),
	array(8,4),
	array(7,4),
	array(9,10),
	array(1,9),
	array(8,2),
	array(0,10),
	array(9,6)
)));
print_r (closestPair(array(
	array(0.748501, 4.09624),
	array(3.00302, 5.26164),
	array(3.61878, 9.52232), 
	array(7.46911, 4.71611),
	array(5.7819, 2.69367),
	array(2.34709, 8.74782),
	array(2.87169, 5.97774),
	array(6.33101, 0.463131),
	array(7.46489, 4.6268),
	array(1.45428, 0.087596)
)));

?>