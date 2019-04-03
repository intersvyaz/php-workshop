<?php
namespace app\models;

use app\models\db\Event;
use yii\base\Model;
use yii\db\Expression;

class SaveEvent extends Model
{
    /** @var integer */
    public $counterId;
    /** @var integer */
    public $userId;
    /** @var string */
    public $data;

    /**
     * @inheritDoc
     */
    public function rules()
    {
        return [
            [['counterId', 'userId'], 'required'],
            [['counterId', 'userId'], 'integer'],
            [['data'], 'string', 'max' => 10000],
        ];
    }

    /**
     * Сохранение данных в БД.
     * @return $this
     */
    public function save()
    {
        if (!$this->validate()) {
            return $this;
        }

        $model = new Event();

        $model->date = new Expression('NOW()');
        $model->counterId = $this->counterId;
        $model->userId = $this->userId;
        $model->data = $this->data;

        if (!$model->save()) {
            $this->addErrors($model->getErrors());
        }

        return $this;
    }
}
