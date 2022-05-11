<?php
/**
 * Craft Range Slider plugin for Craft CMS 3.x
 *
 * ...
 *
 * @link      https://lj.io
 * @copyright Copyright (c) 2019 Lewis Jenkins
 */

namespace lewisjenkins\craftrangeslider;

use lewisjenkins\craftrangeslider\fields\RangeSlider as RangeSliderField;

use Craft;
use craft\base\Plugin;
use craft\services\Plugins;
use craft\events\PluginEvent;
use craft\services\Fields;
use craft\events\RegisterComponentTypesEvent;

use yii\base\Event;

/**
 * Class CraftRangeSlider
 *
 * @author    Lewis Jenkins
 * @package   CraftRangeSlider
 * @since     1.0.0
 *
 */
class CraftRangeSlider extends Plugin
{
    // Static Properties
    // =========================================================================

    /**
     * @var CraftRangeSlider
     */
    public static $plugin;

    // Public Properties
    // =========================================================================

    /**
     * @var string
     */
    public string $schemaVersion = '1.0.0';

    // Public Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        self::$plugin = $this;

        Event::on(
            Fields::class,
            Fields::EVENT_REGISTER_FIELD_TYPES,
            function (RegisterComponentTypesEvent $event) {
                $event->types[] = RangeSliderField::class;
            }
        );

        Event::on(
            Plugins::class,
            Plugins::EVENT_AFTER_INSTALL_PLUGIN,
            function (PluginEvent $event) {
                if ($event->plugin === $this) {
                }
            }
        );

        Craft::info(
            Craft::t(
                'craft-range-slider',
                '{name} plugin loaded',
                ['name' => $this->name]
            ),
            __METHOD__
        );
    }

    // Protected Methods
    // =========================================================================

}
