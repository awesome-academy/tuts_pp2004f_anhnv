<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;

    const STT_DRAFT = 1;
    const STT_PUBLISHED = 2;
    const STT_DELETED = 0;
    const E_CREATE = 1;
    const E_UPDATE = 2;
    const E_PUBLISH = 3;
    const E_UNPUBLISH = 4;
    const E_TRASH = 5;
    const E_RESTORE = 6;
    const E_DELETE = 7;

    protected $table = 'posts';

    public $timestamps = false;
    
    protected $fillable = [
        'title',
        'slug',
        'image_thumb',
        'excerpt',
        'content',
        'event',
        'category_id',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function staff()
    {
        return $this->belongsToMany(Staff::class)->withPivot('post_id', 'staff_id', 'event', 'happened_at');
    }

    public function is_published()
    {
        return (empty($this->deleted_at) && $this->status === 2) ? true : false;
    }

    public function is_deleted()
    {
        return ($this->deleted_at && $this->status === 0) ? true : false;
    }
}
