<?php
require_once(dirname(__FILE__) . '/../Escpos.php');
/* This is three examples in one:
 *  1: Print an entire PDF, normal quality.
 *  2: Print at a lower quality for speed increase (CPU & transfer)
 *  3: Cache rendered documents for a speed increase (removes CPU image processing completely on subsequent prints)
 */

/* 1: Print an entire PDF, start-to-finish (shorter form of the example) */
$printer = new Escpos();
$pdf = 'images/document.pdf';
$pages = EscposImage::loadPdf($pdf);
foreach($pages as $page) {
	$printer -> graphics($page);
}
$printer -> cut();
$printer -> close();

/*
 * 2: Speed up printing by roughly halving the resolution, and printing double-size.
 * This gives a 75% speed increase at the expense of some quality.
 * 
 * Reduce the page width further if necessary: if it extends past the printing area, your prints will be very slow.
 */
$printer = new Escpos();
$pdf = 'images/document.pdf';
$pages = EscposImage::loadPdf($pdf, 260);
foreach($pages as $page) {
	$printer -> graphics($page, Escpos::IMG_DOUBLE_HEIGHT | Escpos::IMG_DOUBLE_WIDTH);
}
$printer -> cut();
$printer -> close();

/*
 * 3: PDF printing still too slow? If you regularly print the same files, serialize & compress your
 * EscposImage objects (after printing[1]), instead of throwing them away.
 * 
 * (You can also do this to print logos on computers which don't have an
 * image processing library, by preparing a serialized version of your logo on your PC)
 * 
 * [1]After printing, the pixels are loaded and formatted for the print command you used, so even a raspberry pi can print complex PDF's quickly.
 */
$printer = new Escpos();
$pdf = 'images/document.pdf';
$ser = 'images/document.z';
if(!file_exists($ser)) {
	$pages = EscposImage::loadPdf($pdf);
} else {
	$pages = unserialize(gzuncompress(file_get_contents($ser)));
}

foreach($pages as $page) {
	$printer -> graphics($page);
}
$printer -> cut();
$printer -> close();

if(!file_exists($ser)) {
	file_put_contents($ser, gzcompress(serialize($pages)));
}