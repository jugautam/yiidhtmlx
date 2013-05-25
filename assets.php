<?php

return array(
	'yiidhtmlx' => array(
		'sourcePath' => __DIR__ . '/yiidhtmlx/assets',
		'js' => array(
			'js/dhtmlxcommon.js',
		),
	),
	'yiidhtmlx\chart' => array(
		'sourcePath' => __DIR__ . '/yiidhtmlx/assets',
		'js' => array(
			'js/dhtmlxchart.js',
		),
		'css'=>array(
			'css/dhtmlxchart.css'
		),
		'depends' => array('yiidhtmlx'),
	),
	'yiidhtmlx\alert' => array(
		'sourcePath' => __DIR__ . '/yiidhtmlx/assets',
		'js' => array(
			'js/dhtmlxmessage.js',
		),
		'css'=>array(
			'css/dhtmlxmessage_dhx_web.css'
		),
		'depends' => array('yiidhtmlx'),
	),
	'yiidhtmlx\accordion' => array(
		'sourcePath' => __DIR__ . '/yiidhtmlx/assets',
		'js' => array(
			'js/dhtmlxaccordion.js',
		),
		'css'=>array(
			'css/dhtmlxaccordion_dhx_web.css'
		),
		'depends' => array('yiidhtmlx'),
	)
);
