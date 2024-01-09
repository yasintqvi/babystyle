<?php

namespace App\Models\Market;

use App\Models\User;
use Hekmatinasser\Verta\Verta;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $table = "comments";

    protected $fillable = [
        'user_id',
        'product_item_id',
        'product_id',
        'parent_id',
        'description',
        'is_seen',
        'is_approved',
        'rate',
    ];

    public function scopeSearch($query, $keyword)
    {
        return $query->whereHas('user', fn($user) => 
            $user->where('first_name',"LIKE" , "%$keyword%")->whereOr('last_name', "LIKE", "%$keyword%")
        );
    }

    public function scopeApproved($query)
    {
        return $query->where('is_approved', 1);
    }

    public function scopeNotApproved($query)
    {
        return $query->where('is_approved', 0);
    }

    // relations
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function product(){
        return $this->belongsTo(Product::class);
    }

    public function getISApprovedAttribute($is_active){
        return $is_active ? "تایید شده" : "تایید نشده";
    }

    public function getCreateAtShamsi()
    {
         return new Verta($this->created_at);
    }

}
