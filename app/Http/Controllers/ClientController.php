<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client; 
use Carbon\Carbon;

class ClientController extends Controller
{
    public function showListClient(Request $request){

        return view('Clients.clientsList');
    }

    public function createClient(Request $request){ 
        return view('Clients.addClient');
    }

    public function viewClient($id){
        $client = Client::find($id);
        return view('Clients.viewClientDetails', compact('client'));
    }

    public function updateClient($id){
        $client = Client::find($id);
        return view('Clients.updateClient', compact('client'));
    }

    public function getClientDataTables(Request $request){

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

        $clients = Client::filterClients($search,$startDate,$endDate)->with('lastPayment')->orderBy($columnKey, $dir);
        $recordsTotal = $clients->count();
        $recordsFiltered = $recordsTotal;
        $clients = $clients->skip($start)->take($rowPerPage);

        $clients = $clients->get()->map(function($client) use ($startDate, $endDate) {
            

            $lastPayment = $client->lastPayment()
            ->when($startDate ?? null, function ($query) use ($startDate) {
                $startDate = Carbon::parse($startDate)->startOfDay();
                $query->where('created_at', '>=', $startDate);
            })
            ->when($endDate ?? null, function ($query) use ($endDate) {
                $endDate = Carbon::parse($endDate)->endOfDay();
                $query->where('created_at', '<=', $endDate);
            })
            ->latest()
            ->first();

            return [
                'id' => $client->id,  
                'name' => $client->name,
                'surname' => $client->surname,
                'lastPayment' => $lastPayment ? $lastPayment->amount : 'no payment',
                'created_at' => $client->created_at,  
                ];           
        })->toArray();

        
        $response = array(                
            "draw"=> intval($draw),
            "recordsTotal"=>$recordsTotal,
            "recordsFiltered"=> $recordsFiltered,
            "data"=>$clients
            );
        
        return  $response;  
    }

    public function storeNewClient(Request $request){

        $data = $request->validate([
            "name"=>"required",
            "surname"=>"required",
        ]);

        $newRecord = new Client();
        $newRecord->name = $data['name'];
        $newRecord->surname = $data['surname'];  
        $newRecord->created_at = now(); 
        $newRecord->updated_at = now(); 
        $newRecord->save();


        session()->flash('success',true);
        return redirect()->back();

    }

    public function deleteClientData($id){
         
        $client = Client::find($id);

        if($client){
            $client->delete();
            session()->flash('success',true);
            return redirect()->back();
        }else{
            session()->flash('error_delete',true);
            return redirect()->back();
        }
         
    }


    public function updateClientData(Request $request, $id){ 

        $data = $request->validate([
            "name"=>"required",
            "surname"=>"required",
        ]);

        $client = Client::find($id);
        $client->name = $data['name'];
        $client->surname = $data['surname'];   
        $client->updated_at = now(); 
        $client->save();


        session()->flash('success',true);
        return redirect()->back();
    }


    public function getAllClients(Request $request){

        $selectedTypes = $request->get('type');

        $clients = Client::query()->get(['id', 'name', 'surname'])
                ->map(function($client) use ($selectedTypes){
                    $selected = (($selectedTypes == $client->id) && !is_null($selectedTypes) ) ? true : false;
                        return [
                        'id' => $client->id,
                        'text' => $client->name.' '.$client->surname,
                        "selected" => $selected
                        ];
                    })
                    ->toArray();

        if($selectedTypes)
            $selected = false;
        else
            $selected = true;

        return ['data'=>$clients,'selected'=>$selected];

    }

}
