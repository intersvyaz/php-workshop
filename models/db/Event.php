<?php
namespace app\models\db;

/**
 * This is the model class for table "event".
 *
 * @property int $id
 * @property string $date Дата возникновения события.
 * @property int $counterId ID счетчика.
 * @property int $userId Идентификатор пользователя, породившего событие.
 * @property string $data Дополнительные данные.
 */
class Event extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'event';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['date', 'counterId', 'userId'], 'required'],
            [['counterId', 'userId'], 'integer'],
            [['data'], 'string'],
            [['date'], 'safe'],
        ];
    }
}
