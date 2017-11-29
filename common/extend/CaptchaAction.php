<?php
namespace common\extend;


class CaptchaAction extends \yii\captcha\CaptchaAction
{
    protected function renderImageByGD($code)
    {
        $image = imagecreatetruecolor($this->width, $this->height);

        $backColor = imagecolorallocate(
            $image,
            (int)($this->backColor % 0x1000000 / 0x10000),
            (int)($this->backColor % 0x10000 / 0x100),
            $this->backColor % 0x100
        );
        imagefilledrectangle($image, 0, 0, $this->width - 1, $this->height - 1, $backColor);
        imagecolordeallocate($image, $backColor);

        if ($this->transparent) {
            imagecolortransparent($image, $backColor);
        }

        $foreColor = imagecolorallocate(
            $image,
            (int)($this->foreColor % 0x1000000 / 0x10000),
            (int)($this->foreColor % 0x10000 / 0x100),
            $this->foreColor % 0x100
        );

        $length = strlen($code);
        $box    = imagettfbbox(30, 0, $this->fontFile, $code);
        $w      = $box[4] - $box[0] + $this->offset * ($length - 1);
        $h      = $box[1] - $box[5];
        $scale  = min(($this->width - $this->padding * 2) / $w, ($this->height - $this->padding * 2) / $h);
        $x      = 10;
        $y      = 20;
        for ($i = 0; $i < $length; ++$i) {
            $fontSize = 18;
            $angle    = mt_rand(-10, 10);
            $letter   = $code[$i];
            $box      = imagettftext($image, $fontSize, $angle, $x, $y, $foreColor, $this->fontFile, $letter);
            $x        = $box[2] + 10;
        }

        imagecolordeallocate($image, $foreColor);

        ob_start();
        imagepng($image);
        imagedestroy($image);

        return ob_get_clean();
    }
}