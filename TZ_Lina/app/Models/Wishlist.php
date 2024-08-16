<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    use HasFactory;
    use HasFactory;
    public $timestamps = false;
    protected $table = 'wishlists';
    protected $guarded = '';
}
