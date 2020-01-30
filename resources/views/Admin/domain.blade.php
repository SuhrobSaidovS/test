@extends('layouts.masters')
@section('title')

    Branch | Web
@endsection

@section('content')
    <div class="row">
        <div class="container mt-4">
            @if(count($errors) >0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if(\Session::has('success'))
                <div class="alert alert-success">
                    <p>{{\Session::get('success')}}</p>
                </div>
            @endif
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                Добавить
            </button>

            <!-- Button trigger modal -->


            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Добавить Домен</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="{{action('Admin\DomainController@store')}}" method="post">

                            {{csrf_field()}}
                            {{csrf_field('PUT')}}


                            <div class="modal-body">


                                <div class="form-group">
                                    <label > Домен</label>
                                    <input type="text" name="domain" class="form-control"  placeholder="Введите название домена">
                                </div>

                                <div class="form-group">
                                    <label > Дата оплаты</label>
                                    <input type="date" name="paydate" class="form-control"  placeholder="Выберите дату оплаты">
                                </div>
                                <div class="form-group">
                                    <label > Дата след. платежа</label>
                                    <input type="date" name="expiredate" class="form-control"  placeholder="Дата след платежа">
                                </div>
                                <div class="form-group">
                                    <label > Сумма</label>
                                    <input type="number" name="paysumma" class="form-control" placeholder="Введите Сумму">
                                </div>
                                <div class="form-group">
                                    <label >Метод платежа</label>
                                    <select name="paymethod" class="form-control" >
                                        <option name="Cash"> В кассе</option>
                                        <option name="viaBank">Перечисление</option>
                                        <option name="externalPayment">Из зарубежа</option>

                                    </select>
                                </div>
                                <div class="form-group">
                                    <label >Email address</label>
                                    <input type="email" name="email" class="form-control"  placeholder="Enter email">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Закрыть</button>
                                <button type="submit" class="btn btn-success">Сохранить</button>
                            </div>


                        </form>


                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <thead class=" text-primary">
                    <th>Id</th>
                    <th>Домен</th>
                    <th>Дата оплаты</th>
                    <th>Дата Окончания</th>
                    <th>Сумма оплаты</th>
                    <th>Метод платежа</th>
                    <th>Почта</th>
                    <th>Изменить</th>
                    <th>Удалить</th>
                    </thead>
                    <tbody>

                    @foreach($domain as $row)
                        <tr>
                            <td> {{$row->id}}</td>
                            <td> {{$row->domain}}</td>
                            <td> {{$row->paydate}}</td>
                            <td>{{$row->expiredate}}</td>
                            <td>{{$row->paysumma}}</td>
                            <td>{{$row->paymethod}}</td>
                            <td>{{$row->email}}</td>
                            <td ><a href="/domain-edit/{{$row->id}}" class="btn btn-success">изменить</a> </td>
                            <td >
                                <form action="/domain-edit/{{$row->id}}" method="post">
                                    {{csrf_field()}}
                                    {{method_field('DELETE')}}
                                    <button type="submit" class="btn btn-danger">Удалить</button>

                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>




@endsection

@section('scripts')


@endsection
