<?php namespace App\CommonFunctions;

use Sly\NotificationPusher\PushManager,
    Sly\NotificationPusher\Adapter\Gcm as GcmAdapter,
    Sly\NotificationPusher\Adapter\Apns as ApnsAdapter,
    Sly\NotificationPusher\Collection\DeviceCollection,
    Sly\NotificationPusher\Model\Device,
    Sly\NotificationPusher\Model\Message,
    Sly\NotificationPusher\Model\Push;
use Illuminate\Http\Request;
use App\Message as Notification;
use App\PushNotification;
use App\Profile;
use App\Settings;
use DB;

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
     * PushNotification function.
     * @since 31/12/2015
     * @author ansa@cubettech.com
     * @return json
     */
    public static function pushNotification($request)
    {

        if ($request['user_id'] != $request['friend_id'] || $request['type'] == 'perfomance') {
            //To get sender info
            $senderName = Profile::where('user_id', $request['user_id'])
                ->pluck('first_name');

            $userSettings = Settings::where('user_id', '=', $request['friend_id'])
                ->where('key', '=', 'notification')
                ->first();

            if (!is_null($userSettings)) {
                $settingsArray = json_decode($userSettings->value, TRUE);
                if ($request['type'] == 'clap') {
                    if ($settingsArray['claps'] == 0) {
                        return false;
                    }
                    $notfyMessage = 'You have got a hooya from ' . $senderName . '.';
                } elseif ($request['type'] == 'comment') {
                    if ($settingsArray['comments'] == 0) {
                        return false;
                    }
                    $notfyMessage = $senderName . ' commented on your feed.';
                } elseif ($request['type'] == 'following') {
                    if ($settingsArray['follow'] == 0) {
                        return false;
                    }
                    $notfyMessage = $senderName . ' following you.';
                } elseif ($request['type'] == 'perfomance') {
                    if ($settingsArray['my_performance'] == 0) {
                        return false;
                    }
                    $notfyMessage = 'Congrats. Your level has been upgraded to ' . $request['to_level'] . '.';
                } elseif ($request['type'] == 'motivation') {
                    if ($settingsArray['motivation_knowledge'] == 0) {
                        return false;
                    }
                    $notfyMessage = $senderName . ' updated motivation message.';
                } elseif ($request['type'] == 'knowledge') {
                    if ($settingsArray['motivation_knowledge'] == 0) {
                        return false;
                    }
                    $notfyMessage = $senderName . ' added a new message.';
                } else {
                    $notfyMessage = 'You have a new message';
                }


                //To save notifications on pushnotification to Message table
                $notification = Notification::create([
                        'user_id' => $request['user_id'],
                        'friend_id' => $request['friend_id'],
                        'message_type' => $request['type'],
                        'type_id' => $request['type_id'],
                        'message' => $notfyMessage,
                        'read' => 0
                ]);

                $unreadNotificationCnt = Notification::where('message.friend_id', '=', $request['friend_id'])
                    ->where('message.read', 0)
                    ->count();

                $pushMessage = [
                    'id' => $notification->id,
                    'text' => $notfyMessage,
                    'feed_id' => $request['type_id'],
                    'type' => $request['type'],
                    'user_id' => $request['user_id'],
                    'friend_id' => $request['friend_id'],
                    'unread_notification_count' => $unreadNotificationCnt
                ];

                //Android Push
                $androidDevicetoken = PushNotification::where('user_id', $request['friend_id'])
                    ->where('type', 'android')
                    ->first();

                if (!is_null($androidDevicetoken)) {
                    $androidArray = array('deviceToken' => $androidDevicetoken->device_token, 'message' => json_encode($pushMessage));
                    // mail('ansa@cubettech.com', $androidDevicetoken->device_token, $androidDevicetoken->device_token);
                    PushNotificationFunction::androidNotification($androidArray);
                }

                //IOS Push
                $iosDevicetoken = PushNotification::where('user_id', $request['friend_id'])
                    ->where('type', 'ios')
                    ->orderBy('id', 'DESC')
                    ->first();

                if (!is_null($iosDevicetoken) && ($iosDevicetoken->device_token != '(null)')) {
                    $iosArray = array('deviceToken' => $iosDevicetoken->device_token, 'message' => json_encode($pushMessage), 'messageArray' => $pushMessage);
//                    PushNotificationFunction::iosNotification($iosArray);
                }
            }
        }
    }

    /**
     * PushNotification ANDROID.
     * @since 30/12/2015
     * @author ansa@cubettech.com
     * @return json
     */
    public static function androidNotification($details)
    {
        // First, instantiate the manager.
        // Example for production environment:
        //$pushManager = new PushManager(PushManager::ENVIRONMENT_PROD);
        // Development one by default (without argument).
        $pushManager = new PushManager(PushManager::ENVIRONMENT_DEV);

        // Then declare an adapter.
        $gcmAdapter = new GcmAdapter(array(
            'apiKey' => 'AIzaSyBxVm0RrhkZeRLdkZKo1-hyTHTn2RSRTkY',
        ));

        // Set the device(s) to push the notification to.
//        $devices = new DeviceCollection(array(
//            new Device('fqiQMABUMxI:APA91bE16Qv12rxF-iD4LPJUxfaX6dFalUTlmfeS-VybUIDmMmPCJJEtymQ0cYrz8hGbbuuy-o0bCtskdlL8WHepLdLYz-PJzNJLwOsu4lOeSaVGSl-tBIp9s_TNfpiXrEZWWVBbwc6o'),
//        ));
        $devices = new DeviceCollection(array(
            new Device($details['deviceToken']),
        ));

        // Then, create the push skel.
        $message = new Message($details['message']);

        // Finally, create and add the push to the manager, and push it!
        $push = new Push($gcmAdapter, $devices, $message);
        $pushManager->add($push);
        $devices = $pushManager->push(); // Returns a collection of notified devices
    }

    /**
     * PushNotification IOS.
     * @since 31/12/2015
     * @author ansa@cubettech.com
     * @return json
     */
    public static function iosNotification($details)
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
//        $devices = new DeviceCollection(array(
//            new Device('181547fd1b9d0ff4da8ef9008229a173c9a640b239385aae0de578489033fba0'),
//            // ...
//        ));
        $devices = new DeviceCollection(array(
            new Device($details['deviceToken'])
        ));

// Then, create the push skel.
        $message = new Message($details['messageArray']['text'], array(
            'badge' => 1,
            'sound' => 'default',
            'custom' => array(
                'custom data' => $details['messageArray'],
        )));

// Finally, create and add the push to the manager, and push it!
        $push = new Push($apnsAdapter, $devices, $message);
        $pushManager->add($push);
        $devices = $pushManager->push();
//        if ($details['messageArray']['friend_id'] == 17) {
//            echo '<pre>';
//            print_r($devices);
//            die;
//        }
    }
}
