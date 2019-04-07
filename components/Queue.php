<?php
namespace app\components;

use RuntimeException;

/**
 * Очередь сообщения от IPC.
 */
class Queue
{
    /** @var resource */
    private $queue;

    /**
     * Channel constructor.
     */
    public function __construct()
    {
        $key = $this->getIpcKey();

        if (!$this->queue = msg_get_queue($key)) {
            throw new RuntimeException('Error create msg_queue.');
        }
    }

    /**
     * Количество сообщеий в очереди
     * @return mixed
     */
    public function count()
    {
        return msg_stat_queue($this->queue)['msg_qnum'];
    }

    /**
     * Получение сообщения из очереди.
     * @return mixed
     */
    public function pull()
    {
        if (!$this->count()) {
            return null;
        }

        $message = null;
        msg_receive($this->queue, 1, $typeGet, 1024 * 1024, $message);

        return $message;
    }

    /**
     * @param mixed $message
     * @return bool
     */
    public function push($message)
    {
        return msg_send($this->queue, 1, $message);
    }

    /**
     * Создание файла для IPC ключа и генерация ключа.
     * @return int
     */
    private function getIpcKey()
    {
        $filename = '/tmp/ipc_' . md5(__CLASS__);

        if (!file_exists($filename)) {
            if (touch($filename) === false) {
                throw new RuntimeException('Error create ipc file.');
            }
        }

        if (!$key = ftok($filename, 'a')) {
            throw new RuntimeException('Error get ftok.');
        }

        return $key;
    }
}
