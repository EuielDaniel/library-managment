@extends('layouts.admin')
@section('title', __('Payout'))
@section('content')

@if($errors->any())
<h4>{{$errors->first()}}</h4>
@endif
@if (session()->has('alert.success'))
<div class="alert alert-success">
  {{session('alert.success')}}
</div>
@endif

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"> {{__('Your Earning')}} </h1>
    <div class="ml-auto">
      <a href="#" data-toggle="modal" data-target="#withdraw" class="btn btn-outline-info btn-sm"> {{__('Withdraw')}} </a>
    </div>
    </div>

    <div class="row">

      @if(Auth::user()->type == 'admin')

      <!-- Earnings (Monthly) Card Example -->
      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">{{__('Your Total earning from Commissions')}}</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800"> {{$amount['adminAmount']}} $</div>
              </div>
              <div class="col-auto">
                <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    @endif
      <!-- Earnings (Monthly) Card Example -->
      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">{{__('Your Total earning')}}</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">{{$amount['total']}} $</div>
              </div>
              <div class="col-auto">
                <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Earnings (Monthly) Card Example -->
      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">{{__('Your Total earning from courses')}}</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $amount['instAmount']}} $ </div>
              </div>
              <div class="col-auto">
                <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Pending Requests Card Example -->
      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1"> {{__('Current earning you can withdraw')}}</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">{{$amount['remain']}} $</div>
              </div>
              <div class="col-auto">
                <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    @if($payouts)
    <table class="table mt-3">
        <tr>
          <th width="400px">{{__('Course Name')}}</th>
          <th width="300px">{{__('No of sales')}}</th>
          <th>{{__('Total Price $')}}</th>
          <th>{{__('Total after commission $')}}</th>

          
        </tr>
        @foreach($payouts as $key => $payout)

        <tr class="item-row">
          <td>{{ $payout->title}}  </td>
          <td>{{$payout->sales }}</td>
          <td>{{$payout->sum_price }} </td>
          <td>{{$payout->priceAD }} </td>
        </tr>
        @endforeach
        <tr class="item-row" style="background-color: #eee">
          <td> {{__('Your Total earning from courses')}}  </td>
          <td></td>
          <td> </td>
          <td>{{ $amount['instAmount']}} $ </td>
        </tr>
      </table>

    
      @else 
      {{__('There is no payout yet')}}
     @endif

<!-- Modal for withdraw process-->
<div class="modal fade" id="withdraw" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">{{__('Withdraw')}} </h5>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      
      <div class="modal-body">
          <div class="form-group row">
              <label for="title" class="col-sm-2 col-form-label">{{__('Amount number')}}</label>
              <div class="col-sm-10">
                <input type="text" class="form-control amount" name="amount" value=""  placeholder="you can withraw {{$amount['remain']}} $ or less ">

              </div>
          </div>
          <div class="form-group row">
              <label for="title" class="col-sm-2 col-form-label">{{__('Paypal Email')}}</label>
              <div class="col-sm-10">
                <input type="email" class="form-control email" name="email" value=""  placeholder="Your valied paypal email">

              </div>
              
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('Close')}}</button>
        <a data-url="{{ route('admin.withdraw.payout')}}" class="btn btn-primary withdraw">{{__('Withdraw')}}</a>
      </div>
  
    </div>
  </div>
</div>


@endsection

@section('js')
<script src="{{ asset('js/payout.js') }}"></script>

@endsection