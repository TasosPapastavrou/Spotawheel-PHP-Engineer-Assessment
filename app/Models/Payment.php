<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Client;
use Illuminate\Database\Eloquent\Builder;
use Carbon\Carbon;

class Payment extends Model
{
    use HasFactory;

    protected $table = "payments";

    protected $fillable = [ 
        'amount',
        'client_id'
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function scopeFilterPayments(Builder $query, $search, $startDate, $endDate)
    {
        $query->when($search ?? null, function ($query) use ($search) {
            $query->where(function ($query) use ($search) {
                $query->where('amount', 'LIKE', '%' . $search . '%')
                ->orWhereHas('client', function (Builder $query) use ($search) {
                    $query->where('name', 'LIKE', '%' . $search . '%')
                          ->orWhere('surname', 'LIKE', '%' . $search . '%');
                });
            });
        })->when($startDate?? null, function ($query) use ($startDate) {
            $startDate = Carbon::parse($startDate)->startOfDay();
            $query->where('created_at', '>=', $startDate);
        })->when($endDate ?? null, function ($query) use ($endDate) {
            $endDate = Carbon::parse($endDate)->endOfDay();
            $query->where('created_at', '<=', $endDate);
        });
    }
    


}
