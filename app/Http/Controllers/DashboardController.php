<?php

namespace App\Http\Controllers;

use App\Models\Pembeli;
use App\Repositories\CashTransactionRepository;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __construct(
        // private CashTransactionRepository $cashTransactionRepository,
    ) {
    }

    /**
     * Handle the incoming request.
     *
     * @return \Illuminate\View\View
     */
    public function __invoke(): View
    {
        $amountThisMonth = indonesian_currency($this->cashTransactionRepository->sumAmountBy('month', month: date('m')));

        $latestCashTransactions = $this->cashTransactionRepository
            ->cashTransactionLatest(['id', 'student_id', 'user_id', 'bill', 'amount', 'date'], 5);

        return view('dashboard.index', [
            'pembeliCount' => Pembeli::count(),
        ]);
    }
}
