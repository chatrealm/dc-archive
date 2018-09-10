<?php
/**
 * Return seconds as a text useful for humans
 *
 * @param int $seconds Description
 * @return string
 */
function secondsToHuman($seconds) {
	$hours = floor($seconds / (60 * 60));
	$seconds -= $hours * 60 * 60;
	$minutes = floor($seconds / 60);
	$seconds -= $minutes * 60;
	return ($hours ? $hours . ':' : '') . str_pad($minutes, 2, '0', STR_PAD_LEFT) . ':' . str_pad($seconds, 2, '0', STR_PAD_LEFT);
}
