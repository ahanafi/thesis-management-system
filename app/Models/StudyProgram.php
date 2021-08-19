<?php

namespace App\Models;

use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudyProgram extends Model
{
    use HasFactory, Uuid;

    public $incrementing = false;
    protected $keyType = 'string';

    public function leader()
    {
        return $this->hasOne(Lecturer::class, 'nidn', 'lecturer_code');
    }

    public function getName()
    {
        $names = explode(" ", $this->name);
        if(count($names) > 1) {
            $resultName = "";
            foreach ($names as $name) {
                $resultName .= strtoupper($name[0]);
            }
            return $resultName;
        }

        return $this->name;
    }

    public function getNameWithLevel()
    {
        return $this->level . " - " . $this->getName();
    }

    public function getComplexName()
    {
        return $this->level . " - " . $this->name;
    }
}
