<?php

use yii\db\Migration;

/**
 * Class m190402_073032_init
 */
class m190402_073032_init extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('event', [
            'id' => $this->primaryKey(),
            'date' => $this->dateTime()->notNull()->comment('Дата возникновения события.'),
            'counterId' => $this->integer()->notNull()->comment('ID счетчика.'),
            'userId' => $this->integer()->notNull()->comment('Идентификатор пользователя, породившего событие.'),
            'data' => $this->text()->comment('Дополнительные данные.'),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('event');
    }
}
