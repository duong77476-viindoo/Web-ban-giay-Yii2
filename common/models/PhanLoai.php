<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%phan_loai}}".
 *
 * @property int $id
 * @property string $name Tên nhóm sản phẩm
 * @property string|null $code
 *
 * @property PhanLoaiSanPham[] $phanLoaiSanPhams
 */
class PhanLoai extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%phan_loai}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name', 'code'], 'string', 'max' => 60],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Tên nhóm sản phẩm',
            'code' => 'Code',
        ];
    }

    /**
     * Gets query for [[PhanLoaiSanPhams]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPhanLoaiSanPhams()
    {
        return $this->hasMany(PhanLoaiSanPham::className(), ['phan_loai_id' => 'id']);
    }

    public function beforeSave($insert)
    {
        //convert Name sang code
        $this->code =  API_H17::createCode($this->name);
        return parent::beforeSave($insert); // TODO: Change the autogenerated stub
    }

}