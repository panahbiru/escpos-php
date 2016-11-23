<?php
/* Call this file 'hello-world.php' */
require __DIR__ . '/autoload.php';
use Mike42\Escpos\PrintConnectors\CupsPrintConnector;
use Mike42\Escpos\EscposImage;
use Mike42\Escpos\Printer;
$connector = new CupsPrintConnector("Printer_USB_Thermal_Printer");
$printer = new Printer($connector);

$printer->setJustification(Printer::JUSTIFY_CENTER);
$printer->setTextSize(1,1);
$printer->text("Klinik & Apotek\n");
$printer->setTextSize(2,1);
$printer->setUnderline(Printer::UNDERLINE_DOUBLE);
$printer->text("PP Bahrul Ulum\n");
$printer->text("\n\n");
$printer->setUnderline(false);
$printer->setTextSize(1,1);
$printer->text("Loket & Nomor Antrian:");
$printer->text("\n");
$printer->text("    ==================    ");
$printer->text("\n");
$printer->setTextSize(2,1);
$printer->text("B - 038");
$printer->setTextSize(1,1);
$printer->text("\n");
$printer->text("    ==================    ");
$printer->text("\n\n\n");
$printer->text("Terimakasih atas kunjungan anda.");
$printer->text("\n");
$printer->text( strftime('%c') );
$printer->text("\n");

$printer->text("\n\n\n");
$printer->cut();
$printer->close();
