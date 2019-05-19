<?php

/*
 * This file is part of the zhouzishu/laravel-html-detector.
 *
 * (c) zhouzishu <2693558149@qq.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

require __DIR__.'/vendor/autoload.php';
use Zhouzishu\LaravelHtmlDetector\Detector;

$checker = new Detector('
<iframe><p>1234</p>');

var_dump($checker->fix());
