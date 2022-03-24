<?php

namespace App\Http\Controllers;

use App\Http\Requests\InfoUserRequest;
use App\Models\InfoUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class InfoUserController extends Controller
{
    public function index()
    {
        $infoUsers = InfoUser::with('user')->get();
        //compact('user');
        return view('info-user.index', [
            'infoUsers' => $infoUsers,
            'wdwd' => 'wdwd',
        ]);
    }

    public function create()
    {
        return view('info-user.form');
    }

    public function store(InfoUserRequest $request)
    {
        //Добавление пользовталея все что пришло User::create($request->all());
        InfoUser::create($request->only(['name', 'email']));
        //dd($request->all());
        return redirect()->route('users.index');//это путь в web.php направление поэтому сдесь users
    }

    public function show(InfoUser $info)
    {
        $data = [
            'date' => [
                'name' => 'Дата и время',
                'null' => 'null',
                'sort' => '0',
            ],
            'input' => [
                'name' => 'Введите значение',
                'null' => 'null',
                'type' => 'text',
                'sort' => '1',
            ],
            'textarea' => [
                'name' => 'Ваш ответ',
                'null' => 'null',
                'row' => '1',
                'sort' => '2',
            ],
        ];
        $data += [
            'textarea2' => [
                'name' => 'Ваш ответ',
                'null' => 'null',
                'row' => '1',
                'sort' => '3',
            ],
        ];
       /* print_r('<pre>');
        print_r($data);
        print_r('<br><br><br>');
        print_r(json_encode($data));
        print_r('<br><br><br>');
        print_r(json_decode($data));
        print_r('</pre>');
        print_r('<br><br><br>');*/
        foreach ($data as $key =>$dat){
            print_r($key);
            print_r('<br><br><br>');
            print_r($dat['name']);
            print_r('<br><br><br>');
        }
        return view('info-user.show', ['info'=>$info, 'datas'=>$data]);//этот путь перенаправление в нашу вью !!!  поэтому сдесь user
    }

    public function edit(InfoUser $user)
    {
        return view('user.form', ['user'=>$user]);//этот путь перенаправление в нашу вью !!!  поэтому сдесь user
    }

    public function update(InfoUserRequest $request, InfoUser $user)
    {
        $user->update($request->only(['name','email']));
        return redirect()->route('users.index');//это путь в web.php направление поэтому сдесь users
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index');//это путь в web.php направление поэтому сдесь users
    }
}
