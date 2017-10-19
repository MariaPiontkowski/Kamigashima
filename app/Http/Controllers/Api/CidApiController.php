<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cid;
use Yajra\Datatables\Datatables;

class CidApiController extends Controller
{

    /**
     * Display DataTables result.
     *
     * @return Datatables
     */
    public function getCidsData()
    {
        $cids = Cid::all();

        return Datatables::of($cids)
            ->addColumn("action", function ($cid) {
                return '<a href="' . route("cid.edit", $cid->id) . '" 
                        class="btn bg-grey btn-xs waves-effect" title="Editar CID"
                        data-toggle="tooltip" data-placement="top"> 
                            <i class="material-icons">edit</i>
                        </a>';
            })
            ->escapeColumns(false)
            ->make(true);
    }

}
