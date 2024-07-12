<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BulkContacts extends Model
{
   protected $fillable = [
        'contact_id',
        'bulk_id',
        'status'
   ];
}
