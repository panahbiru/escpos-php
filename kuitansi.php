<?php
error_reporting(~E_WARNING & ~E_NOTICE);
/* Call this file 'hello-world.php' */
require __DIR__ . '/autoload.php';
use Mike42\Escpos\PrintConnectors\CupsPrintConnector;
use Mike42\Escpos\EscposImage;
use Mike42\Escpos\Printer;
$connector = new CupsPrintConnector("Printer_USB_Thermal_Printer");
$printer = new Printer($connector);

$printer->setJustification(Printer::JUSTIFY_CENTER);
$printer->setTextSize(1,1);
$printer->text("Kopontren\n");
$printer->setTextSize(2,1);
$printer->setUnderline(Printer::UNDERLINE_DOUBLE);
$printer->text("PP Bahrul Ulum\n");
$printer->setUnderline(false);
$printer->setTextSize(1,1);
$printer->text("\n");
$printer->setJustification(Printer::JUSTIFY_LEFT);
$printer->text("ID. Transaksi:");
$printer->text("\n");
$printer->setPrintLeftMargin(128);
$printer->text("385101/K/2016");
$printer->text("\n\n");
$printer->setPrintLeftMargin(0);
$arr_item = array(
			'Songkok Gresik Al Iman, No 6'		=> 82000,
			'Buku Sinar Dunia, SD8700'			=> 8000,
			'Bidayatul Hidayah'					=> 11000
			);
			
foreach(array_keys($arr_item) as $k)
{
	$printer->setPrintLeftMargin(0);
	$printer->text($k);
	$printer->text("\n");
	$printer->setPrintLeftMargin(256);
	$printer->text($arr_item[$k]);
	$printer->text("\n");
	
	$tot += $arr_item[$k];
}
$printer->setPrintLeftMargin(0);
$printer->text("------------------------------ +");
$printer->text("\n");
$printer->text("Total");
$printer->text("\n");
$printer->setPrintLeftMargin(256);
$printer->text($tot.",-");
$printer->text("\n");
$printer->text("\n");
$printer->setJustification(Printer::JUSTIFY_CENTER);
$printer->setPrintLeftMargin(0);
$printer->text("Jazakallah atas kunjungannya.");
$printer->text("\n");
$printer->text( strftime('%c') );
$printer->text("\n\n");
$printer->text("\n\n");
$printer->cut();
$printer->close();
