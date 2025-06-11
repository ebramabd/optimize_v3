<?php

namespace App\Models;

use App\Enums\SubscriptionStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CompanySubscription extends Model
{
    use HasFactory;
    protected $fillable = ['company_id', 'subscription_id', 'start_date', 'end_date', 'status', 'image'];

    public static function get_subscriptions_companies($id = null)
    {
        $query = DB::table('company_subscriptions')
            ->join('companies', 'company_subscriptions.company_id', '=', 'companies.id')
            ->join('subscriptions', 'company_subscriptions.subscription_id', '=', 'subscriptions.id')
            ->where('company_subscriptions.status', SubscriptionStatus::Pending)
            ->select([
                'company_subscriptions.id',
                'company_subscriptions.image',
                'company_subscriptions.status',
                'company_subscriptions.start_date',
                'company_subscriptions.end_date',
                'company_subscriptions.company_id',
                'company_subscriptions.created_at',
                'companies.company_name',
                'subscriptions.title',
            ]);

        if ($id !== null) {
            return $query->where('company_subscriptions.id', $id)->first();
        }

        return $query->get();
    }



}
