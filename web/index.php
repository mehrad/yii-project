<?php

function dd() {
	$args = func_get_args();
	foreach ($args as $k => $arg) {
		echo '<fieldset class="debug">
		<legend>'.($k+1).'/</legend>';
		  \yii\helpers\VarDumper::dump($arg, 10, true);
		echo '</fieldset>';

	}
	die;
}

//use yii/helpers/VarDumper
// comment out the following two lines when deployed to production
defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'dev');

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../vendor/yiisoft/yii2/Yii.php';

$config = require __DIR__ . '/../config/web.php';


(new yii\web\Application($config))->run();

