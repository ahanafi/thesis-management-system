<?php

namespace App\Models;

use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lecturer extends Model
{
    use HasFactory, Uuid;

    public $incrementing = false;

    protected $fillable = [
        'nidn',
        'full_name',
        'email',
        'gender',
        'study_program_code',
        'functional',
        'degree'
    ];

    public function getName()
    {
        $names = explode(" ", ucwords(strtolower($this->full_name)));

        if(count($names) <= 2) {
            return ucwords(strtolower($this->full_name));
        } else {
            $firstName = $names[0] . " " . $names[1];
            foreach($names as $key => $val) {
                if($key >= 2 && !empty($val)) {
                    $lastName .= $val[0].".";
                }
            }

            return $firstName . " " . $lastName . ", " . $this->degree;
        }
    }
}
