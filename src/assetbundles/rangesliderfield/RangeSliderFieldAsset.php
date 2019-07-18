<?php
/**
 * Craft Range Slider plugin for Craft CMS 3.x
 *
 * ...
 *
 * @link      https://lj.io
 * @copyright Copyright (c) 2019 Lewis Jenkins
 */

namespace lewisjenkins\craftrangeslider\assetbundles\rangesliderfield;

use Craft;
use craft\web\AssetBundle;
use craft\web\assets\cp\CpAsset;

/**
 * @author    Lewis Jenkins
 * @package   CraftRangeSlider
 * @since     1.0.0
 */
class RangeSliderFieldAsset extends AssetBundle
{
    // Public Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    public function init()
    {
        $this->sourcePath = "@lewisjenkins/craftrangeslider/assetbundles/rangesliderfield/dist";

        $this->depends = [
            CpAsset::class,
        ];

        $this->js = [
            'js/RangeSlider.js',
        ];

        $this->css = [
            'css/RangeSlider.css',
        ];

        parent::init();
    }
}
