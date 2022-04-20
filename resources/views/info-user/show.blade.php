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
        .boards_items {
            padding: 10px;
            background: rgba(110, 108, 108, 0.5);
            min-height: 50px;
            border: 1px solid;
        }

        .fon {
            min-height: 80px;
            background: rgba(207, 205, 205, 0.5);
            padding: 10px;
        }

        .title {
            padding: 5px;
        }

        .title:focus {
            outline: 1px solid red;
        }

        .add_btn {
            cursor: pointer;
        }

        .list_item {
            cursor: move;
        }

        .cursor-move {
            cursor: move !important;
        }
        .super_row{
            display: flex;
            justify-content: space-around;
        }
        .super_row{
            min-width: 100%;
        }
        .col{
            border: 1px solid black;
            border-radius: 5px;
            min-height: 100px;
        }
    </style>
    <div class="container-fluid">
        {{--  <a href="{{route('type-content.get-all-version', $typeContent->id_global)}}"
             class="btn btn-danger mt-2 mb-3">Венуться к списку</a>--}}
        <div class="p-2">
            <div class="container-fluid border-bottom">
                <h5 class="text-center">Просмотр версии шаблона</h5>
            </div>
            <div class="row mt-2 mb-0 ml-0 mr-0">
                <!-- эта зона где будут наши отрисованы контент-->
                <div class="col-sm-12 col-md-6 col-lg-8 col-xl-8 border-right boards ">
                    <div class="fon border-2 rounded mb-3 zone">
                        <div id="1" class="row2222 p-2 m-2 super_row">
                            <div id="row1/col1" class="col boards_items colZone"></div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-4 col-xl-4">
                    <div class="start-cart">
                        <div id="addLine" class="btn btn-outline-primary btn-block cursor-pointer">
                            <span> + </span> Добавить строку
                        </div>
                        <div id="addColumns" class="btn btn-outline-success btn-block cursor-move list_item" draggable="true">
                            <span> + </span> Добавить колонку
                        </div>
                        <div id="textField" class="btn btn-outline-secondary btn-block cursor-move list_item" draggable="true">
                            <span> + </span> Текстовое поле
                        </div>
                        <div id="dateField" class="btn btn-outline-secondary btn-block cursor-move list_item" draggable="true">
                            <span> + </span> Дата/время
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <button id="ready_obj" class="btn btn-block btn-outline-primary">Собрать объект </button>
            <button id="preview" class="btn btn-block btn-outline-primary mt-5">Предпросмотр страницы</button>
            <!--ЭТО ПРОСТО ДИВ ДЛЯ ТОГО ЧТО ПОКАЗАТЬ КАК СОБРАЛСЯ ОБЪЕКТ-->
            <div id="result" class="container-fluid mt-5 p-2"></div>
        </div>
    </div>

    <script>
        const addLine = document.getElementById('addLine'),
            addColumns = document.getElementById('addColumns')
        const buttonFinish = document.getElementById('ready_obj'),
            buttonPreview = document.getElementById('preview')
        let fff = [
            {
                idRow: "1",
                nameRow: "Название области",
                col: [
                    {
                        idCol: "row1/col1",
                        element: [
                            {id: 1,textInput: "wdwdwd",type: "input"}
                        ]
                    }
                ]
            },
            {
                idRow: "2",
                nameRow: "Название области",
                col: [
                    {
                        idCol: "row2/col1",
                        element: [
                            {id: 4, type: 'date', textInput: 'efefefefef'},
                            {id: 6, type: 'input', textInput: 'gggggggggg'},
                            {id: 7, type: 'input', textInput: 'ffff'},
                        ]
                    },
                    {
                        idCol: "row2/col2",
                        element: [
                            {id: 2, type: 'date', textInput: 'wdwdwd'}
                        ]
                    },
                    {
                        idCol: "row2/col3",
                        element: [
                            {id: 8, type: 'input', textInput: 'ffff'},
                            {id: 3, type: 'input', textInput: 'efefefef'}
                        ]
                    }
                ]
            }
        ]
        let arr = {} // временный от туда можно будет удалять данные или положить данные хз пока
        let data = [] //финальный объект со всеми данными
        let dragItem = '' //сюда делаем копию элемента которую будем перемещать
        let itemId = '' //сюда определяем какой элемент мы перетащили дата и время или просто инпут или текс арея
        let idItemsEl = 1 //id элементов куда тащим элементы
        let idBoardEl = 2 // id доски куда тащим элементы
        let addColumAll = false // если перетаскиваем колонку
        //ф-ции для добавления колонок
        function addBoard()
        {
            const boards = document.querySelector('.boards')
            const board = document.createElement('div')
            board.innerHTML = `
                <div class="fon border-2 rounded mb-3 zone">
                    <div id="${idBoardEl}" class=" p-2 m-2 super_row">
                        <div id="row${idBoardEl}/col1" class="col boards_items colZone"></div>
                    </div>
                </div>`
            boards.append(board)
            idBoardEl++
            dragAndDropZones()
            //changeTitle()
        }
        addLine.addEventListener('click', addBoard)
        function dragAndDropRightColumn()
        {
            //перечисляем все элементы в правой колонке
            const listItems = document.querySelectorAll('.list_item')
            //перебераем массивы
            for (let i = 0; i < listItems.length; i++)
            {
                const item = listItems[i]
                //начали перемещать элемент
                item.addEventListener('dragstart', () => {
                    console.log(item.id)
                    if(item.id === 'addColumns'){
                        itemId = item.id
                        dragItem = document.createElement('div')
                        dragItem.classList.add("col");
                        dragItem.classList.add("boards_items");
                        dragItem.classList.add("colZone");
                    } else {
                        dragItem = item.cloneNode();
                        itemId = item.id
                        dragItem.id = idItemsEl;
                        //dragItem.setAttribute("draggable", "false");
                        dragItem.classList.remove('list_item');
                        dragItem.classList.add("listItemReady");
                        dragItem.innerText = item.innerText;
                    }
                    //удаление элемента
                    /* dragItem.addEventListener('dblclick', (e)=>{
                         //console.log(e.path[0].id)
                         document.getElementById(e.path[0].id).remove()
                     })*/
                })
                //Надо сделать так при перетаскивании не удалять элемент сразу а только после того как он dragend совершил
                //возращаем элемент
                item.addEventListener('dragend', () => {})
            }
        }
        dragAndDropRightColumn()

        function dragAndDropZones()
        {
            //находим все зоны в которые можно скидывать элементы
            const listsZones = document.querySelectorAll('.boards_items')
            for (let j = 0; j < listsZones.length; j++)
            {
                //const listsZon = listsZones[j]
                //перетакивание на новую доску
                listsZones[j].addEventListener('dragover', e => {
                    e.preventDefault()
                })
                listsZones[j].addEventListener('dragenter', function (e) {
                    e.preventDefault() //убираем стандартные работы браузера
                    //this.style.backgroundColor = 'rgba(0,0,0,.3)'
                })
                listsZones[j].addEventListener('dragleave', function (e) {
                    //console.log(e)
                })
                listsZones[j].addEventListener('drop', function (e) {
                    if(itemId !== 'addColumns'){
                        this.append(dragItem)
                        showModal()
                    } else {
                        console.log(e.target.offsetParent)
                        console.log(e.target)
                        console.log(e)
                        let colZone = document.getElementById(e.path[1].id)
                        let colZoneOne = colZone.querySelectorAll('.colZone')
                        if(colZoneOne.length === 3){
                            alert('Вы больше не можете добавить сюда колонки!')
                        } else {
                            dragItem.id = `row${idBoardEl}/col1`
                            colZoneOne.forEach(function(item, i, arr) {
                                if(colZoneOne.length === 1){
                                    item.classList.remove('col-12');
                                } else {
                                    item.classList.remove('col-6');
                                }
                            })
                            colZone.append(dragItem)
                            dragAndDropZones()
                        }
                    }

                })
            }
        }
        dragAndDropZones()
        //фнкции работы с модальными окнами
        function showModal()
        {
            console.log(itemId)
            //ТАК НЕ ПРАВИЛЬНО НУЖНО СДЕЛАТЬ ЧТо бы было карсиво без id
            let ddd = ''
            switch (itemId)
            {
                case 'textField':
                    $('#modalefefef').modal('show')
                    ddd = '<label for="textInput">Наименование элемента</label>' +
                        '<input type="text" class="form-control textInput" id="textInput">'

                    break;
                case 'dateField':
                    $('#modalefefef2').modal('show')
                    document.getElementById('yes2').addEventListener('click', yesBtnModalInput)
                    document.getElementById('no2').addEventListener('click', noBtnModal)
                    break;
            }
            ddd += '<button id="yes" class="yes">Сохранить</button>'+
                '<button id="no" class="no">Отменить</button>'
            document.getElementById('resultModalS').innerHTML += ddd
            document.querySelector('.modal-title').innerHTML = 'Работа с тектовым полем'
            document.getElementById('yes').addEventListener('click', yesBtnModalInput)
            document.getElementById('no').addEventListener('click', noBtnModal)
        }
        function yesBtnModalInput()
        {
            //https://itchief.ru/javascript/associative-arrays
            switch (itemId)
            {
                case 'textField':
                    arr[idItemsEl] = {
                        id: idItemsEl,
                        type: 'input',
                        textInput: document.querySelector(".textInput").value,
                    }
                    $('#modalefefef').modal('hide')
                    document.querySelector(".textInput").value = ''
                    document.getElementById('resultModalS').innerHTML = ''
                    break;
                case 'cart2':
                    arr[idItemsEl] = {
                        id: idItemsEl,
                        type: 'date',
                        textInput: document.querySelector(".textInput2").value,
                    }
                    $('#modalefefef2').modal('hide')
                    document.querySelector(".textInput2").value = ''
                    break;
            }
            idItemsEl++ //для новых id
            //console.log(arr)
            //document.getElementById('result').append(arr)
        }
        function noBtnModal()
        {
            dragItem.remove()
            switch (itemId)
            {
                case 'cart1':
                    $('#modalefefef').modal('hide')
                    break;
                case 'cart2':
                    $('#modalefefef2').modal('hide')
                    break;
            }
            dragItem = ''
        }
        //собираем все карточки в объект
        function finish()
        {
            data = []
            //тут хочу получить список всех лини у линии есть колонки в которых есть элементы которые мы перенесли
            const boards = document.querySelector('.boards'),
                rowItems = boards.querySelectorAll('.zone')
            //перебераем массивы
            for (let i = 0; i < rowItems.length; i++)
            {
                //теперь ищим колонки в зоне!
                const colItems = rowItems[i].querySelectorAll('.colZone')
                col = []
                for (let j = 0; j < colItems.length; j++)
                {
                    //перебераю списики внутри колонки
                    const listItemReady = colItems[j].querySelectorAll('.listItemReady')
                    //console.log(listItemReady.length)
                    //проверяем колонки они могут быть пустые но они должны отображены быть все равно в финальном объекте
                    let arr2 = []
                    if (listItemReady.length !== 0)
                    {
                        //теперь ищим карточки с элементами и собираем объект data
                        for (let k = 0; k < listItemReady.length; k++)
                        {
                            //console.log(rowItems[i].id)
                            //console.log(colItems[j].id)
                            //console.log(listItemReady[k].id)
                            //тут нужно собирать по очереди ключи объекта
                            // после этого постепенно добавлять просто если даже пустые колонки что бы были с пусты значением
                            //console.log(colItems[j].id)
                            //console.log(listItemReady[k].id)
                            //console.log(11111)
                            arr2.push(arr[listItemReady[k].id])
                            //Object.assign(col, arr[listItemReady[k].id])
                        }
                    }
                    col.push({
                        idCol: colItems[j].id,
                        element: arr2
                    })
                }
                data.push({
                    idRow: rowItems[i].id,
                    nameRow: rowItems[i].parentNode.querySelector('span').textContent,
                    col: col
                })
                col = {}
            }
            console.log(data)
        }
        //это по старому
        function finish2()
        {
            //тут хочу получить список всех лини у линии есть колонки в которых есть элементы которые мы перенесли
            const boards = document.querySelector('.boards'),
                rowItems = boards.querySelectorAll('.zone')
            //перебераем массивы
            for (let i = 0; i < rowItems.length; i++)
            {
                //теперь ищим колонки в зоне!
                const colItems = rowItems[i].querySelectorAll('.colZone')

                for (let j = 0; j < colItems.length; j++)
                {
                    //перебераю списики внутри колонки
                    const listItemReady = colItems[j].querySelectorAll('.listItemReady')
                    //console.log(listItemReady.length)
                    //проверяем колонки они могут быть пустые но они должны отображены быть все равно в финальном объекте
                    col = {}
                    if (listItemReady.length !== 0)
                    {
                        //теперь ищим карточки с элементами и собираем объект data
                        for (let k = 0; k < listItemReady.length; k++)
                        {
                            //console.log(rowItems[i].id)
                            //console.log(colItems[j].id)
                            //console.log(listItemReady[k].id)
                            //тут нужно собирать по очереди ключи объекта
                            // после этого постепенно добавлять просто если даже пустые колонки что бы были с пусты значением
                            console.log(colItems[j].id)
                            console.log(listItemReady[k].id)
                            console.log(11111)
                            Object.assign(col, arr[listItemReady[k].id])
                        }
                    }
                    console.log(col)
                    col = {}
                    /*data[rowItems[i].id] = {
                        'nameRow': rowItems[i].parentNode.querySelector('span').textContent,
                        [colItems[j].id]: col
                    }*/
                }
            }
            console.log(data)
        }
        buttonFinish.addEventListener('click', finish)
        //Для отрисовки страницы
        /*
        * <label for="textInput">Наименование элемента</label>
                <input type="text" class="form-control textInput" id="textInput">
        * */
        function preview()
        {
            let content = '';
            if(data !== []){
                //console.log(data)
                content += '<div class="container-fluid rounded border border-primary">'
                data.forEach(function(item, i, arr) {
                    //console.log(item.col)
                    content += '<div class="row">'
                    content += `<h5 class="text-center mb-2">${item.nameRow}</h5>`
                    if(item.col.length === 1){
                        item.col.forEach(function(item, i, arr) {
                            //console.log(item)
                            content += '<div class="col-12">'
                            item.element.forEach(function(item, i, arr) {
                                //console.log(item)
                                if(item.type === "input"){
                                    content += `
                                        <label for="${item.id}">${item.textInput}</label>
                                        <input type="text" class="form-control" id="${item.id}">
                                        <br>
                                    `
                                }
                                else if(item.type === "date"){
                                    content += `
                                        <label for="${item.id}">${item.textInput}</label>
                                        <input type="date" class="form-control " id="${item.id}">
                                        <br>
                                    `
                                }
                            })
                            content += '</div>'
                        })
                    }
                    else if(item.col.length === 2){
                        item.col.forEach(function(item, i, arr) {
                            //console.log(item)
                            content += '<div class="col-6">'
                            item.element.forEach(function(item, i, arr) {
                                //console.log(item)
                                if(item.type === "input"){
                                    content += `
                                        <label for="${item.id}">${item.textInput}</label>
                                        <input type="text" class="form-control" id="${item.id}">
                                        <br>
                                    `
                                } else if(item.type === "date"){
                                    content += `
                                        <label for="${item.id}">${item.textInput}</label>
                                        <input type="date" class="form-control " id="${item.id}">
                                        <br>
                                    `
                                }
                            })
                            content += '</div>'
                        })
                    }
                    else {
                        item.col.forEach(function(item, i, arr) {
                            //console.log(item)
                            content += '<div class="col-4">'
                            item.element.forEach(function(item, i, arr) {
                                //console.log(item)
                                if(item.type === "input"){
                                    content += `
                                        <label for="${item.id}">${item.textInput}</label>
                                        <input type="text" class="form-control" id="${item.id}">
                                        <br>
                                    `
                                } else if(item.type === "date"){
                                    content += `
                                        <label for="${item.id}">${item.textInput}</label>
                                        <input type="date" class="form-control " id="${item.id}">
                                        <br>
                                    `
                                }
                            })
                            content += '</div>'
                        })
                    }
                    content += '</div><br>'
                })
                content += '</div>'
            } else {
                content += `
                    <div class="alert alert-danger text-center font-weight-bold" role="alert">
                        Данных на странице не найдено! Добавьте колонки и элементы на страницу!
                    </div>`
            }
            $('#result').html(content);
        }
        function preview2()
        {
            let content = '';
            if(fff !== []){
                console.log(fff)
                content += '<div class="container-fluid rounded border border-primary">'
                fff.forEach(function(item, i, arr) {
                    console.log(item.col)
                    content += '<div class="row">'
                    content += `<h5 class="text-center mb-2">${item.nameRow}</h5>`
                    if(item.col.length === 1){
                        item.col.forEach(function(item, i, arr) {
                            console.log(item)
                            content += '<div class="col-12">'
                            item.element.forEach(function(item, i, arr) {
                                //console.log(item)
                                if(item.type === "input"){
                                    content += `
                                        <label for="${item.id}">${item.textInput}</label>
                                        <input type="text" class="form-control" id="${item.id}">
                                        <br>
                                    `
                                }
                                else if(item.type === "date"){
                                    content += `
                                        <label for="${item.id}">${item.textInput}</label>
                                        <input type="date" class="form-control " id="${item.id}">
                                        <br>
                                    `
                                }
                            })
                            content += '</div>'
                        })
                    }
                    else if(item.col.length === 2){
                        item.col.forEach(function(item, i, arr) {
                            //console.log(item)
                            content += '<div class="col-6">'
                            item.element.forEach(function(item, i, arr) {
                                //console.log(item)
                                if(item.type === "input"){
                                    content += `
                                        <label for="${item.id}">${item.textInput}</label>
                                        <input type="text" class="form-control" id="${item.id}">
                                        <br>
                                    `
                                } else if(item.type === "date"){
                                    content += `
                                        <label for="${item.id}">${item.textInput}</label>
                                        <input type="date" class="form-control " id="${item.id}">
                                        <br>
                                    `
                                }
                            })
                            content += '</div>'
                        })
                    }
                    else {
                        item.col.forEach(function(item, i, arr) {
                            //console.log(item)
                            content += '<div class="col-4">'
                            item.element.forEach(function(item, i, arr) {
                                //console.log(item)
                                if(item.type === "input"){
                                    content += `
                                        <label for="${item.id}">${item.textInput}</label>
                                        <input type="text" class="form-control" id="${item.id}">
                                        <br>
                                    `
                                } else if(item.type === "date"){
                                    content += `
                                        <label for="${item.id}">${item.textInput}</label>
                                        <input type="date" class="form-control " id="${item.id}">
                                        <br>
                                    `
                                }
                            })
                            content += '</div>'
                        })
                    }
                    content += '</div><br>'
                })
                content += '</div>'
            } else {
                content += `
                    <div class="alert alert-danger text-center font-weight-bold" role="alert">
                        Данных на странице не найдено! Добавьте колонки и элементы на страницу!
                    </div>`
            }
            $('#result').html(content);
        }
        buttonPreview.addEventListener('click', preview2)
        //Это были первые наброски
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
        /*function dragAndDrop(){
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
        dragAndDrop()*/
    </script>
@endsection
