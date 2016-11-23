<?php
error_reporting(~E_WARNING & ~E_NOTICE);
/* Call this file 'hello-world.php' */
require __DIR__ . '/autoload.php';
use Mike42\Escpos\PrintConnectors\CupsPrintConnector;
use Mike42\Escpos\EscposImage;
use Mike42\Escpos\Printer;
$connector = new CupsPrintConnector("Printer_USB_Thermal_Printer");
$printer = new Printer($connector);

$printer->setJustification(Printer::JUSTIFY_LEFT);
$printer->text("Kepada Yth. \n");
$printer->setTextSize(2,1);
$printer->text("Ichsan Zuhasdi \n");
$printer->setTextSize(1,1);
$printer->text("d.a Wisno Grahakom \n");
$printer->text("Jl. Diponegoro 62\nJetis Kota Yogyakarta, 55000\nD.I. Yogyakarta\nTelp: 08122799372 \n");
$printer->text("\n\n");
$printer->text("=========================== \n");
$printer->text("Dari: \n");
$printer->text("JALANIAGA \n");
$printer->text("http://toko.emka.web.id\nTelegram 085640385469 \n");
$printer->text("\n\n");
$printer->text("\n\n");
$printer->cut();
$printer->close();
