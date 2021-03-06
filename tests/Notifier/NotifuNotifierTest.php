<?php

/*
 * This file is part of the JoliNotif project.
 *
 * (c) Loïck Piera <pyrech@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Joli\JoliNotif\tests\Notifier;

use Joli\JoliNotif\Notifier;
use Joli\JoliNotif\Notifier\NotifuNotifier;

class NotifuNotifierTest extends NotifierTestCase
{
    const BINARY = 'notifu';

    use CliBasedNotifierTestTrait;
    use BinaryProviderTestTrait;

    protected function getNotifier()
    {
        return new NotifuNotifier();
    }

    public function testGetBinary()
    {
        $notifier = $this->getNotifier();

        $this->assertSame(self::BINARY, $notifier->getBinary());
    }

    public function testGetPriority()
    {
        $notifier = $this->getNotifier();

        $this->assertSame(Notifier::PRIORITY_LOW, $notifier->getPriority());
    }

    /**
     * {@inheritdoc}
     */
    protected function getExpectedCommandLineForNotification()
    {
        return <<<CLI
'notifu' '/m' 'I'\''m the notification body'
CLI;
    }

    /**
     * {@inheritdoc}
     */
    protected function getExpectedCommandLineForNotificationWithATitle()
    {
        return <<<CLI
'notifu' '/m' 'I'\''m the notification body' '/p' 'I'\\''m the notification title'
CLI;
    }

    /**
     * {@inheritdoc}
     */
    protected function getExpectedCommandLineForNotificationWithAnIcon()
    {
        return <<<CLI
'notifu' '/m' 'I'\''m the notification body' '/i' '/home/toto/Images/my-icon.png'
CLI;
    }

    /**
     * {@inheritdoc}
     */
    protected function getExpectedCommandLineForNotificationWithAllOptions()
    {
        return <<<CLI
'notifu' '/m' 'I'\''m the notification body' '/p' 'I'\''m the notification title' '/i' '/home/toto/Images/my-icon.png'
CLI;
    }
}
