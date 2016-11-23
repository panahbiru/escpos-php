<?php
/* Call this file 'hello-world.php' */
require __DIR__ . '/autoload.php';
use Mike42\Escpos\PrintConnectors\FilePrintConnector;
use Mike42\Escpos\EscposImage;
use Mike42\Escpos\Printer;
$connector = new FilePrintConnector("php://stdout");
$printer = new Printer($connector);
$str = "CV SistemInformasi.biz
======================
\n
ID. Transaksi:
\t 385101/K/2016

LiveUSB Kali Linux
\t 80.000,-

Panduan Kali Linux PDF
\t 140.000,-
----------------------- +
Total
\t 220.000,-
Terimakasih
\n\n\n
";
$printer -> text($str);
$printer -> cut();
$printer -> close();
