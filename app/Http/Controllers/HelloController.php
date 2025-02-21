<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests\HelloRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Validation\ValidatesRequests;

class HelloController extends Controller
{
    use ValidatesRequests;

    public function index(Request $request)
    {
        $items = DB::table('people')->orderBy('age', 'asc')->get();

        return view('hello.index', ['items' => $items]);
    }

    public function post(Request $request)
    {
        if (isset($request->id)) {
            $param = ['id' => $request->id];
            $items = DB::select('select * from people where id = :id', $param);
        } else {
            $items = DB::select('select * from people');
        }

        return view('hello.index', ['items' => $items]);
    }


    public function add(Request $request)
    {
        return view('hello.add');
    }

    public function create(Request $request)
    {
        $param = [
            'name' => $request->name,
            'mail' => $request->mail,
            'age' => $request->age,
        ];
        DB::table('people')->insert($param);
        return redirect('/hello');
    }


    public function edit(Request $request)
    {
        $item = DB::table('people')->where('id', $request->id)->first();
        return view('hello.edit', ['form' => $item]);
    }

    public function update(Request $request)
    {
        $param = [
            'name' => $request->name,
            'mail' => $request->mail,
            'age' => $request->age,
        ];
        DB::table('people')
            ->where('id', $request->id)
            ->update($param);
        return redirect('/hello');
    }


    public function del(Request $request)
    {
        $item = DB::table('people')
            ->where('id', $request->id)
            ->first();
        return view('hello.del', ['form' => $item]);
    }

    public function remove(Request $request)
    {
        DB::table('people')
            ->where('id', $request->id)
            ->delete();
        return redirect('/hello');
    }


    public function show(Request $request)
    {
        $page = $request->page;
        $items = DB::table('people')
            ->offset(($page - 1) * 3)
            ->limit(3)
            ->get();
        return view('hello.show', ['items' => $items]);
    }


    public function rest(Request $request)
    {
        return view('hello.rest');
    }
}
