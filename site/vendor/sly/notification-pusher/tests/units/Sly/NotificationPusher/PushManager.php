<?php

namespace tests\units\Sly\NotificationPusher;

use mageekguy\atoum as Units;
use Sly\NotificationPusher\PushManager as TestedModel;

use Sly\NotificationPusher\Model\Message as BaseMessage;
use Sly\NotificationPusher\Model\Device as BaseDevice;
use Sly\NotificationPusher\Collection\DeviceCollection as BaseDeviceCollection;

/**
 * PushManager.
 *
 * @uses atoum\test
 * @author Cédric Dugat <cedric@dugat.me>
 */
class PushManager extends Units\Test
{
    const APNS_TOKEN_EXAMPLE = 'APA91bE16Qv12rxF-iD4LPJUxfaX6dFalUTlmfeS-VybUIDmMmPCJJEtymQ0cYrz8hGbbuuy-o0bCtskdlL8WHepLdLYz-PJzNJLwOsu4lOeSaVGSl-tBIp9s_TNfpiXrEZWWVBbwc6o';

    public function testConstruct()
    {
        $this->if($object = new TestedModel())
            ->string($object->getEnvironment())
                ->isEqualTo(TestedModel::ENVIRONMENT_DEV)

            ->when($object = new TestedModel(TestedModel::ENVIRONMENT_PROD))
            ->string($object->getEnvironment())
                ->isEqualTo(TestedModel::ENVIRONMENT_PROD)
        ;
    }

    public function testCollection()
    {
        $this->if($this->mockGenerator()->orphanize('__construct'))
            ->and($this->mockClass('\Sly\NotificationPusher\Model\Push', '\Mock'))
            ->and($push = new \Mock\Push())
            ->and($push->getMockController()->getMessage = new BaseMessage('Test'))
            ->and($push->getMockController()->getDevices = new BaseDeviceCollection(array(new BaseDevice(self::APNS_TOKEN_EXAMPLE))))

            ->and($object = new TestedModel())

            ->when($object->add($push))
            ->object($object)
                ->isInstanceOf('\Sly\NotificationPusher\Collection\PushCollection')
                ->hasSize(1)
        ;
    }

    public function testPush()
    {
        $this->if($this->mockGenerator()->orphanize('__construct'))
            ->and($this->mockClass('\Sly\NotificationPusher\Adapter\Apns', '\Mock'))
            ->and($apnsAdapter = new \Mock\Apns())
            ->and($apnsAdapter->getMockController()->push = true)

            ->and($this->mockGenerator()->orphanize('__construct'))
            ->and($this->mockClass('\Sly\NotificationPusher\Model\Push', '\Mock'))
            ->and($push = new \Mock\Push())
            ->and($push->getMockController()->getMessage = new BaseMessage('Test'))
            ->and($push->getMockController()->getDevices = new BaseDeviceCollection(array(new BaseDevice(self::APNS_TOKEN_EXAMPLE))))
            ->and($push->getMockController()->getAdapter = $apnsAdapter)

            ->and($object = new TestedModel())
            ->and($object->add($push))

            ->object($object->push())
                ->isInstanceOf('\Sly\NotificationPusher\Collection\PushCollection')
                ->hasSize(1)
        ;
    }
}
