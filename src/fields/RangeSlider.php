<?php
/**
 * Craft Range Slider plugin for Craft CMS 3.x
 *
 * ...
 *
 * @link      https://lj.io
 * @copyright Copyright (c) 2019 Lewis Jenkins
 */

namespace lewisjenkins\craftrangeslider\fields;

use lewisjenkins\craftrangeslider\CraftRangeSlider;
use lewisjenkins\craftrangeslider\assetbundles\rangesliderfield\RangeSliderFieldAsset;

use Craft;
use craft\base\ElementInterface;
use craft\base\Field;
use craft\helpers\Db;
use yii\db\Schema;
use craft\helpers\Json;

/**
 * @author    Lewis Jenkins
 * @package   CraftRangeSlider
 * @since     1.0.0
 */
class RangeSlider extends Field
{
    // Public Properties
    // =========================================================================

    /**
     * @var string
     */
    public $options = 'type: "double",
min: 0,
max: 1000,
from: 200,
to: 500,
grid: true';
    
    public $initialRows = 8;

    // Static Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    public static function displayName(): string
    {
        return Craft::t('craft-range-slider', 'LJ Range Slider');
    }

    // Public Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    public function rules()
    {
        $rules = parent::rules();
        $rules = array_merge($rules, [
        //    ['someAttribute', 'string'],
        //    ['someAttribute', 'default', 'value' => 'Some Default'],
        ]);
        return $rules;
    }

    /**
     * @inheritdoc
     */
    public function getContentColumnType(): string
    {
        return Schema::TYPE_TEXT;
    }

    /**
     * @inheritdoc
     */
    public function normalizeValue($value, ElementInterface $element = null)
    {
        return $value;
    }

    /**
     * @inheritdoc
     */
    public function serializeValue($value, ElementInterface $element = null)
    {
        return parent::serializeValue($value, $element);
    }

    /**
     * @inheritdoc
     */
    public function getSettingsHtml()
    {
        // Render the settings template
        return Craft::$app->getView()->renderTemplate(
            'craft-range-slider/_components/fields/RangeSlider_settings',
            [
                'field' => $this,
            ]
        );
    }

    /**
     * @inheritdoc
     */
    public function getInputHtml($value, ElementInterface $element = null): string
    {
	    $view = Craft::$app->getView();
        $view->registerAssetBundle(RangeSliderFieldAsset::class);

        // Get our id and namespace
        $id = $view->formatInputId($this->handle);
        $namespacedId = $view->namespaceInputId($id);

		$templateMode = $view->getTemplateMode();
		$view->setTemplateMode($view::TEMPLATE_MODE_SITE);
		
		$variables['element'] = $element;
		$variables['this'] = $this;
		
		$options = $view->renderString($this->options, $variables);
		
		$view->setTemplateMode($templateMode);
        
        $values = explode(';', $value);
        
		$js ="
			$('#" . $namespacedId . "').ionRangeSlider({" . $options . "});
			var instance = $('#" . $namespacedId . "').data('ionRangeSlider');
			var values = instance.options.values.map(String);
			if (values.length) {
				instance.update({
					" . (isset($values[0]) && $values[0] != '' ? 'from: values.indexOf(\'' . $values[0] . '\'),' : '') . "
					" . (isset($values[1]) && $values[1] != '' ? 'to: values.indexOf(\'' . $values[1] . '\')' : '') . "
					});
			} else {
				instance.update({
					" . (isset($values[0]) && $values[0] != '' ? 'from: ' . $values[0] . ',' : '') . "
					" . (isset($values[1]) && $values[1] != '' ? 'to: ' . $values[1] : '') . "
					});
			};
			";
        $view->registerJs($js);

        return $view->renderTemplate(
            'craft-range-slider/_components/fields/RangeSlider_input',
            [
                'name' => $this->handle,
                'value' => $value,
                'field' => $this,
                'id' => $id
            ]
        );
    }
}
