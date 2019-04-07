<?php
namespace app\models;

use app\components\Queue;
use yii\base\Model;

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

        $queue = new Queue();

        $result = $queue->push([
            'date' => time(),
            'counterId' => $this->counterId,
            'userId' => $this->userId,
            'data' => $this->data,
        ]);

        if (!$result) {
            $this->addError('all', 'Не удалось сохранить.');
        }

        return $this;
    }
}
