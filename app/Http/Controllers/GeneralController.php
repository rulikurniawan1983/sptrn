<?php

namespace App\Http\Controllers;

use App\Repositories\DesaRepository;
use App\Repositories\UsersRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException as ErrorDecryptException;

class GeneralController extends Controller
{
    private $usersRepository;
    protected $desaRepository;

    public function __construct(UsersRepository $usersRepository, DesaRepository $desaRepository)
    {
        $this->usersRepository = $usersRepository;
        $this->desaRepository  = $desaRepository;
    }

    public function access_file($direktori, $file_name)
    {
        try {
            $direktori = Crypt::decrypt($direktori);
            $file_name = Crypt::decrypt($file_name);
        } catch (ErrorDecryptException $e) {
            abort(404);
        }
        abort_if(!in_array($direktori, ["users"]) || is_null($file_name), 404);
        $data = [
            "direktori" => $direktori,
            "file_name" => $file_name,
        ];
        if (in_array($direktori, ["users"])) {
            if (auth()->user()->current_role_id == 100) {
                $data['is_my_file'] = 1;
            }
            $getFile = $this->usersRepository->getByFile($data);
            $file_path = @$getFile["file_path"];
        }
        abort_if(!$getFile, 404);
        return response()->file($file_path);
    }

    public function kelurahan(Request $request)
    {
        $data = $this->desaRepository->getByIdKecamatan($request->id_kecamatan);
        return response()->json([
            'error' => 0,
            'data' => $data,
        ]);
    }
}
