<?php
 
 /**
 * This class is merely used to publish assets that are needed by all dhtmlx
 * widgets and thus have to be imported before any widget gets rendered.
 * @copyright Frenzel GmbH - www.frenzel.net
 * @link http://www.frenzel.net
 * @author Philipp Frenzel <philipp@frenzel.net>
 */

namespace yiidhtmlx;

use Yii;
use yii\base\View;
use yii\helpers\Json;
use yii\base\Widget as BaseWidget;

class Widget extends BaseWidget
{
	/**
	 * @var array the HTML attributes for the widget container tag.
	 */
	public $options = array();
	
	/**
	 * @var array the options for the underlying dhtmlx UI widget.
	 * Please refer to the corresponding dhtmlx UI widget Web page for possible options.
	 * For example, [this page](http://api.dhtmlx.com/accordion/) shows
	 * how to use the "Accordion" widget and the supported options (e.g. "header").
	 */
	public $clientOptions = array();
	
	/**
	 * @var array the event handlers for the underlying dhtmlx UI widget.
	 * Please refer to the corresponding dhtmlx UI widget Web page for possible events.
	 * For example, [this page](http://api.dhtmlx.com/accordion/) shows
	 * how to use the "Accordion" widget and the supported events (e.g. "create").
	 */
	public $clientEvents = array();

	/**
	 * @var array the data option for the underlying dhtmlx UI widget.
	 * Please refer to the corresponding dhtmlx UI widget Web page for possible options.
	 */
	public $clientDataOptions = array();

	/**
	 * Initializes the widget.
	 * If you override this method, make sure you call the parent implementation first.
	 */
	public function init()
	{
		parent::init();
		if (!isset($this->options['id'])) {
			$this->options['id'] = $this->getId();
		}
	}

	/**
	* Registers a specific dhtmlx widget and the related events
	* @param string $name the name of the dhtmlx plugin
	*/
	protected function registerPlugin($name)
	{		
		$id = $this->options['id'];
		$view = $this->getView();
		$view->registerAssetBundle("yiidhtmlx/$name");

		//for the js object generation, the first letter needs to be in upper case
		$name = ucfirst($name);

		if ($this->clientOptions !== false) {
			$options = empty($this->clientOptions) ? '' : Json::encode($this->clientOptions);
			$js = "var dhtmlx$id = new dhtmlX$name($options);\n";
			if($name === 'TreeObject')
			{
				if($this->enableContextMenu != '')
				{
					$dhtmlxMenuObject = $this->enableContextMenu;
					$js.="dhtmlx$id.enableContextMenu($dhtmlxMenuObject);\n";
				}
			}
			$view->registerJs($js,View::POS_READY);
		}

		if (!empty($this->clientDataOptions)) {
			$js = array();
			$type = empty($this->clientDataOptions['type']) ? 'json' : $this->clientDataOptions['type'];
			$url = empty($this->clientDataOptions['url']) ? '' : $this->clientDataOptions['url'];
			if($name === 'TreeObject')
			{
				$type = strtoupper($type);
				if($this->AutoLoading)
				{
					$js[] = "dhtmlx$id.setXMLAutoLoading('$url');";
					$js[] = "dhtmlx$id.setDataMode('$type');";
				}
				$js[] = "dhtmlx$id.load$type('$url');";	
			}
			else
			{
				$js[] = "dhtmlx$id.load('$url', '$type');";
			}//$js[] = "dhtmlx$id.refresh();";
			$view->registerJs(implode("\n", $js),View::POS_READY);
		}

		if (!empty($this->clientEvents)) {
			$js = array();
			foreach ($this->clientEvents as $event => $handler) {
				$js[] = "dhtmlx$id.attachEvent('$event', $handler);";
			}
			$view->registerJs(implode("\n", $js),View::POS_READY);
		}
	}

}

