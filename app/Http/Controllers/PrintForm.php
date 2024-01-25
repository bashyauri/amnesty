<?php

namespace App\Http\Controllers;

use App\Enums\TransactionStatus;


use App\Models\Application;
use App\Models\Institution;

use App\Models\Programme;
use App\Models\ExamDetail;
use App\Models\ExamGrade;

use App\Models\Transaction;



class PrintForm extends Controller
{
    public function printForm()
    {
        //Bio Section
        $user = auth()->user()->account_id;

        $applicationDetails = Application::where('account_id', '=', $user)->sole();

        $program = Programme::where('id', '=', auth()->user()->programme_id)->first();

        $transaction = Transaction::where('account_id', '=', $user)
            ->where('resource', '=', config('Remita.AMNESTY_DESCRIPTION'))
            ->where('use_status', '=', '(Not Used)')
            ->where(function ($query) {
                $query->where('status', TransactionStatus::ACTIVATED)
                    ->orWhere('status', TransactionStatus::APPROVED);
            })->first();


        $institutions = Institution::where('account_id', '=', $user)->get();
        $exams = ExamDetail::where('account_id', '=', $user)->get();
        $subjects = ExamGrade::where('account_id', '=', $user)->get();


        if ($applicationDetails) {
            $data = array(

                'fullName' => $applicationDetails->surname . ' ' . $applicationDetails->firstname . ' ' . $applicationDetails->m_name,
                'serialNo' => $applicationDetails->sN,
                'rrr' => $transaction->RRR,
                'transactionId' => $transaction->transactionId,
                'resource' => $transaction->resource,
                'amount' => $transaction->amount,
                'accountId' => $applicationDetails->account_id,


            );
            return view('print-form')->with($data);
        } else {
            return Redirect('profile');
        }
    }
    // public function printOffer()
    // {
    //     //Bio Section

    //     $user = auth()->user()->account_id;


    //     $applicationDetails = Application::where('account_id', '=', $user)->sole();
    //     $lga = Lga::where('id', '=', $applicationDetails->lgaid)->first();
    //     $state = State::where('id', '=', $applicationDetails->stateid)->first();
    //     $program = Programme::where('id', '=', auth()->user()->programme_id)->first();





    //     $institutions = Institution::where('account_id', '=', $user)->get();
    //     $exams = ExamDetail::where('account_id', '=', $user)->get();
    //     $subjects = ExamGrade::where('account_id', '=', $user)->get();
    //     $transaction = Transaction::where('account_id', '=', $user)
    //         ->where('resource', '=', config('Remita.AMNESTY_DESCRIPTION'))
    //         ->where('use_status', '=', '(Not Used)')
    //         ->where(function ($query) {
    //             $query->where('status', TransactionStatus::ACTIVATED)
    //                 ->orWhere('status', TransactionStatus::APPROVED);
    //         })->first();


    //         $data = array(
    //             'programme' => ucwords($program->name),
    //             'fullName' => $applicationDetails->surname . ' ' . $applicationDetails->firstname . ' ' . $applicationDetails->m_name,
    //             'serialNo' => $applicationDetails->sN,
    //             'rrr' => $transaction->RRR,
    //             'accountId' => $applicationDetails->account_id,
    //             'passport' => $applicationDetails->filename,
    //             'dob' => $applicationDetails->d_birth,
    //             'gender' => ucwords($applicationDetails->gender),
    //             'homeTown' => $applicationDetails->home_town,
    //             'lga' => $lga->name,
    //             'state' => $state->name,
    //             'nationality' => $applicationDetails->nationality,
    //             'maritalStatus' => ucwords($applicationDetails->marital_status),
    //             'phoneNumber' => ucwords($applicationDetails->p_number),
    //             'homeAddress' => ucwords($applicationDetails->home_address),
    //             'correspondentAddress' => ucwords($applicationDetails->cor_address),
    //             'sponsor' => ucwords($applicationDetails->sponsor),
    //             'nextkinName' => ucwords($applicationDetails->nextkin_name),
    //             'nextkinGsm' => ucwords($applicationDetails->nextkin_gsm),
    //             'nextkinAddress' => ucwords($applicationDetails->nextkin_address),
    //             'institutions' => $institutions,
    //             'count' => 0,
    //             'exams' => $exams,
    //             'subjects' => $subjects,
    //             'subjectCount' => 0,

    //             'scheduleFees' =>  SchoolFees::department($departments->id),


    //         );


    //         return view('offer')->with($data);
    //     }

    //     return redirect('dashboard')->with('status', 'It appears you made some corrections and forget to submit. Please submit your form and try again.');
    // }
    // //

}