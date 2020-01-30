@extends('layouts.masters')

@section('title')
Edit-Branch | Web
@endsection

@section('content')

<div class="container">

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>Редактировать Домен</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <form action="/domain-edit/{{$domain->id}}" method="post">
                                {{csrf_field()}}
                                {{method_field('PUT')}}
                                <div class="form-group">
                                    <label > Домен</label>
                                    <input type="text" name="domain"  value="{{$domain->domain}}" class="form-control"  placeholder="Введите название домена">
                                </div>

                                <div class="form-group">
                                    <label > Дата оплаты</label>
                                    <input type="date" name="paydate" value="{{$domain->paydate}}" class="form-control"  placeholder="Выберите дату оплаты">
                                </div>
                                <div class="form-group">
                                    <label > Дата след. платежа</label>
                                    <input type="date" name="expiredate" value="{{$domain->expiredate}}" class="form-control"  placeholder="Дата след платежа">
                                </div>
                                <div class="form-group">
                                    <label > Сумма</label>
                                    <input type="number" name="paysumma" value="{{$domain->paysumma}}" class="form-control" placeholder="Введите Сумму">
                                </div>
                                <div class="form-group">
                                    <label >Метод платежа</label>
                                    <select name="paymethod" value="{{$domain->paymethod}}" class="form-control" >
                                        <option name="cash" value="Cash"> В кассе</option>
                                        <option name="viaBank" value="viaBank">Перечисление</option>
                                        <option name="externalPayment" value="externalPayment">Из зарубежа</option>

                                    </select>
                                </div>
                                <div class="form-group">
                                    <label >Email address</label>
                                    <input type="email" name="email" value="{{$domain->email}}" class="form-control"  placeholder="Enter email">
                                </div>


                                <button type="submit" class="btn btn-success">Обновить</button>
                                <a href="/domain" class="btn btn-danger">Отменить</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




@endsection

@section('scripts')
@endsection
