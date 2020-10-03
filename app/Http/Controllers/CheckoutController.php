<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TravelPackage;
use Carbon\Carbon;
use App\Transaction;
use App\TransactionDetail;
use SweetAlert;
use Illuminate\Support\Facades\Auth;
class CheckoutController extends Controller
{
    public function index(Request $request, $id)
    {
    	$item = Transaction::with(['details','travel_package','user'])->findOrFail($id);
    	return view('pages.checkout', compact('item'));
    }

    public function process(Request $request, $id)
    {
    	$travel_package = TravelPackage::findOrFail($id);

    	$transaction = Transaction::create([
    		'travel_packages_id' => $id,
    		'users_id'=> Auth::user()->id,
    		'addtional_visa'=> 0,
    		'transactions_total'=> $travel_package->price,
    		'transactions_status'=> 'IN_CART'
    	]);

    	TransactionDetail::create([
    		'transactions_id' => $transaction->id,
    		'username'=> Auth::user()->username,
    		'nationality'=> '1D',
    		'is_visa'=> false,
    		'doe_passport'=> Carbon::now()->addYears(5)
    	]);
        alert()->success('Transaction Process.', 'Done!');
    	return redirect()->route('checkout', $transaction->id);
    }

    public function remove(Request $request, $detail_id)
    {

    	$item = TransactionDetail::findOrFail($detail_id);
    	$transaction = Transaction::with(['details','travel_package'])->findOrFail($item->transactions_id);

    	if ($item->is_visa) {
    		$transaction->transactions_total -= 190;
    		$transaction->addtional_visa -= 190;
    	}

    	$transaction->transactions_total -= $transaction->travel_package->price;
    	$transaction->save();

    	$item->delete();

    	return redirect()->route('checkout', $item->transactions_id);

    }

    public function create(Request $request, $id)
    {
    	$this->validate($request, [
    		'username'=> 'required|string|exists:users,username',
    		'is_visa'=>'required|boolean',
    		'doe_passport'=> 'required'
    	]);

    	$data = $request->all();
    	$data['transactions_id'] = $id;
    	TransactionDetail::create($data);

    	$transaction = Transaction::with(['travel_package'])->find($id);

    	if ($request->is_visa) {
    		$transaction->transactions_total += 190;
    		$transaction->addtional_visa += 190;
    	}

    	$transaction->transactions_total += $transaction->travel_package->price;
    	$transaction->save();

        alert()->success('Successfully', 'Done!')->autoclose(3000);
    	return redirect()->route('checkout', $id);
    }

    public function success(Request $request, $id)
    {
    	$transaction = Transaction::findOrFail($id);
    	$transaction->transactions_status = 'PENDING';
    	$transaction->save();
        // alert()->success('Transaction Sucess.', 'Done!')->autoclose(3000);
    	return view('pages.success');
    }
}
