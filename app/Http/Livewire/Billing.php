<?php

namespace App\Http\Livewire;

use App\Enums\TransactionStatus;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Transaction;

class Billing extends Component
{
    public $amount = '';

    public $resource = '';
    public $student = '';
    public $date = '';
    public $session = '';
    public $transactionId = '';
    public $acadSession = '';
    public $useStatus = '';
    public $status = '';
    protected $results = '';

    public function mount()
    {
        $transcId = substr(md5(uniqid(rand(), true)), 0, 4);
        $tran = strtoupper($transcId);

        $this->student =  Auth::user();
        $this->useStatus = '(Not Used)';
        $this->resource = config('Remita.AMNESTY_DESCRIPTION');
        $this->date = DATE("d/m/Y");
        $this->transactionId = strtoupper($transcId);
        $this->status = TransactionStatus::APPROVED;
        $this->amount = config('Remita.AMNESTY_FEES');
        $this->session = ' 2023/2024';

        $this->results = Transaction::where([
            'account_id' => $this->student->account_id,
            'resource' => config('Remita.AMNESTY_DESCRIPTION'),
            'use_status' => '(Not Used)'
        ])->first();



        if ($this->results) {
            $this->transactionId = $this->results->transactionId;
            $this->amount = $this->results->amount;

            $this->resource = $this->results->resource;




            //  return view('livewire.billing');
        } else {
            //Remita Stuff


            $this->transactionId = "WUFPAMNESTY" . $today = date("Ymd") . $tran;



            $transaction = Transaction::create([
                'account_id' => Auth::user()->account_id,
                'transactionId' =>  $this->transactionId,
                'resource' => $this->resource,
                'amount' => $this->amount,
                'use_status' => $this->useStatus,
                'date' => $this->date

            ]);
            return view('livewire.billing');
            # code...
        }
    }
    public function processPayment()
    {

        return redirect('/processPayment');
    }
    public function render()
    {
        return view('livewire.billing');
    }
}
