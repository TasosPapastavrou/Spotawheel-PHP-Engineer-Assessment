<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client; 
use App\Models\Payment; 
use Illuminate\Database\Eloquent\Builder;

class PaymentController extends Controller
{
    public function showListPayment(){
        return view('Payments.showPaymentList');
    }

    public function createPayment(){
        return view('Payments.addPayment');
    }

    public function viewPayment($id){
        $payment = Payment::where('id','=',$id)->with('client')->first();  
        return view('Payments.viewPaymentDetails', compact('payment'));
    }

    public function updatePayment($id){
        $payment = Payment::find($id);
        return view('Payments.updatePayment', compact('payment'));
    }

    public function deletePayment($id){

        $Payment = Payment::find($id);

        if($Payment){
            $Payment->delete();
            session()->flash('success',true);
            return redirect()->back();
        }else{
            session()->flash('error_delete',true);
            return redirect()->back();
        }

    }

    public function getDatatablePayments(Request $request){

        $input = $request->input(); 
        $draw = $input['draw'];
        $start = $input['start'];
        $rowPerPage = $input['length'];   
        $search = $input['search']['value'];        
        $column = $input['order'][0]['column'];
        $dir = $input['order'][0]['dir'];
        $columnKey = $input['columns'][$column]['data'];
        $startDate = $input['startDate'] ?? null;
        $endDate = $input['endDate'] ?? null;
        $sort = $input['sort'] ?? null;
        $tempDate = '';
        $date1_obj = new \DateTime($startDate);
        $date2_obj = new \DateTime($endDate);

        if(!empty($startDate) && !empty($endDate)){ 
            if ($date1_obj > $date2_obj) {
                $tempDate = $startDate;
                $startDate = $endDate;
                $endDate = $tempDate;
            }
        }

        // if(!empty($startDate) || !empty($startDate)){ 
        //     $dir = 'desc';
        //     $columnKey = 'created_at';
        // }

        if(!empty($sort)){ 
            $dir = $sort;
            $columnKey = 'created_at';
        }


        $payments = Payment::filterPayments($search,$startDate,$endDate)->with(['client' => function ($query) { $query->select('name', 'surname'); }]);
        $recordsTotal = $payments->count();
        $recordsFiltered = $recordsTotal;
        $payments = $payments->skip($start)->take($rowPerPage);     
 
        $payments = $payments->get()->map(function($payment) {

            $client = $payment->client();  
            $name = $client->pluck('name')->implode(', ');
            $surname = $client->pluck('surname')->implode(', ');
            
            return [
                'id' => $payment->id,  
                'name' => $name,
                'surname' => $surname,
                'amount' => $payment->amount,
                'created_at' => $payment->created_at,  
                ];           
        })->toArray();

        $collection = collect($payments);

        if($dir == "asc")
            $sortedCollection = $collection->sortBy($columnKey);
        else
            $sortedCollection = $collection->sortByDesc($columnKey);

        $sortedArray = $sortedCollection->values()->all();
        
        $response = array(                
            "draw"=> intval($draw),
            "recordsTotal"=>$recordsTotal,
            "recordsFiltered"=> $recordsFiltered,
            "data"=>$sortedArray
        );
        
        return  $response;  

    }


    public function storeNewPayment(Request $request){

        $data = $request->validate([ 
            "client"=>['required', 'numeric', 'gte:0'],
            "amount"=>"required",
        ]);
 

        $newRecord = new Payment();
        $newRecord->amount = $data['amount']; 
        $newRecord->client_id = $data['client'];
        $newRecord->created_at = now(); 
        $newRecord->updated_at = now(); 
        $newRecord->save();  
        
        session()->flash('success',true);
        return redirect()->back();
    }

    public function updatePaymentData(Request $request, $id){

        $data = $request->validate([ 
            "client"=>['required', 'numeric', 'gte:0'],
            "amount"=>"required",
        ]);

        $payment = Payment::find($id);
        $payment->client_id = $data['client'];
        $payment->amount = $data['amount'];   
        $payment->updated_at = now(); 
        $payment->save();


        session()->flash('success',true);
        return redirect()->back();

    }
}
