<?php
namespace common\extend;

use yii\base\InvalidConfigException;
use yii\bootstrap\Nav;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

/**
 * Class ListGroupWidget
 *
 * @package valiant\widgets
 */
class BSListGroup extends Nav
{
    /**
     * Initializes the widget.
     */
    public function init()
    {
        parent::init();
        Html::removeCssClass($this->options, 'nav');
        Html::addCssClass($this->options, 'list-group');
    }

    /**
     * Renders the widget.
     */
    public function run()
    {
        return $this->renderItems();
    }

    /**
     * Renders a widget's item.
     *
     * @param string|array $item the item to render.
     *
     * @return string the rendering result.
     * @throws InvalidConfigException
     */
    public function renderItem($item)
    {
        if (is_string($item)) {
            return $item;
        }
        if (!isset($item['label'])) {
            throw new InvalidConfigException("The 'label' option is required.");
        }
        $encodeLabel = isset($item['encode']) ? $item['encode'] : $this->encodeLabels;
        $label       = $encodeLabel ? Html::encode($item['label']) : $item['label'];
        $options     = ArrayHelper::getValue($item, 'options', []);
        $url         = ArrayHelper::getValue($item, 'url', '#');
        if (isset($item['active'])) {
            $active = ArrayHelper::remove($item, 'active', FALSE);
        } else {
            $active = $this->isItemActive($item);
        }
        Html::addCssClass($options, 'list-group-item');
        if ($this->activateItems && $active) {
            Html::addCssClass($options, 'active');
        }

        return Html::a($label, $url, $options);
    }
}
