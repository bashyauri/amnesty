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


        $transaction = Transaction::where('account_id', '=', $user)
            ->where('resource', '=', config('Remita.AMNESTY_DESCRIPTION'))
            ->where('use_status', '=', '(Not Used)')
            ->where(function ($query) {
                $query->where('status', TransactionStatus::ACTIVATED)
                    ->orWhere('status', TransactionStatus::APPROVED);
            })->first();




        if ($applicationDetails) {
            $data = array(

                'fullName' => $applicationDetails->surname . ' ' . $applicationDetails->firstname . ' ' . $applicationDetails->m_name,
                'serialNo' => $applicationDetails->sN,
                'rrr' => $transaction->RRR,
                'matric_no' => $applicationDetails->matric_no,
                'transactionId' => $transaction->transactionId,
                'resource' => $transaction->resource,
                'amount' => $transaction->amount,
                'accountId' => $applicationDetails->account_id,
                'departmentName' => $applicationDetails->department->name,
                'acad_session' => $applicationDetails->year_failed_exam,
                'programName' => $applicationDetails->program->name,
                'gender' => $applicationDetails->gender,
                'coursesFailed' => $applicationDetails->no_of_course,
                'yearFailed' => $applicationDetails->year_failed_exam,
                'matricNo' => $applicationDetails->matric_no,
                'cgpa' => $applicationDetails->cgpa,

                'date' => $transaction->date,


            );
            return view('print-form')->with($data);
        } else {
            return Redirect('profile');
        }
    }
    public function printOffer()
    {
        //Bio Section

        $user = auth()->user()->account_id;


        $applicationDetails = Application::where('account_id', '=', $user)->sole();

        $transaction = Transaction::where('account_id', '=', $user)
            ->where('resource', '=', config('Remita.AMNESTY_ACCEPTANCE_DESCRIPTION'))
            ->where('use_status', '=', '(Not Used)')
            ->where(function ($query) {
                $query->where('status', TransactionStatus::ACTIVATED)
                    ->orWhere('status', TransactionStatus::APPROVED);
            })->first();


        $data = array(
            'fullName' => $applicationDetails->surname . ' ' . $applicationDetails->firstname . ' ' . $applicationDetails->m_name,
            'serialNo' => $applicationDetails->sN,
            'rrr' => $transaction->RRR,
            'transactionId' => $transaction->transactionId,
            'resource' => $transaction->resource,
            'amount' => $transaction->amount,
            'accountId' => $applicationDetails->account_id,
        );


        return view('offer')->with($data);
    }
    // //

}