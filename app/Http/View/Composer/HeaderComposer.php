<?php
namespace App\Http\View\Composer;

use App\Models\Section;
use Illuminate\View\View;

class HeaderComposer
{
  public function compose(View $view)
        {
            $sections = Section::with('categories')->where('status', 1)->get();
            $view->with(compact('sections'));
        }
}
