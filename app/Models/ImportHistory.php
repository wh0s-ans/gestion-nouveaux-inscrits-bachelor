<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ImportHistory extends Model
{
    protected $table = 'import_histories';
    protected $guarded = [];
    protected $casts = [
        'details_erreurs' => 'array',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
