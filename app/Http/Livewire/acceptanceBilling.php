<?php

namespace App\Http\Livewire;

use App\Enums\TransactionStatus;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class acceptanceBilling extends Component
{
    public $amount = '';

    public $resource = '';
    public $student = '';
    public $date = '';
    public $transactionId = '';
    public $acadSession = '';
    public $useStatus = '';
    public $status = '';
    public $session = '';
    protected $results = '';

    public function mount()
    {

        $transcId = substr(md5(uniqid(rand(), true)), 0, 4);
        $tran = strtoupper($transcId);

        $this->student = Auth::user();
        $this->useStatus = '(Not Used)';
        $this->resource = config('Remita.AMNESTY_ACCEPTANCE_DESCRIPTION');
        $this->date = DATE("d/m/Y");
        $this->transactionId = strtoupper($transcId);
        $this->status = TransactionStatus::APPROVED;
        $this->amount = config('Remita.AMNESTY_ACCEPTANCE_FEES');
        $this->session = ' 2023/2024';
        $this->results = Transaction::where([
            'account_id' => $this->student->account_id,
            'resource' => config('Remita.AMNESTY_ACCEPTANCE_DESCRIPTION'),
            'use_status' => '(Not Used)'
        ])->first();
        // $results = Transaction::where()->

        if ($this->results) {

            $this->transactionId = $this->results->transactionId;
            $this->amount = $this->results->amount;
            $this->resource = $this->results->resource;

            //  return view('livewire.billing');
        } else {
            //Remita Stuff

            $this->transactionId = "WUFPACF" . $today = date("Ymd") . $tran;

            $transaction = Transaction::create([
                'account_id' => Auth::user()->account_id,
                'transactionId' => $this->transactionId,
                'resource' => $this->resource,
                'amount' => $this->amount,
                'use_status' => $this->useStatus,
                'date' => $this->date,

            ]);
            return view('livewire.acceptance');
            # code...
        }
    }
    public function processPayment()
    {

        //return redirect('/processPayment');
    }
    public function render()
    {
        return view('livewire.acceptance');
    }
}
