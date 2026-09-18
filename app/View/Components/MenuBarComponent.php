<?php

namespace App\View\Components;

use App\Repositories\IdentityRepository;
use App\Repositories\UsersMenuRepository;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class MenuBarComponent extends Component
{
    /**
     * Create a new component instance.
     */
    protected $usersMenuRepository;
    protected $identityRepository;
    public $get_UsersMenu;
    public $auth;
    public $getCache_Identity_title;
    public $getCache_Identity_description;
    public $getCache_Identity_logo;
    public $getSidebarPostSpesial;

    public function __construct(UsersMenuRepository $usersMenuRepository, IdentityRepository $identityRepository, public $kodeFirstMenu = '', public $kodeSecondMenu = '')
    {
        $this->usersMenuRepository           = $usersMenuRepository;
        $this->identityRepository            = $identityRepository;
        $this->get_UsersMenu                 = $this->usersMenuRepository->getCache()->where("rel", 0);
        $this->getCache_Identity_title       = @$this->identityRepository->getCache()->where("kode", "title")->first()->value;
        $this->getCache_Identity_description = @$this->identityRepository->getCache()->where("kode", "description")->first()->value;
        $this->getCache_Identity_logo        = @$this->identityRepository->getCache()->where("kode", "logo")->first()->file_foto;
        $this->auth                          = auth()->user();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.menu-bar-component');
    }
}
