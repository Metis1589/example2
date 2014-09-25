<?php

/**
 * This is the model class for table "todo".
 *
 * The followings are the available columns in table 'todo':
 * @property integer $id
 * @property string $description
 * @property string $category
 * @property integer $is_complted
 * @property integer $priority
 * @property string $date_create
 * @property string $date_update
 */
class Todo extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'todo';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('description, category, is_complted, priority', 'required'),
			array('is_complted, priority', 'numerical', 'integerOnly'=>true),
			array('category', 'in', 'range'=>array_keys(Lookup::items('task_category'))),
                        array('is_complted', 'boolean'),
                        array('description', 'filter', 'filter'=>array(new TagFilter(), "full")),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, description, category, is_complted, priority, date_create, date_update', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'description' => Yii::t('main','Description'),
			'category' => Yii::t('main','Category'),
			'is_complted' => Yii::t('main','Is Complited'),
			'priority' => Yii::t('main','Priority'),
			'date_create' => Yii::t('main','Date Create'),
			'date_update' => Yii::t('main','Date Update'),
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('category',$this->category,true);
		$criteria->compare('is_complted',$this->is_complted);
		$criteria->compare('priority',$this->priority);
		$criteria->compare('date_create',$this->date_create,true);
		$criteria->compare('date_update',$this->date_update,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
                        'sort'=>array(
			    'defaultOrder'=>'priority DESC',
			 )
                    )
                );
	}
        
        /**
	 * This is invoked before the record is saved.
	 * @return boolean whether the record should be saved.
	 */
	protected function beforeSave()
	{
		if(parent::beforeSave())
		{
			if($this->isNewRecord)
			{
				$this->date_create=date('Y:m:d H:i:s');
			}
			$this->date_update=date('Y:m:d H:i:s');
			return true;
		}
		else
			return false;
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Todo the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
