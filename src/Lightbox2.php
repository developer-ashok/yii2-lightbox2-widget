<?php

/**
 * @package yii2-extensions
 * @license The MIT License
 * @copyright Copyright (C) 2012-2018 Sergio coderius <coderius>
 * @contacts sunrise4fun@gmail.com - Have suggestions, contact me :)
 * @link https://github.com/coderius - My GitHub
 */
namespace coderius\lightbox2;

use yii\base\Widget;
use yii\helpers\Json;

class Lightbox2 extends Widget
{
    /**
     * @var string the URL to your custom Lightbox2 JavaScript file.
     */
    public $customJsUrl;

    /**
     * @var array the options for the Lightbox2 JS plugin.
     */
    public $clientOptions = [];

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
    }

    /**
     * @inheritdoc
     */
    public function run()
    {
        $plugin = $this->makePlugin('lightbox');
        $this->registerAssets($plugin);
    }

    /**
     * @param string $name
     * @return string
     */
    protected function makePlugin($name)
    {
        $js = '';

        if ($this->clientOptions !== false) {
            $options = empty($this->clientOptions) ? '' : Json::encode($this->clientOptions);
            $js = "$name.option($options);";
        }

        return $js;
    }

    /**
     * @param string $plugin
     */
    protected function registerAssets($plugin)
    {
        $view = $this->getView();
        if ($this->customJsUrl !== null) {
            $view->registerJsFile($this->customJsUrl, ['depends' => Lightbox2Asset::class]);
        }
        $view->registerJs($plugin);
    }
}
