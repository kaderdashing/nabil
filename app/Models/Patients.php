<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Patients extends Model
{
    use HasFactory;
    

    protected $fillable = [
        'choices', 'name', 'age', 'type','serie', 'num','prescripteur', 'paye', 'reste', 'description'  
    ];
}
