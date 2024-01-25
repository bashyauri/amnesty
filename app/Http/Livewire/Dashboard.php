<?php

namespace App\Http\Livewire;

use App\Enums\TransactionStatus;
use App\Models\Application;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Dashboard extends Component
{
    public $results = '';
    public $student = '';
    public $hasPaid = false;
    public $offer = '';
    public $hasOffer = false;
    public $shortList = false;
    public $isShortListed = '';
    public $amount;
    public function mount()
    {
        $this->student = Auth::user();
        $this->results = Transaction::where('account_id', '=', $this->student->account_id)
            ->where('resource', '=', config('Remita.AMNESTY_DESCRIPTION'))
            ->where('use_status', '=', '(Not Used)')
            ->where('amount', '=', config('Remita.AMNESTY_FEES'))
            ->where(function ($query) {
                $query->where('status', TransactionStatus::ACTIVATED)
                    ->orWhere('status', TransactionStatus::APPROVED);
            })->first();
        $this->offer = Transaction::where('account_id', '=', $this->student->account_id)
            ->where('resource', '=', config('Remita.ACCEPTANCE_FEES'))
            ->where('use_status', '=', '(Not Used)')
            ->where(function ($query) {
                $query->where('status', TransactionStatus::ACTIVATED)
                    ->orWhere('status', TransactionStatus::APPROVED);
            })->first();
        $this->isShortListed = Application::where('account_id', '=', $this->student->account_id)
            ->where('remark', '=', 'shortlisted')
            ->first();

        // dd($this->student->account_id);
        //$this->results = $results->toArray();
        if (!empty($this->offer)) {

            $this->hasOffer = true;
            //$this->hasPaid = true;

        } elseif (!empty($this->isShortListed)) {
            $this->shortList = true;
        } elseif (!empty($this->results)) {
            $this->hasPaid = true;
        }
        // dd($this->hasPaid);

        // return view('livewire.dashboard',compact( $this->hasPaid));

    }
    public function generateInvoice()
    {
        return view('livewire.billing');
    }

    public function render()
    {

        return view('livewire.dashboard');
    }
}
