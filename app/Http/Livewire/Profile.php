<?php

namespace App\Http\Livewire;

use Exception;
use App\Models\Program;
use Livewire\Component;
use App\Models\Application;
use App\Models\Transaction;
use Livewire\WithFileUploads;
use App\Enums\TransactionStatus;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Log;




class Profile extends Component
{
    use withFileUploads;
    public  $user;
    public $showSuccesNotification  = false;
    public $selectedProgram = null;
    public $availableDepartments = [];
    public $selectedCourse;
    public $profile;
    public $selectedDepartment = NULL;
    public $year_failed_exam = '';
    public $cgpa = '';
    public $matric_no = '';

    public $RRR;
    public $transactionId;
    public $gender;
    public $no_of_course = '';
    public $transaction;
    public $fullName;
    public $applications = null;
    public $showDemoNotification = false;
    public $showFailureNotification = false;




    public function mount()
    {



        // $this->availableDepartments = Department::all(); // Fetch all departments initially

        $this->user = auth()->user()->account_id;
        $this->fullName = auth()->user()->surname . ' ' . auth()->user()->firstname . ' ' . auth()->user()->m_name;
        $this->applications = Application::where(["account_id" => $this->user])->first();

        $this->matric_no = $this->applications?->matric_no;
        $this->gender = $this->applications?->gender;
        $this->selectedProgram = $this->applications?->program_id;
        $this->selectedDepartment = $this->applications?->department_id;
        $this->year_failed_exam = $this->applications?->year_failed_exam;
        $this->no_of_course = $this->applications?->no_of_course;
        $this->cgpa = $this->applications?->cgpa;




        $this->transaction = Transaction::where('account_id', '=', $this->user)
            ->where('resource', '=', config('Remita.AMNESTY_DESCRIPTION'))
            ->where('use_status', '=', '(Not Used)')
            ->where(function ($query) {
                $query->where('status', TransactionStatus::ACTIVATED)
                    ->orWhere('status', TransactionStatus::APPROVED);
            })->sole();

        // return dd($this->transaction->RRR);



    }



    public function save()
    {
        if (env('IS_DEMO')) {
            $this->showDemoNotification = true;
        } else {
            $this->validate();
            $this->user->save();
            $this->showSuccesNotification = true;
        }
    }


    public function addBio()
    {


        $rules = [
            'gender' => 'required',
            'matric_no' => ['required', Rule::unique('application_form', 'matric_no')->ignore(auth()->user()->account_id, 'account_id')],
            'selectedProgram' => 'required',
            'selectedDepartment' => 'required',
            'year_failed_exam' => 'required',
            'cgpa' => 'required',
            'no_of_course' => 'required',


        ];


        $validatedData = $this->validate($rules);

        try {
            $applicationData = [
                'rrr_code' => $this->transaction->RRR,
                'transactionId' => $this->transaction->transactionId,
                'account_id' => $this->transaction->account_id,
                'surname' => auth()->user()->surname,
                'firstname' => auth()->user()->firstname,
                'm_name' => auth()->user()->m_name,
                'gender' => $this->gender,
                'matric_no' => $this->matric_no,
                'program_id' => $this->selectedProgram,
                'department_id' => $this->selectedProgram,
                'year_failed_exam' => $this->year_failed_exam,
                'cgpa' => $this->cgpa,
                'no_of_course' => $this->no_of_course,



            ];
            Application::updateOrCreate(
                ['account_id' => auth()->user()->account_id],
                $applicationData
            );
            $this->deleteMsg = '';
            $this->showSuccesNotification = false;
            $this->showSuccesNotification = true;
            $this->showSuccesNotification =  $this->user ? $this->successMsg = 'Data Updated Successfully.' : $this->successMsg = 'Data Added Successfully.';
            redirect('print');
        } catch (Exception $e) {
            Log::info($e->getMessage());
        }
    }


    public function render()
    {

        return view('livewire.profile', ['programs' => Program::all()]);
    }

    public function updatedSelectedProgram($programId)
    {
        if ($programId) {
            $this->availableDepartments = Program::find($programId)->departments;
        } else {
            $this->availableDepartments = []; // Reset to all departments
        }
    }
}
