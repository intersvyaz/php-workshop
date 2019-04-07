<?php
namespace app\commands;

use app\components\Queue;
use Yii;
use yii\console\Controller;

class WorkerController extends Controller
{
    public function actionRun()
    {
        $queue = new Queue();

        while (true) {
            $data = [];

            for ($i = 0; $i <= 100; $i++) {
                if (!$pull = $queue->pull()) {
                    break;
                }

                $data[] = $pull;
            }

            $cmd = Yii::$app->db
                ->createCommand(
                    'insert into event (date, counterId, userId, data) values (from_unixtime(:p1), :p2, :p3, :p4)'
                );

            foreach ($data as $row) {
                $cmd->bindValues([
                    ':p1' => $row['date'],
                    ':p2' => $row['counterId'],
                    ':p3' => $row['userId'],
                    ':p4' => $row['data'],
                ])
                    ->execute();
            }

            if (count($data) < 50) {
                sleep(1);
            }
        }
    }
}
