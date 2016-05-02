<?php
namespace navatech\setting\models;

use navatech\setting\Module;
use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "setting".
 *
 * @property integer $id
 * @property integer $parent_id
 * @property string  $name
 * @property string  $code
 * @property string  $type
 * @property string  $store_range
 * @property string  $store_dir
 * @property string  $value
 * @property integer $sort_order
 */
class Setting extends ActiveRecord {

	/**
	 * @inheritdoc
	 */
	public static function tableName() {
		return '{{%setting}}';
	}

	/**
	 * @inheritdoc
	 */
	public function rules() {
		return [
			[
				[
					'parent_id',
					'sort_order',
				],
				'integer',
			],
			[
				[
					'code',
					'type',
				],
				'required',
			],
			[
				['value'],
				'string',
			],
			[
				'type',
				'string',
				'max' => 32,
			],
			[
				[
					'store_range',
					'store_dir',
					'code',
					'name',
				],
				'string',
				'max' => 255,
			],
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels() {
		return [
			'id'          => Module::t('common', 'ID'),
			'parent_id'   => Module::t('common', 'Parent ID'),
			'name'        => Module::t('common', 'Name'),
			'code'        => Module::t('common', 'Code'),
			'type'        => Module::t('common', 'Type'),
			'store_range' => Module::t('common', 'Store Range'),
			'store_dir'   => Module::t('common', 'Store Dir'),
			'value'       => Module::t('common', 'Value'),
			'sort_order'  => Module::t('common', 'Sort Order'),
		];
	}

	/**
	 * @return array
	 */
	public static function getItems() {
		/**@var $parentSettings self[] */
		$items          = [];
		$parentSettings = Setting::find()->where(['parent_id' => 0])->orderBy(['sort_order' => SORT_ASC])->all();
		foreach ($parentSettings as $parentSetting) {
			$items[] = [
				'label'   => $parentSetting->name,
				'content' => $parentSetting->getContent(),
			];
		}
		return $items;
	}

	public function getContent() {
		/**@var $settings self[] */
		$settings = $this->find()->where(['parent_id' => $this->id])->orderBy(['sort_order' => SORT_ASC])->all();
		foreach ($settings as $setting) {
			'<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Text Field </label>

										<div class="col-sm-9">
											<input type="text" id="form-field-1" placeholder="Username" class="col-xs-10 col-sm-5">
										</div>
									</div>';
		}
	}
}
