<?php

namespace App\Services\Admin;

use App\Enums\ApplicationStatus;
use App\Models\User;
use App\Models\Programme;
use App\Models\Application;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Notifications\ShortlistedCandidateNotification;


/**
 * Class ApplicantService.
 */
class ApplicantService
{
    public function recommend(array $data)
    {
        return  Application::where(['account_id' => $data['accountId']])->update(
            [
                'department_id' => Auth::guard('admin')->user()->department_id,
                'remark' => ApplicationStatus::RECOMMENDED,
                'comment' => $data['comments'] ?? null,
            ]
        );
    }
    public function dropRecommendedApplicant($accountId)
    {
        return Application::where('account_id', $accountId)
            ->update([
                'remark' => null,
                'recommendation' => null,
                'comment' => null,
            ]);
    }
    public function shortlist($accountId)
    {
        $user = User::where('account_id', $accountId)->first();

        return
            DB::transaction(function () use ($accountId, $user) {
                Application::where('account_id', $accountId)
                    ->update([

                        'remark' => ApplicationStatus::SHORTLISTED,
                    ]);
                $this->sendMessage($user);
                $user->notify(new ShortlistedCandidateNotification());
            });
    }
    public function sendMessage($user)
    {
        $fullName = $user->surname . ' ' . $user->firstname . ' ' . $user->m_name;
        $programme_name = $user->application->program->name;

        // Initialize variables ( set your variables here )

        $username = config('services.nigeriabulksms.username');

        $password = config('services.nigeriabulksms.password');

        $sender = config('services.nigeriabulksms.sender');

        $message =  $fullName . '. You have  been offered provisional  admission to study  ' . $programme_name . ' ' . $user->application->department->name . ' at WUFEDPOLY. Kindly login to your account to generate remita for payment of Acceptance Fees and print your offer. Thanks';

        // Separate multiple numbers by comma

        $mobiles = '09029991710';

        // Set your domain's API URL

        $api_url = 'http://portal.nigeriabulksms.com/api/';

        //Create the message data

        $data = array('username' => $username, 'password' => $password, 'sender' => $sender, 'message' => $message, 'mobiles' => $mobiles);

        //URL encode the message data

        $data = http_build_query($data);

        //Send the message

        $ch = curl_init(); // Initialize a cURL connection

        curl_setopt($ch, CURLOPT_URL, $api_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

        $result = curl_exec($ch);

        $result = json_decode($result);

        if (isset($result->status) && strtoupper($result->status) == 'OK') {
            // Message sent successfully, do anything here

            echo 'Message sent at N' . $result->price;
        } else if (isset($result->error)) {
            // Message failed, check reason.

            echo 'Message failed - error: ' . $result->error;
        } else {
            // Could not determine the message response.

            echo 'Unable to process request';
        }
    }
}