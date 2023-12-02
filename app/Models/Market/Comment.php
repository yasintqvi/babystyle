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

    protected $guarded = [];

    // protected $fillable = [
    //     'user_id',
    //     'product_item_id',
    //     'parent_id',
    //     'description',
    //     'is_seen',
    //     'is_approved',
    //     'rate',
    // ];

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
