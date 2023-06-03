<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Feed\Feedable;
use Spatie\Feed\FeedItem;


class Blog extends Model implements Feedable
{

    protected $guarded = [];

    public function toFeedItem(): FeedItem
    {
        return FeedItem::create()
            ->id($this->id)
            ->title($this->title)
            ->summary($this->excerpt)
            ->updated($this->updated_at)
            ->link(url('/') . "/" . $this->slug);
    }

    public static function getFeedItems()
    {
        return Blog::all();
    }

}
