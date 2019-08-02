<?php

namespace App;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'title', 'slug', 'description', 'cover'
    ];

    protected $dates = ['published_at', 'deleted_at'];

    public static function boot()
    {
        parent::boot();

        static::creating(function($post) {
            $post->slug = self::generateSlug($post);
        });

        static::updating(function($post) {
            $currentPost = self::findOrFail($post->id);

            if ($post->title !== $currentPost->title) {
                $post->slug = self::generateSlug($post);
            }else{
                $post->slug = $currentPost->slug;
            }
        });

        static::deleting(function($post) {
            removeFile($post->cover);
        });
    }

    private static function generateSlug($post)
    {
        $slug = Str::slug($post->title, '-');

        if(!static::where('slug', $slug)->get()->isEmpty()){
            $i = 1;
            $newSlug = $slug.'-'.$i;
            while(!static::where('slug', $newSlug)->get()->isEmpty()){
                $i++;
                $newSlug = $slug.'-'.$i;
            }
            $slug = $newSlug;
        }

        return $slug;
    }

    public function getFormattedPublishedAtAttribute() {
        setlocale(LC_TIME, 'id_ID.utf8');
        return \Carbon\Carbon::parse($this->published_at)->formatLocalized('%d %B %Y');
    }
}
