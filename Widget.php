<?php

namespace artkost\trumbowyg;

use yii\base\InvalidConfigException;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\widgets\InputWidget;
use Yii;

/**
 * Trumbowyg widget.
 *
 * @property string $settings
 * @property string $selector
 *
 * @author Nikolay Kostyurin <nikolay@artkost.ru>
 *
 * @version 1.1.7
 *
 * @link http://github.com/artkost/yii2-trumbowyg
 * @link http://alex-d.github.io/Trumbowyg/
 * @license http://github.com/artkost/yii2-trumbowyg/blob/master/LICENSE
 */
class Widget extends InputWidget
{
    /**
     * @var array {@link http://alex-d.github.io/Trumbowyg/documentation.html options}.
     */
    public $settings = [];

    /**
     * @var string|null Selector pointing to textarea to initialize redactor for.
     * Defaults to null meaning that textarea does not exist yet and will be
     * rendered by this widget.
     */
    public $selector;

    /**
     * @var boolean Depends on this attribute textarea will be rendered or not
     */
    private $_renderTextarea = true;

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        $this->registerTranslations();

        if (isset($this->settings['plugins']) && !is_array($this->settings['plugins'])) {
            throw new InvalidConfigException('The "plugins" property must be an array.');
        }

        if (!isset($this->settings['lang']) && Yii::$app->language !== 'en-US') {
            $this->settings['lang'] = substr(Yii::$app->language, 0, 2);
        }

        if ($this->selector === null) {
            $this->selector = '#' . $this->options['id'];
        } else {
            $this->_renderTextarea = false;
        }
    }

    /**
     * Register widget translations.
     */
    public function registerTranslations()
    {
        Yii::$app->i18n->translations['trumbowyg'] = [
            'class' => 'yii\i18n\PhpMessageSource',
            'basePath' => '@artkost/yii2-trumbowyg/messages',
            'forceTranslation' => true
        ];
    }

    /**
     * @inheritdoc
     */
    public function run()
    {
        $this->registerClientScript();

        if ($this->_renderTextarea === true) {
            if ($this->hasModel()) {
                return Html::activeTextarea($this->model, $this->attribute, $this->options);
            } else {
                return Html::textarea($this->name, $this->value, $this->options);
            }
        }
    }

    /**
     * Register widget asset.
     */
    public function registerClientScript()
    {
        $view = $this->getView();
        $selector = Json::encode($this->selector);
        $asset = Asset::register($view);

        if (isset($this->settings['lang'])) {
            $asset->language = $this->settings['lang'];
        }

        if (isset($this->settings['plugins'])) {
            $asset->plugins = $this->settings['plugins'];
        }

        $settings = !empty($this->settings) ? Json::encode($this->settings) : '';

        $view->registerJs("jQuery($selector).trumbowyg($settings);");
    }
}