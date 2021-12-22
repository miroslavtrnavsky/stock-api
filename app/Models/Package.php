<?php

namespace App\Models;

use App\Enums\PackageStateEnum;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

class Package extends Model implements Auditable
{
    use AuditableTrait;

    protected $guarded = ['id'];

    public function stock(): BelongsTo
    {
        return $this->belongsTo(Stock::class);
    }

    public function scopeWaitingOverDay(Builder $query): Builder
    {
        return $query->where('state', PackageStateEnum::WAITING_FOR_PICK_UP->value)
                     ->whereHas('audits', function ($q) {
                         $q->whereIn('audits.id', function (Builder $subQuery) {
                             $subQuery->select('id')
                                      ->where('new_values', PackageStateEnum::WAITING_FOR_PICK_UP->value)
                                      ->where('updated_at' < Carbon::now()->subDay())
                                      ->get();
                         });
                     });
    }
}