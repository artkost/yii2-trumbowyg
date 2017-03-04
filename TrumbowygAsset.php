<?php

namespace artkost\trumbowyg;

use yii\web\AssetBundle;

/**
 * This declares the asset files required by widget.
 *
 * @author Nikolay Kostyurin <nikolay@artkost.ru>
 * @since 2.0
 */
class TrumbowygAsset extends AssetBundle
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
    /**
     * @var string language
     */
    public $language;
    /**
     * @var array plugins array
     */
    public $plugins = [];

    /**
     * Register asset bundle language files and plugins.
     */
    public function registerAssetFiles($view)
    {
        if ($this->language !== null) {
            $this->js[] = 'langs/' . $this->language . '.min.js';
        }
        if (!empty($this->plugins)) {
            foreach ($this->plugins as $plugin) {
                if ($plugin === 'colors') {
                    $this->css[] = 'plugins/' . $plugin . '/ui/trumbowyg.' . $plugin . '.css';
                }
                $this->js[] = 'plugins/' . $plugin . '/trumbowyg.' . $plugin . '.js';
            }
        }
        parent::registerAssetFiles($view);
    }
}