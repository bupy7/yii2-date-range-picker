<?php

namespace bupy7\drp\assets;

use yii\web\AssetBundle;

/**
 * Assets of bootstrap plugin `Date Range Picker`.
 * 
 * Home page: https://github.com/dangrossman/bootstrap-daterangepicker
 * 
 * @author Belosludcev Vasilij <bupy765@gmail.com>
 * @since 1.0.0
 */
class Asset extends AssetBundle
{
    /**
     * @inheritdoc
     */
    public $sourcePath = '@bower/bootstrap-daterangepicker';
    /**
     * @inheritdoc
     */
    public $js = [
        'daterangepicker.js',
    ];
    /**
     * @inheritdoc
     */
    public $css = [
        'daterangepicker.css',
    ];
    /**
     * @inheritdoc
     */
    public $depends = [
        'bupy7\drp\MomentAsset',
    ];
}