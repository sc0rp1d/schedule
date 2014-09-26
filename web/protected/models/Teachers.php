<?php

/**
 * @property integer $id
 * @property string $firstname
 * @property string $lastname
 * @property string $middlename
 * @property integer $owner_id
 *
 * @property Users $owner
 */
class Teachers extends CActiveRecord
{
    /**
     * @return string
     */
    public function tableName()
    {
        return '{{teachers}}';
    }

    /**
     * @return array
     */
    public function rules()
    {
        return [
            ['firstname, lastname, middlename', 'required'],
            ['owner_id', 'numerical', 'integerOnly' => true],
            ['firstname, lastname, middlename', 'length', 'max' => 255],
            ['id, firstname, lastname, middlename, owner_id', 'safe', 'on' => 'search'],
        ];
    }

    /**
     * @return array
     */
    public function relations()
    {
        return [
            'owner' => [self::BELONGS_TO, 'Users', 'owner_id'],
        ];
    }

    /**
     * @return array
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'lastname' => 'Фамилия',
            'firstname' => 'Имя',
            'middlename' => 'Отчество',
            'owner_id' => 'Создал',
        ];
    }

    /**
     * @return CActiveDataProvider
     */
    public function search()
    {
        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('firstname', $this->firstname, true);
        $criteria->compare('lastname', $this->lastname, true);
        $criteria->compare('middlename', $this->middlename, true);
        $criteria->compare('owner_id', $this->owner_id);

        return new CActiveDataProvider($this, [
            'criteria' => $criteria,
        ]);
    }

    /**
     * @param string $className
     * @return Teachers
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }
}
