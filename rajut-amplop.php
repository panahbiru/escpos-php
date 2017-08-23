<?php
include "ezsql.php";
$thisdb         = new ezsql_mysqli('root','dhus','lukha','127.0.0.1');
$param = $argv[1];
$data = $thisdb->get_row("SELECT * FROM transaksi WHERE id = '$param' LIMIT 1");

error_reporting(~E_WARNING & ~E_NOTICE);
/* Call this file 'hello-world.php' */
require __DIR__ . '/autoload.php';
use Mike42\Escpos\PrintConnectors\CupsPrintConnector;
use Mike42\Escpos\EscposImage;
use Mike42\Escpos\Printer;
$connector = new CupsPrintConnector("Kasir58");
$printer = new Printer($connector);

$printer->setJustification(Printer::JUSTIFY_LEFT);
$printer->text("Kepada Yth. \n");
$printer->setTextSize(2,1);
$printer->text($data->nama_pembeli."\n");
$printer->setTextSize(1,1);
$printer->text($data->alamat." \n");
$printer->setTextSize(1,1);
$printer->text('No. HP '.$data->no_hp."\n");
$printer->text("\n\n");
$printer->text($data->vendor_ongkir."\n");
$printer->text('ISI : '.$data->isi_amplop."\n");
$printer->text("=========================== \n");
$printer->text("Dari: \n");
$printer->text("LUKHA SHOP \n");
$printer->text("085727244667 \n");
$printer->text("\n\n");
$printer->text("\n\n");
$printer->cut();
$printer->close();
