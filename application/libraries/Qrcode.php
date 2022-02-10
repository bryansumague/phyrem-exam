<?php
defined('BASEPATH') or exit('No direct script access allowed');

require VENDOR . 'autoload.php';

use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelHigh;
use Endroid\QrCode\Label\Alignment\LabelAlignmentCenter;
use Endroid\QrCode\Label\Font\NotoSans;
use Endroid\QrCode\RoundBlockSizeMode\RoundBlockSizeModeMargin;
use Endroid\QrCode\Writer\PngWriter;

class Qrcode
{

  public function generate($code)
  {
    return Builder::create()
      ->writer(new PngWriter())
      ->writerOptions([])
      ->data($code)
      ->encoding(new Encoding('UTF-8'))
      ->errorCorrectionLevel(new ErrorCorrectionLevelHigh())
      ->size(300)
      ->margin(10)
      ->roundBlockSizeMode(new RoundBlockSizeModeMargin())
      ->build();
  }
}
