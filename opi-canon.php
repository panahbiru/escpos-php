<?php
include "ezsql.php";
$thisdb         = new ezsql_mysqli('root','','jalaniaga','192.168.56.12');
$param = $argv[1];
$data = $thisdb->get_row("SELECT * FROM transaksi WHERE id = '$param' LIMIT 1");
$data_produk = $thisdb->get_results("SELECT * FROM produk WHERE id IN ($data->list_produk)");
error_reporting(~E_WARNING & ~E_NOTICE);
/* Call this file 'hello-world.php' */
require __DIR__ . '/autoload.php';
use Mike42\Escpos\PrintConnectors\CupsPrintConnector;
use Mike42\Escpos\EscposImage;
use Mike42\Escpos\Printer;
$connector = new CupsPrintConnector("Canon_iP2800_series");
$printer = new Printer($connector);

$printer->setJustification(Printer::JUSTIFY_CENTER);
$printer->setTextSize(2,1);
$printer->text("JALANIAGA\n");
$printer->setTextSize(1,1);
$printer->setUnderline(Printer::UNDERLINE_DOUBLE);
$printer->text("http://sisteminformasi.biz/\n");
$printer->setUnderline(false);
$printer->setTextSize(1,1);
$printer->text("\n");
$printer->setJustification(Printer::JUSTIFY_LEFT);
$printer->text("ID. Transaksi:");
$printer->text("\n");
$printer->setPrintLeftMargin(128);
$printer->text($data->id_transaksi_lain." [".strtoupper($data->vendor)."]");
$printer->text("\n\n");
$printer->setPrintLeftMargin(0);
foreach($data_produk as $k)
{
	$printer->setPrintLeftMargin(0);
	$printer->text($k->nama_barang);
	$printer->text("\n");
	$printer->setPrintLeftMargin(256);
	$printer->text($k->rp_harga);
	$printer->text("\n");
}
$printer->setPrintLeftMargin(0);
$printer->text('Ongkir, dll');
$printer->text("\n");
$printer->setPrintLeftMargin(256);
$printer->text($data->rp_ongkir);
$printer->text("\n");

$printer->setPrintLeftMargin(0);
$printer->text("------------------------------ +");
$printer->text("\n");
$printer->text("Total");
$printer->text("\n");
$printer->setPrintLeftMargin(256);
$printer->text($data->rp_total.",-");
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
$printer->text($data->nama_pembeli." \n");
$printer->text($data->alamat." \n No. HP ".$data->no_hp);
$printer->text("\n\n");
$printer->text("OS Orange Pi dapat didownload di: http://www.orangepi.org/downloadresources/.\n\n");
$printer->setJustification(Printer::JUSTIFY_CENTER);
$printer->setTextSize(2,1);
$printer->text("Happy IoT-ing!");
$printer->text("\n\n");
$printer->text("\n\n");
$printer->cut();
$printer->close();
