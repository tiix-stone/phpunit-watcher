<?php

namespace Spatie\PhpUnitWatcher;

use Joli\JoliNotif\NotifierFactory;
use Joli\JoliNotif\Notification as JoliNotification;

class Notification
{
    /** @var \Joli\JoliNotif\Notification */
    protected $joliNotification;

    public static function create()
    {
        $joliNotification = (new JoliNotification)
            ->setTitle('PHPUnit Watcher')
            ->setIcon(__DIR__.'/../images/notificationIcon.png');

        return new static($joliNotification);
    }

    protected function __construct(JoliNotification $joliNotification)
    {
        $this->joliNotification = $joliNotification;
    }

    public function passingTests()
    {
        $this->joliNotification
            ->setBody('✅ Tests passed!')
            ->setIcon(__DIR__ . '/../images/success.png')
        ;

        $this->send();
    }

    public function failingTests()
    {
        $this->joliNotification
            ->setBody('❌ Tests failed!')
            ->setIcon(__DIR__ . '/../images/fail.png')
        ;

        $this->send();
    }

    protected function send()
    {
        return NotifierFactory::create()->send($this->joliNotification);
    }
}
