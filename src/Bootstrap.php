<?php
namespace navatech\setting;

use yii\base\BootstrapInterface;

/**
 * Blogs module bootstrap class.
 */
class Bootstrap implements BootstrapInterface {

	/**
	 * @inheritdoc
	 */
	public function bootstrap($app) {
		// Add module I18N category.
		if (!isset($app->i18n->translations['setting'])) {
			$app->i18n->translations['setting'] = [
				'class'            => 'yii\i18n\PhpMessageSource',
				'basePath'         => '@navatech/setting/messages',
				'forceTranslation' => true,
				'fileMap'          => [
					'navatech/setting' => 'setting.php',
				],
			];
		}
	}
}
