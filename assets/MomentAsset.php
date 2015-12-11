<?php

namespace bupy7\drp\assets;

use yii\web\AssetBundle;

/**
 * Assets of Moment library for JavaScript.
 * 
 * Home page: https://github.com/moment/moment
 * 
 * @author Belosludcev Vasilij <bupy765@gmail.com>
 * @since 1.0.0
 */
class MomentAsset extends AssetBundle
{
    /**
     * @inheritdoc
     */
    public $sourcePath = '@bower/moment';
    /**
     * @inheritdoc
     */
    public $js = [
        'min/moment.min.js',
    ];
    /**
     * @inheritdoc
     */
    public $depends = [
        'yii\bootstrap\BootstrapPluginAsset',
    ];
    /**
     * @var string Language of current localisation. Based on this property will be loading localisation from library.
     * @since 1.0.0
     */
    public $language;
    
    /**
     * @inheritdoc
     */
    public function registerAssetFiles($view)
    {
        if ($this->language !== null) {
            $this->js[] = "locale/{$this->language}.js";
        }
        parent::registerAssetFiles($view);
    }
}