<?php
namespace App\View\Composers;

use App\Models\Comic;
use Illuminate\View\View;

class ErrorComposer{

    protected $comic;

    public function __construct(Comic $comic)
    {
        $this->comic = $comic;
    }

    public function compose(View $view)
    {
        $view->with('randomComics', Comic::query()->inRandomOrder()->take(6)->get());
    }
}
