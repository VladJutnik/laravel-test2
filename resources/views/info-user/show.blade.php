
@extends('layouts.main-layout')
@section('content')

    <style>
        .boards_items{
            min-height: 80px;
            background: rgba(0,0,0, .5);
            padding: 10px;
        }
        .title{
            padding: 5px;
        }
        .title:focus{
            outline: 1px solid red;
        }
    </style>
    <div class="container-fluid">
        {{--<a href="{{route('type-content.get-all-version', $typeContent->id_global)}}"
           class="btn btn-danger mt-2 mb-3">Венуться к списку</a>--}}
        <div class="p-2">
            <h5 class="text-center">Просмотр версии шаблона</h5>
            <hr>
            <div class="row mt-0 mb-0 ml-0 mr-0">
                <!-- эта зона где будут наши отрисованы контент-->
                <div class="col-sm-12 col-md-6 col-lg-8 col-xl-8 border-right boards">
                    <div class="border-2 rounded boards_items mb-3">
                        <!--contenteditable="true" изменения названия-->
                        <div class="text-center m-2">
                            <span contenteditable="true" class="title rounded">Название области</span>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-4 col-xl-4">
                    <div class="m-2 start-cart">
                        <div class="add_btn border-success border p-2 rounded btn-block">
                            <span> + </span> Добавить поле
                        </div>
                        <div class="crt1">
                            <div id="cart1" class="list_item p-2 border bg-gradient-cyan rounded btn-block" draggable="true">
                                Стартовая карта 1
                            </div>
                        </div>
                        <div class="crt2">
                            <div id="cart2" class="list_item p-2 border bg-gradient-cyan rounded btn-block" draggable="true">
                                Стартовая карта 2
                            </div>
                        </div>
                        <a href="#" data-toggle="modal" data-target="#modalefefef" class="nav-link">modal</a>
                    </div>
                </div>
            </div>
        </div>
        <hr>
    </div>
    <script>


        //var sortable = $('sortable');
        //console.log('wdwd')
        //dragula([sortable]);
        const button = document.querySelector('.add_btn')
        let idItemsEl = 1
        let idBoardEl = 1
        function dragAndDrop(){
            const listItems = document.querySelectorAll('.list_item'),
                lists2 = document.querySelectorAll('.boards_items')
            //перебераем массивы
            for(let i = 0; i < listItems.length; i++){
                const item = listItems[i]
                //начали перемещать элемент
                item.addEventListener('dragstart', ()=>{
                    dragItem = item.cloneNode();
                    dragItem.id = idItemsEl;
                    dragItem.innerText = item.innerText;
                    idItemsEl++
                    //$('#modalefefef').modal('show');
                    //console.log(dragItem)
                    //console.log(item.parentElement)
                    //удаление элемента
                    dragItem.addEventListener('dblclick', (e)=>{
                        //console.log(e.path[0].id)
                        document.getElementById(e.path[0].id).remove()
                    })
                })
                //Надо сделать так при перетаскивании не удалять элемент сразу а только после того как он dragend совершил
                //закончили перемещать элемент
                item.addEventListener('dragend', ()=>{
                    item.parentElement.append(item)
                })


                for(let j = 0; j < lists2.length; j++){
                    const list555 = lists2[j]
                    //перетакивание на новую доску
                    list555.addEventListener('dragover', e =>{
                        e.preventDefault()
                    })
                    list555.addEventListener('dragenter', function (e){
                        e.preventDefault() //убираем стандартные работы браузера
                        //this.style.backgroundColor = 'rgba(0,0,0,.3)'
                    })
                    list555.addEventListener('dragleave', function (e){
                        //this.style.backgroundColor = 'rgba(0,0,0,0)'
                    })
                    list555.addEventListener('drop', function (e){
                        this.append(dragItem)
                    })
                }
            }
        }
        dragAndDrop()
        function addBoard(){
            const boards = document.querySelector('.boards')
            const board = document.createElement('div')
            board.innerHTML = `
                <div class="border-2 rounded boards_items mb-3">
                    <div class="text-center m-2">
                        <span contenteditable="true" class="title rounded">Название области</span>
                    </div>
                </div>
            `
            boards.append(board)
            dragAndDrop()
        }
        button.addEventListener('click', addBoard)
        function changeTitle(){
            const titles = document.querySelectorAll('.title')
            titles.forEach(title =>{
                title.addEventListener('click', e => {
                    console.log(title)
                    old = e.target.textContent
                    e.target.textContent = ''
                })
            })
        }

        changeTitle()
    </script>

    {{--<a class="btn btn-primary mt-3 mb-2" role="button" href="{{ route('info.create') }}">Добавление пользователя</a>--}}
    {{--{{print_r('<br><br>')}}
    {{print_r('<pre>')}}
    {{print_r($info->user->name)}}
    {{print_r('</pre>')}}
    {{print_r('<br><br>')}}
    {{print_r('<br><br>')}}
    {{print_r('<br><br>')}}
    {{print_r('<br><br>')}}
    {{print_r($wdwd)}}--}}
   {{-- @foreach($datas as $key => $data)
        <div class="border rounded m-2 p-2">
            <form class="form-inline">
                <lable>{{$datas[$key]}}</lable>
                <a href="{{ route('info.show', $info) }}">{{ $info->user->name }}</a>
                <form method="POST" action="{{ route('info.destroy', $info) }}">
                    <a type="button" class="btn btn-warning" href="{{ route('info.edit', $info) }}">Редактирование</a>
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger" type="submit">Удалить</button>
                </form>
            </form>
        </div>
    @endforeach--}}
    {{--<table class="table table-sm">
        <thead>
        <tr>
            <th scope="col" class="text-center">#</th>
            <th scope="col" class="text-center">Name</th>
            <th scope="col" class="text-center">Email</th>
            <th scope="col" class="text-center">Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
            <tr>
                <th scope="row">{{ $user->id }}</th>
                <td>
                    <a href="{{ route('users.show', $user) }}">{{ $user->name }}</a>
                </td>
                <td>
                    <a href="{{ route('users.show', $user) }}">{{ $user->email }}</a>
                </td>
                <td>
                    <form method="POST" action="{{ route('users.destroy', $user) }}">
                        <a type="button" class="btn btn-warning" href="{{ route('users.edit', $user) }}">Редактирование</a>
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger" type="submit">Удалить</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{$users->links('vendor.pagination.bootstrap-4')}}--}}
@endsection
