<?php
 
 /**
 * This class is merely used to publish assets that are needed by all dhtmlx
 * widgets and thus have to be imported before any widget gets rendered.
 * @copyright Frenzel GmbH - www.frenzel.net
 * @link http://www.frenzel.net
 * @author Philipp Frenzel <philipp@frenzel.net>
 */

namespace yiidhtmlx;

use yii\helpers\ArrayHelper;
use yii\helpers\Html;

/**
 * Chart renders an DHTMLX chart component.
 *
 * For example,
 *
 * ```php
 * Chart::widget(array(
 *	   'options'=>array(
 *		   'id'    => 'myTestChart',
 *		   'style' => 'width:280px;height:250px;',
 *	   ),
 *     'clientOptions' => array(
 *         'value' => '#sales#',
 *		   'label' => '#year#'
 *     ),
 *     'clientDataOptions'=> array(
 *         'type' => 'JSON',
 *		   'url' => 'http://my.json.data'
 *     )
 * ));
 * ```
 *
 * @see http://dhtmlx.com/chart
 * @author Philipp Frenzel <philipp@frenzel.net>
 * @since 1.0
 */

class Chart extends Widget
{

	/**
	 * @var array the data option for the underlying dhtmlx UI widget.
	 * Please refer to the corresponding dhtmlx UI widget Web page for possible options.
	 */
	public $dataOptions = array(
		'type'=>'JSON',
		'url' =>'http://default.json.url'
	);

	/**
	 * Initializes the widget.
	 */
	public function init()
	{
		parent::init();
		$this->initOptions();
	}

	/**
	 * Renders the widget.
	 */
	public function run()
	{
		echo Html::beginTag('div', $this->options) . "\n";
		echo $this->renderChart()."\n";
		echo Html::endTag('div')."\n";
		$this->registerPlugin('chart');
	}

	/**
	* Renders the chart
	*/
	public function renderChart()
	{
		return 'Chart';
	}

	/**
	 * Initializes the widget options.
	 * This method sets the default values for various options.
	 */
	protected function initOptions()
	{
		$this->options = array_merge(array(
			'class' => 'dhtmlxchart',
		), $this->options);

		$this->addCssClass($this->options, 'bg-color-blueLight');
	}
}
