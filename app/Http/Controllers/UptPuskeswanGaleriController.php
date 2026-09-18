<?php

namespace App\Http\Controllers;

use App\Http\Requests\UptPuskeswanGaleriRequest;
use App\Repositories\UptPuskeswanGaleriRepository;
use App\Traits\BaseTrait;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class UptPuskeswanGaleriController extends Controller implements HasMiddleware
{
    use BaseTrait;
    private $repository;
    private $request;

    public function __construct(UptPuskeswanGaleriRepository $repository, Request $request)
    {
        $this->repository = $repository;
        $this->request    = UptPuskeswanGaleriRequest::createFromBase($request);
        $this->initialize();
        $this->commonData['kode_first_menu']  = "UPT-PUSKESWAN";
    }

    public static function middleware(): array
    {
        $className  = class_basename(__CLASS__);
        $permission = str_replace('Controller', '', $className);
        $permission = trim(implode(' ', preg_split('/(?=[A-Z])/', $permission)));
        return [
            new Middleware("can:$permission Add", only: ['create', 'store']),
            new Middleware("can:$permission Detail", only: ['show']),
            new Middleware("can:$permission Edit", only: ['edit', 'update']),
            new Middleware("can:$permission Delete", only: ['destroy', 'destroy_selected']),
        ];
    }

	public function create_multiple(Request $request)
	{
		$data = $this->commonData + [];
        $data = $this->repository->customCreateMultipleData($data);
		return view("$this->route.create-multiple", $data);
	}
}
