<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\RecordsActivity;
use App\Reply;

class Favorite extends Model
{
    use RecordsActivity;
    /**
     * Don't auto-apply mass assignment protection.
     * 
     * @var array
     */
    protected $guarded = [];

    /**
     * A favorite belongs to a reply (for now).
     * 
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function reply()
    {
        return $this->belongsTo(Reply::class);
    }
}
