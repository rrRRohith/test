<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;
    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
	protected $appends = ['logo_url', 'total_employees'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'logo',
        'website'
    ];

    /**
     * Employees of the companye
     */
    public function employees()
    {
        return $this->hasMany(Employee::class);
    }

    /**
     * Set default logo for company
     */
    public function getLogoAttribute($logo){
        return $logo ? : 'default.png';
    }

    /**
     * Set full url of the logo
     */
    public function getLogoUrlAttribute(){
        return asset('storage/images/'.($this->logo));
    }

    /**
     * Get total employees of the company
     */
    public function getTotalEmployeesAttribute(){
        return $this->employees()->count();
    }
}
