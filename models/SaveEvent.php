<?php
namespace app\models;

use Yii;
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

        $result = Yii::$app->db
            ->createCommand('insert into event (date, counterId, userId, data) values (now(), :p1, :p2, :p3)')
            ->bindValues([
                'p1' => $this->counterId,
                'p2' => $this->userId,
                'p3' => $this->data,
            ])
            ->execute();

        if (!$result) {
            $this->addError('all', 'Не удалось сохранить.');
        }

        return $this;
    }
}
