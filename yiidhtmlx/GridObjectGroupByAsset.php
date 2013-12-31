<?php

namespace yiidhtmlx;

use yii\web\AssetBundle;

/**
 * @link http://www.frenzel.net/
 * @author Philipp Frenzel <philipp@frenzel.net> 
 */

class GridObjectGroupByAsset extends AssetBundle
{
    public $sourcePath = '@yiidhtmlx/assets';
    public $css = array(
        
    );
    public $js = array(
        'dhtmlxGrid/ext/dhtmlxgrid_group.js',        
    );
    public $depends = array(
        '\yiidhtmlx\GridObjectAsset',
    );
}
