<?php

namespace App\Models\User;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;

    protected $fillable = ['key', 'label'];

    public function roles(){
        return $this->belongsToMany(Role::class);
    }

    public function users(){
        return $this->belongsToMany(User::class);
    }
    public static function getHandlerPermissionId() {
        $handlerPermissionId = Permission::where('key', "complaint_handler")->first()->id;
        return $handlerPermissionId;
    }

    const LIST_OF_PERMISSIONS = [
        'copan_edit'        =>    'ویرایش کد تخفیف',
        'manage_copan'      =>    'دسترسی کد تخفیف',
        'copan_create'      =>    'ساخت کد تخفیف',
        'copan_delete'      =>    'حذف کد تخفیف',

        'manage_dliver'     =>    'دسترسی سفارش',
        'create_dliver'     =>    'ایجاد ارسال سفارش',
        'edit_dliver'       =>    'ویراش ارسال سفارش ',
        'delete_dliver'     =>    'حذف ارسال سفارش',

        'manage_comment'    =>    'دسترسی کامنت',
        'show_comment'      =>    'نمایش کامنت',

        'manage_faq'        =>    'دسترسی سوالات متداول',
        'create_faq'        =>    'ایجاد سوالات متداول',
        'edit_faq'          =>    'ویراش سوالات متداول ',
        'delete_faq'        =>    'حذف سوالات متداول',

        'manage_page'       =>    'دسترسی صفحه',
        'create_page'       =>    'ایجاد صفحه',
        'edit_page'         =>    'ویراش صفحه',
        'delete_page'       =>    'حذف صفحه',

        'manage_slider'     =>    'دسترسی اسلایدر',
        'create_slider'     =>    'ایجاد اسلایدر',
        'edit_slider'       =>    'ویراش اسلایدر',
        'delete_slider'     =>    'حذف اسلایدر',

        'manage_category'   =>    'دسترسی دسته بندی',
        'create_category'   =>    'ایجاد دسته بندی',
        'edit_category'     =>    'ویراش دسته بندی',
        'delete_category'   =>    'حذف دسته بندی',

        'manage_brand'      =>    'دسترسی یرند',
        'create_brand'      =>    'ایجاد یرند',
        'edit_brand'        =>    'ویراش یرند',
        'delete_brand'      =>    'حذف یرند',

        'manage_product'    =>    'دسترسی محصولات',
        'create_product'    =>    'ایجاد محصولات',
        'edit_product'      =>    'ویراش محصولات',
        'delete_product'    =>    'حذف محصولات',

        'manage_role'       =>    'دسترسی نقش',
        'create_role'       =>    'ایجاد نقش',
        'edit_role'         =>    'ویراش نقش',
        'delete_role'       =>    'حذف نقش',

        'manage_user'       =>    'دسترسی کاربر',
        'create_user'       =>    'ایجاد کاربر',
        'edit_user'         =>    'ویراش کاربر',
        'delete_user'       =>    'حذف کاربر',
    ];
}
