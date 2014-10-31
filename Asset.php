<?php

namespace artkost\trumbowyg;

use yii\web\AssetBundle;

/**
 * This declares the asset files required by widget.
 *
 * @author Nikolay Kostyurin <nikolay@artkost.ru>
 * @since 2.0
 */
class Asset extends AssetBundle
{
    public $sourcePath = '@bower/trumbowyg/dist';
    public $css = [
        'ui/trumbowyg.css'
    ];
    public $js = [
        'trumbowyg.js'
    ];
    public $depends = [
        'yii\web\JqueryAsset'
    ];
}