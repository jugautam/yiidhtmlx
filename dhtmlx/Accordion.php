<?php
 
 /**
 * This class is merely used to publish assets that are needed by all dhtmlx
 * widgets and thus have to be imported before any widget gets rendered.
 * @copyright Frenzel GmbH - www.frenzel.net
 * @link http://www.frenzel.net
 * @author Philipp Frenzel <philipp@frenzel.net>
 */

namespace yiiext\dhtmlx;

use yii\base\InvalidConfigException;
use yii\helpers\base\ArrayHelper;
use yii\helpers\Html;

/**
 * Collapse renders an accordion bootstrap javascript component.
 *
 * For example:
 *
 * ```php
 * echo Accordion::widget(array(
 *     'items' => array(
 *         // equivalent to the above
 *         'Collapsible Group Item #1' => array(
 *             'content' => 'Anim pariatur cliche...',
 *             // open its content by default
 *             'contentOptions' => array('class'=>'in')
 *         ),
 *         // another group item
 *         'Collapsible Group Item #2' => array(
 *             'content' => 'Anim pariatur cliche...',
 *             'contentOptions' => array(...),
 *             'options' => array(...),
 *         ),
 *     )
 * ));
 * ```
 *
 * @author Philipp Frenzel <philipp@frenzel.net>
 * @since 2.0
 */
class Accordion extends Widget
{
	/**
	 * @var array list of groups in the collapse widget. Each array element represents a single
	 * group with the following structure:
	 *
	 * ```php
	 * // item key is the actual group header
	 * 'Collapsible Group Item #1' => array(
	 *     // required, the content (HTML) of the group
	 *     'content' => 'Anim pariatur cliche...',
	 *     // optional the HTML attributes of the content group
	 *     'contentOptions'=> array(),
	 *     // optional the HTML attributes of the group
	 *     'options'=> array(),
	 * )
	 * ```
	 */
	public $items = array();


	/**
	 * Initializes the widget.
	 */
	public function init()
	{
		parent::init();
		$this->registerWidget($this->options, 'accordion');
	}

	/**
	 * Renders the widget.
	 */
	public function run()
	{
		echo Html::beginTag('div', $this->options) . "\n";
		echo $this->renderItems() . "\n";
		echo Html::endTag('div') . "\n";
		$this->registerPlugin('collapse');
	}

	/**
	 * Renders collapsible items as specified on [[items]].
	 * @return string the rendering result
	 */
	public function renderItems()
	{
		$items = array();
		$index = 0;
		foreach ($this->items as $header => $item) {
			$options = ArrayHelper::getValue($item, 'options', array());
			$this->addCssClass($options, 'accordion-group');
			$items[] = Html::tag('div', $this->renderItem($header, $item, ++$index), $options);
		}

		return implode("\n", $items);
	}

	/**
	 * Renders a single collapsible item group
	 * @param string $header a label of the item group [[items]]
	 * @param array $item a single item from [[items]]
	 * @param integer $index the item index as each item group content must have an id
	 * @return string the rendering result
	 * @throws InvalidConfigException
	 */
	public function renderItem($header, $item, $index)
	{
		if (isset($item['content'])) {
			$id = $this->options['id'] . '-collapse' . $index;
			$options = ArrayHelper::getValue($item, 'contentOptions', array());
			$options['id'] = $id;
			$this->addCssClass($options, 'accordion-body collapse');

			$header = Html::a($header, '#' . $id, array(
					'class' => 'accordion-toggle',
					'data-toggle' => 'collapse',
					'data-parent' => '#' . $this->options['id']
				)) . "\n";

			$content = Html::tag('div', $item['content'], array('class' => 'accordion-inner')) . "\n";
		} else {
			throw new InvalidConfigException('The "content" option is required.');
		}
		$group = array();

		$group[] = Html::tag('div', $header, array('class' => 'accordion-heading'));
		$group[] = Html::tag('div', $content, $options);

		return implode("\n", $group);
	}
}
