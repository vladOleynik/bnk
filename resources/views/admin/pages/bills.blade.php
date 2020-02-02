@extends('layouts.cabinet')

@section('title') Счета @stop

@section('content')
    <div class="main-content main-content_height">
        <div class="row">
            <div class="col col--lg-12">
                <div class="overview__line">
                    <h2 class="overview__title">Обзор</h2>
                </div>
                <div class="table table__name">
                    <span>Просмотр краткой сводки по Вашему портфелю и получение детальной информации о движениях по счету.</span>
                </div>
                <div class="table">
                    <div class="table__head">
                        <div class="table__head_col">Счет</div>
                        <div class="table__head_col">Тип / Валюта</div>
                        <div class="table__head_col">Доступный остаток</div>
                        <div class="table__head_col">Текущий баланс</div>
                    </div>
                    <form id="account_form_go" action="{{route('account.show')}}" method="post">
                        @csrf
                        <input type="hidden" name="account" value="" id="acc_data_field">
                    </form>
                    @isset($accounts)
                        @foreach($accounts as $item)
                            <div class="table__list" >
                        <div class="table__list_col">
                            <input type="radio" >
                            <a href="#" class="account_details_class" account_data="{{$item->id}}">{{ $item->number }}</a>
                        </div>
                        <div class="table__list_col table__list_col-center">{{\App\Helpers\CurrencyHelper::getCurrency($item->currency_id)}}</div>
                        <div class="table__list_col table__list_col-right">
                            {{$item->balance_current}} {{\App\Helpers\CurrencyHelper::getCurrencyCode($item->currency_id)}}
                        </div>
                        <div class="table__list_col table__list_col-right">
                            <money-value :value="item.balance_available" :code="item.currency"></money-value>
                        </div>
                    </div>
                        @endforeach
                    @endisset
                </div>

                <div class="table__buttons table__buttons_offset">
                    <a class="btn" href="#" v-on:click.prevent="forwardToTransactions()">Движение средств по счету</a>

                    <a class="btn" href="#" v-on:click.prevent="forwardToDetails()">Детали счета</a>
                    <a class="btn" href="#" v-on:click.prevent="forwardToStatements()">Account Statements</a>
                </div>
                <div class="table__buttons ">
                    <a class="btn" href="#" v-on:click.prevent="downloadCSV()">Файл в формате Excel</a>

                    <a class="btn" href="#" v-on:click.prevent="downloadHTML()">Сохранить в HTML</a>
                    <a class="btn" href="#">Печать</a>
                </div>

            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="/js/app/accounts-browse.bundle.js"></script>
    <script>
        var menuItemId = 'accounts_browse';
    </script>
@endsection