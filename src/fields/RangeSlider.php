<?php

namespace lewisjenkins\craftrangeslider\fields;

use lewisjenkins\craftrangeslider\assetbundles\rangesliderfield\RangeSliderFieldAsset;

use Craft;
use craft\base\ElementInterface;
use craft\base\Field;
use yii\db\Schema;

class RangeSlider extends Field
{
    public $options = 'min: 100,
max: 1000,
from: 550';
    
    public $initialRows = 8;

    public static function displayName(): string
    {
        return Craft::t('craft-range-slider', 'LJ Range Slider');
    }

    public function getContentColumnType(): string
    {
        return Schema::TYPE_TEXT;
    }

    public function getSettingsHtml(): ?string
    {
        return Craft::$app->getView()->renderTemplate(
            'craft-range-slider/_components/fields/RangeSlider_settings',
            [
                'field' => $this,
            ]
        );
    }

    public function getInputHtml($value, ElementInterface $element = null): string
    {
	    $view = Craft::$app->getView();
        $view->registerAssetBundle(RangeSliderFieldAsset::class);

        $id = $view->formatInputId($this->handle);
        $namespacedId = $view->namespaceInputId($id);

		$templateMode = $view->getTemplateMode();
		$view->setTemplateMode($view::TEMPLATE_MODE_SITE);
		
		$variables['element'] = $element;
		$variables['this'] = $this;
		
		$options = $view->renderString($this->options, $variables);
		
		$view->setTemplateMode($templateMode);
        
        $values = explode(';', $value);
        
		$js = "
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
        
        $css = "#" . $namespacedId . " { display: none; }";
        
        $view->registerCss($css);

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
