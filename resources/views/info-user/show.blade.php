
@extends('layouts.main-layout')
@section('content')
    <!--    <style>
        .wrapper {
            display: table;
        }
        .container {
            display: table-cell;
            background-color: rgba(255, 255, 255, 0.2);
            width: 50%;
        }
        .container > div,
        .gu-mirror {
            margin: 10px;
            padding: 10px;
            background-color: rgba(0, 0, 0, 0.2);
            transition: opacity 0.4s ease-in-out;
        }
        .container > div {
            cursor: move;
            cursor: grab;
            cursor: -moz-grab;
            cursor: -webkit-grab;
        }
        .container .ex-moved {
            background-color: #e74c3c;
        }
        .container.ex-over {
            background-color: rgba(255, 255, 255, 0.3);
        }
        .container.ex-over {
            background-color: rgba(255, 255, 255, 0.3);
        }
    </style>-->
    <style>
        .boards_items{
            padding: 10px;
            background: rgba(110, 108, 108, 0.5);
            min-height: 50px;
            border: 1px solid;
        }
        .fon{
            min-height: 120px;
            background: rgba(207, 205, 205, 0.5);
            padding: 10px;
        }
        .title{
            padding: 5px;
        }
        .title:focus{
            outline: 1px solid red;
        }
        .add_btn{
            cursor: pointer;
        }
        .list_item{
            cursor: move;
        }
    </style>
    <div class="container-fluid">
      {{--  <a href="{{route('type-content.get-all-version', $typeContent->id_global)}}"
           class="btn btn-danger mt-2 mb-3">Венуться к списку</a>--}}
        <div class="p-2">
            <h5 class="text-center">Просмотр версии шаблона</h5>
            <hr>
            <div class="row mt-0 mb-0 ml-0 mr-0">
                <!-- эта зона где будут наши отрисованы контент-->
                <div class="col-sm-12 col-md-6 col-lg-8 col-xl-8 border-right boards ">

                </div>
                <div class="col-sm-12 col-md-6 col-lg-4 col-xl-4">
                    <div class="m-2 start-cart">
                        <div id="add_btn1" class="add_btn border-success border p-2 md-2 rounded btn-block">
                            <span> + </span> Добавить редактируемое поле c 1-ой колонкой
                        </div>
                        <div id="add_btn2" class="add_btn border-success border p-2 md-2 rounded btn-block">
                            <span> + </span> Добавить редактируемое поле c 2-мя колонками
                        </div>
                        <div id="add_btn3" class="add_btn border-success border p-2 md-2 rounded btn-block">
                            <span> + </span> Добавить редактируемое поле c 3-мя колонками
                        </div>
                        <div class="crt1 mt-2">
                            <div id="cart1" class="list_item p-2 border bg-gradient-cyan rounded btn-block" draggable="true">
                                Стартовая карта 1
                            </div>
                        </div>
                        <div class="crt2 mt-2">
                            <div id="cart2" class="list_item p-2 border bg-gradient-cyan rounded btn-block" draggable="true">
                                Стартовая карта 2
                            </div>
                        </div>
                        <a href="#" data-toggle="modal" data-target="#modalefefef" class="nav-link">modal</a>
                    </div>
                </div>
            </div>
            <hr>
            <button id="ready_obj" class="btn btn-block btn-outline-primary">Собрать объект</button>

            <!--ЭТО ПРОСТО ДИВ ДЛЯ ТОГО ЧТО ПОКАЗАТЬ КАК СОБРАЛСЯ ОБЪЕКТ-->
            <div id="result"></div>
        </div>
    </div>
    <script>
        const buttonAdd1 = document.getElementById('add_btn1'),
            buttonAdd2 = document.getElementById('add_btn2'),
            buttonAdd3 = document.getElementById('add_btn3'),
            buttonFinish = document.getElementById('ready_obj')
        //console.log(button)
        let idItemsEl = 1
        let idBoardEl = 1
        let arr = []
        function dragAndDrop(){
            const listItems = document.querySelectorAll('.list_item'),
                lists2 = document.querySelectorAll('.boards_items')
            //перебераем массивы
            for(let i = 0; i < listItems.length; i++){
                const item = listItems[i]
                //начали перемещать элемент
                item.addEventListener('dragstart', ()=>{
                    //item.parentElement.append(item)
                    dragItem = item.cloneNode();

                    //$('#modalefefef').modal('show');
                    console.log(item)
                    //console.log(item.parentElement)
                    //удаление элемента
                    dragItem.addEventListener('dblclick', (e)=>{
                        //console.log(e.path[0].id)
                        document.getElementById(e.path[0].id).remove()
                    })
                    dragItem.id = idItemsEl;
                    dragItem.setAttribute("draggable", "false");
                    dragItem.classList.remove('list_item');
                    dragItem.classList.add("ok", "understand");
                    dragItem.innerText = item.innerText;
                    //добавляю в массив значения
                    arr.push(idItemsEl);
                    //ОН ДВАЖДЫ назначает id
                    console.log(arr)
                    idItemsEl++
                })
                //Надо сделать так при перетаскивании не удалять элемент сразу а только после того как он dragend совершил
                //возращаем элемент
                item.addEventListener('dragend', ()=>{

                })
                //навешиваем для наших областей
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

                        //тут вызывать функциию для перетаскивания элементов внутри области или подумать
                        // мб для перетаскивания в разные областя
                    })
                }
            }
        }
        dragAndDrop()

        //ф-ции для добавления колонок
        function addBoard1(){
            const boards = document.querySelector('.boards')
            const board = document.createElement('div')
            board.innerHTML = `
                <div class="fon border-2 rounded mb-3">
                    <div class="text-center m-2">
                        <span contenteditable="true" class="title rounded">Название области</span>
                    </div>
                    <hr>
                    <div id="${idBoardEl}" class="row p-2 m-2">
                        <div id="row${idBoardEl}/col1" class="col-12 boards_items"></div>
                    </div>
                </div>`
            boards.append(board)
            idBoardEl++
            dragAndDrop()
            //changeTitle()
        }
        buttonAdd1.addEventListener('click', addBoard1)
        //ф-ции для добавления колонок
        function addBoard2(){
            const boards = document.querySelector('.boards')
            const board = document.createElement('div')
            board.innerHTML = `
                <div class="fon border-2 rounded mb-3">
                    <div class="text-center m-2">
                        <span contenteditable="true" class="title rounded">Название области</span>
                    </div>
                    <hr>
                    <div id="${idBoardEl}" class="row p-2 m-2">
                        <div id="row${idBoardEl}/col1" class="col-6 boards_items"></div>
                        <div id="row${idBoardEl}/col2" class="col-6 boards_items"></div>
                    </div>
                </div>`
            boards.append(board)
            idBoardEl++
            dragAndDrop()
            //changeTitle()
        }
        buttonAdd2.addEventListener('click', addBoard2)
        //ф-ции для добавления колонок
        function addBoard3(){
            const boards = document.querySelector('.boards')
            const board = document.createElement('div')
            board.innerHTML = `
                <div class="fon border-2 rounded mb-3">
                    <div class="text-center m-2">
                        <span contenteditable="true" class="title rounded">Название области</span>
                    </div>
                    <hr>
                    <div id="${idBoardEl}" class="row">
                        <div id="row${idBoardEl}/col1" class="col-4 boards_items"></div>
                        <div id="row${idBoardEl}/col2" class="col-4 boards_items"></div>
                        <div id="row${idBoardEl}/col3" class="col-4 boards_items"></div>
                    </div>
                </div>`
            boards.append(board)
            idBoardEl++
            dragAndDrop()
            //changeTitle()
        }
        buttonAdd3.addEventListener('click', addBoard3)

        function finish(){
            console.log(111)
        }
        buttonFinish.addEventListener('click', finish)
        //function changeTitle(){
        //    const titles = document.querySelectorAll('.title')
        //    titles.forEach(title =>{
        //        title.addEventListener('click', e => {
        //            console.log(title)
        //            old = e.target.textContent
        //            e.target.textContent = ''
        //        })
        //    })
        //}
        //changeTitle()

        //var sortable = document.querySelector('.sortable');
        //console.log(sortable)
        //
        //function dragulaF(sortable){
        //    dragula([sortable]);
        //}

    </script>
@endsection
