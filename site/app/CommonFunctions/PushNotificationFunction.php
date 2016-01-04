<?php namespace App\CommonFunctions;

use Sly\NotificationPusher\PushManager,
    Sly\NotificationPusher\Adapter\Gcm as GcmAdapter,
    Sly\NotificationPusher\Adapter\Apns as ApnsAdapter,
    Sly\NotificationPusher\Collection\DeviceCollection,
    Sly\NotificationPusher\Model\Device,
    Sly\NotificationPusher\Model\Message,
    Sly\NotificationPusher\Model\Push;

/**
 * Push notification
 *
 * Long description for file (if any)...
 *
 * LICENSE: Some license information
 *
 * @category Ykings App
 * @package Notification
 * @copyright Copyright (c) 2007-2010 Cubet Technologies. (http://cubettechnologies.com)
 * @version  1
 * @date 30/12/2015
 * @author Cubet Technologies
 */
class PushNotificationFunction
{

    /**
     * PushNotification ANDROID.
     * @since 30/12/2015
     * @author ansa@cubettech.com
     * @return json
     */
    public static function androidNotification($request)
    {
        // First, instantiate the manager.
        // Example for production environment:
        //$pushManager = new PushManager(PushManager::ENVIRONMENT_PROD);
        // Development one by default (without argument).
        $pushManager = new PushManager(PushManager::ENVIRONMENT_DEV);
//print_r($pushManager);die;
        // Then declare an adapter.
        $gcmAdapter = new GcmAdapter(array(
            'apiKey' => 'AIzaSyBxVm0RrhkZeRLdkZKo1-hyTHTn2RSRTkY',
        ));

        // Set the device(s) to push the notification to.
        $devices = new DeviceCollection(array(
            new Device('fqiQMABUMxI:APA91bE16Qv12rxF-iD4LPJUxfaX6dFalUTlmfeS-VybUIDmMmPCJJEtymQ0cYrz8hGbbuuy-o0bCtskdlL8WHepLdLYz-PJzNJLwOsu4lOeSaVGSl-tBIp9s_TNfpiXrEZWWVBbwc6o'),
        ));

        // Then, create the push skel.
        $message = new Message('This is an example.');

        // Finally, create and add the push to the manager, and push it!
        $push = new Push($gcmAdapter, $devices, $message);
        $pushManager->add($push);
        $pushManager->push(); // Returns a collection of notified devices
    }

    /**
     * PushNotification IOS.
     * @since 31/12/2015
     * @author ansa@cubettech.com
     * @return json
     */
    public static function iosNotification($request)
    {
        // First, instantiate the manager.

        // Example for production environment:
        // $pushManager = new PushManager(PushManager::ENVIRONMENT_PROD);
        //
        // Development one by default (without argument).
        $pushManager = new PushManager(PushManager::ENVIRONMENT_DEV);

        // Then declare an adapter.
        $apnsAdapter = new ApnsAdapter(array(
            'certificate' => public_path('certificate/DevPush.pem'),
        ));

        // Set the device(s) to push the notification to.
        $devices = new DeviceCollection(array(
            new Device('181547fd1b9d0ff4da8ef9008229a173c9a640b239385aae0de578489033fba0'),
            // ...
        ));

// Then, create the push skel.
        $message = new Message('This is a basic example of push.');

// Finally, create and add the push to the manager, and push it!
        $push = new Push($apnsAdapter, $devices, $message);
        $pushManager->add($push);
        $pushManager->push();
    }
}
