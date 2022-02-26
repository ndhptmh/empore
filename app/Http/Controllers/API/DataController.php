<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Member;
use App\Models\BookLoan;
use Illuminate\Http\Request;
use DataTables;

class DataController extends Controller
{
    public function member(Request $request)
    {
        if ($request->ajax()) {
            $data = Member::orderBy('name')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn = '<a href="/member/'.$row->id.'" class="btn btn-success btn-sm"><i class="fa fa-eye"></i></a> 
                    <a href="/member/'.$row->id.'/edit" class="btn btn-warning btn-sm"> <i class="fa fa-pencil"></i></a>
                    <a href="javascript:void(0)" class="btn btn-danger" type="button" onclick="hapusMember('.$row->id.')">
                        <i class="fa fa-trash"></i>
                    </a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        else{
            $data = Member::get();
            return response([
                'status' => 1,
                'message' => 'berhasil mendapatkan data',
                'data' => $data,
            ]);
        }
    }

    public function bookloan(Request $request)
    {
       if ($request->ajax()) {
            $data = BookLoan::with('book')->latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    if($row->status=='pending'){
                        $actionBtn = '<a href="javascript:void(0)" class="btn btn-success btn-sm" type="button" onclick="terimaPeminjaman('.$row->id.')">
                            Accept</i>
                        </a>
                        <a href="javascript:void(0)" class="btn btn-danger btn-sm" type="button" onclick="tolakPeminjaman('.$row->id.')">
                            Decline</i>
                        </a>';
                        return $actionBtn;
                    }
                    elseif($row->status=='accepted'){
                        $actionBtn = '<a href="javascript:void(0)" class="btn btn-success btn-sm" type="button" onclick="returnPeminjaman('.$row->id.')">
                                        Return</i>
                                    </a>';
                        return $actionBtn;
                    }
                    else{
                        return $row->status;
                    }
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        else{
            $data = BookLoan::get();
            return response([
                'status' => 1,
                'message' => 'berhasil mendapatkan data',
                'data' => $data,
            ]);
        }

    }
}
