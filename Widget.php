<?php

namespace bupy7\drp;

use Yii;
use yii\widgets\InputWidget;
use yii\helpers\Json;
use yii\web\JsExpression;
use yii\web\View;
use yii\helpers\Html;
use bupy7\drp\traits\WidgetTrait;
use bupy7\drp\assets\DateRangePickerAsset;
use bupy7\drp\assets\MomentAsset;

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
    use WidgetTrait;
    
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
     * @var array Events of plugin where `key` is event name and `value` is handler function.
     * @see http://www.daterangepicker.com/#events
     */
    public $pluginEvents = [];
    /**
     * @var string Language of plugin. If `null` then `\yii\base\Application::language` will be used.
     * @see MomentAsset::registerAssetFiles()
     * @see WidgetTrait::convertLanguage()
     */
    public $language;
    /**
     * @var boolean Whether set `true` property `$pluginOptions['locale']['format']` will be converting to correct
     * format of Moment.js library from PHP DateTime format.
     * @see WidgetTrait::convertDateFormat()
     */
    public $convertDateFormat = false;
    /**
     * @inheritdoc
     */
    public $options = ['class' => 'form-control'];
    
    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        $this->language = $this->convertLanguage($this->language, Yii::$app->language);
        if ($this->convertDateFormat && isset($this->pluginOptions['locale']['format'])) {
            $this->pluginOptions['locale']['format'] = $this->convertDateFormat($this->pluginOptions['locale']['format']);
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
        return $this->renderFieldInput();
    }
    
    /**
     * Rendering field input of date range picker.
     * @return string
     */
    protected function renderFieldInput()
    {
        if ($this->hasModel()) {
            return Html::activeTextInput($this->model, $this->attribute, $this->options);
        } else {
            return Html::textInput($this->name, $this->value, $this->options);
        }
    }
    
    /**
     * Registering of asset bundles for this plugin.
     */
    protected function registerAssets()
    {
        $momentAsset = MomentAsset::register($this->view);
        $momentAsset->language = $this->language;
        DateRangePickerAsset::register($this->view);
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
