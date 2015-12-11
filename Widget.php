<?php

namespace bupy7\date\range\picker;

use Yii;
use yii\widgets\InputWidget;
use yii\helpers\Json;
use yii\web\JsExpression;
use yii\web\View;

/**
 * Wrapper of bootstrap date range picker for Yii2.
 * 
 * Plugin home page: http://www.daterangepicker.com/
 * 
 * @author Belosludcev Vasilij <bupy765@gmail.com>
 * @since 1.0.0
 */
class Widget extends InputWidget
{
    /**
     * The key that identifies the JS code block.
     */
    const JS_KEY = 'bupy7/drp/';
        
    /**
     * @var array Options of plugin.
     * @see http://www.daterangepicker.com/#options
     */
    public $pluginOptions = [];
    /**
     * @var array Events of plugin.
     * @see http://www.daterangepicker.com/#events
     */
    public $pluginEvents = [];
    /**
     * @var string Language of plugin. If `null` then `\yii\base\Application::language` will be used.
     * @see MomentAsset::registerAssetFiles()
     */
    public $language;
    
    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        $language = $this->language ?: Yii::$app->language;
        $except = [
            'ar',
            'de',
            'en',
            'hy',
            'ms',
            'pt',
            'sr',
            'tl',
            'tzm',
            'zh',
        ];
        $isValid = true;
        for ($i = 0; $i != count($except); $i++) {
            $isValid = $isValid && stripos($language, $except[$i]) !== 0;
        }
        if ($isValid) {
            $this->language = explode('-', $language)[0];
        }
    }
    
    /**
     * @inheritdoc
     */
    public function run()
    {
        $this->registerAssets();
        $this->registerClientScripts();
        $this->registerPluginEvents();
    }
    
    /**
     * Registering of asset bundles for this plugin.
     */
    protected function registerAssets()
    {
        $momentAsset = MomentAsset::register($this->view);
        $momentAsset->language = $this->language;
        Asset::register($this->view);
    }
    
    /**
     * Registering of client scripts for this plugin.
     */
    protected function registerClientScripts()
    {
        $pluginOptions = Json::encode($this->pluginOptions);
        $this->view->registerJs("$('#{$this->options['id']}').daterangepicker({$pluginOptions});");
    }
    
    /**
     * Registering of plugin events.
     */
    protected function registerPluginEvents()
    {
        foreach ($this->pluginEvents as $event => $handler) {
            if (!empty($event)) {
                $handler = new JsExpression($handler);
                $this->view->registerJs(
                    "$('#{$this->options['id']}').on('{$event}', {$handler});",
                    View::POS_READY,
                    self::JS_KEY . 'events/' . $event
                );
            }
        }
    }
}
