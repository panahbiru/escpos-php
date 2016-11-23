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
$printer->setTextSize(2,1);
$printer->text("JALANIAGA\n");
$printer->setTextSize(1,1);
$printer->setUnderline(Printer::UNDERLINE_DOUBLE);
$printer->text("http://toko.emka.web.id/\n");
$printer->setUnderline(false);
$printer->setTextSize(1,1);
$printer->text("\n");
$printer->setJustification(Printer::JUSTIFY_LEFT);
$printer->text("ID. Transaksi:");
$printer->text("\n");
$printer->setPrintLeftMargin(128);
$printer->text("INV/20161123/XVI/XI/58897707 [TOKOPEDIA]");
$printer->text("\n\n");
$printer->setPrintLeftMargin(0);
$arr_item = array(
			'Orange Pi Zero H2'		            => 195000,
			'Ongkir + Asuransi'			        => 10050
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
$printer->text("Terimakasih.");
$printer->text("\n");
$printer->text( strftime('%c') );
$printer->text("\n\n");
$printer->text("===============================\n\n");
$printer->setJustification(Printer::JUSTIFY_LEFT);
$printer->text("Ichsan Zuhasdi \n");
$printer->text("d.a Wisno Grahakom \n");
$printer->text("Jl. Diponegoro 62\nJetis Kota Yogyakarta, 55000\nD.I. Yogyakarta\nTelp: 08122799372 \n");
$printer->text("\n\n");
$printer->text("OS Orange Pi Zero dapat didownload di: http://www.orangepi.org/downloadresources/.\n\n");
$printer->setJustification(Printer::JUSTIFY_CENTER);
$printer->setTextSize(2,1);
$printer->text("Happy IoT-ing!");
$printer->text("\n\n");
$printer->text("\n\n");
$printer->cut();
$printer->close();
