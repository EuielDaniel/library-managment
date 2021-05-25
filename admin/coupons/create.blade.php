@extends('layouts.admin')
@section('title', __('Create Coupon') )
@section('content')

@if ($errors->any())
  @foreach($errors->all() as $error)
    <div class="alert alert-danger">
      {{$error}}
</div>
@endforeach
@endif

<h2 class="text-center"> {{__('Create Coupon')}} </h2>
<div class="mx-auto mt-5 mx-rtl" style="width: 500px;">
    <form action="{{ route('admin.coupons.store')}}" method="post">
        @csrf
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="name">{{__('Code')}}</label>
                <input type="text" class="form-control code @error('code') is-invalid @enderror" name="code"
                    value="{{ old('code') }}" id="code" placeholder="random code">
                @error('code')
                <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group col-md-6">
                <button type="submit" data-url="{{ route('admin.coupons.generate')}}" class="btn btn-outline-primary btn-sm generate-code">{{__('Generate')}}</button>
            </div>
        </div>

        <div class="form-group">
            <label for="type">{{__('Coupon Type')}}</label>
            <select id="type" name="type" class="custom-select @error('type') is-invalid @enderror">
                <option value=""> -- </option>
                <option value="fixed"> {{__('Fixed')}} </option>
                <option value="percentage"> {{__('Percentage')}} </option>
            </select>
            @error('type')
            <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group fixed" style="display: none">
            <label for="name">{{__('Value')}}</label>
            <input type="text" class="form-control @error('value') is-invalid @enderror" name="value"
                value="{{ old('value') }}" id="value" placeholder="value">
            @error('value')
            <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group percentage" style="display: none">
            <label for="name">{{__('Percent off')}} %</label>
            <input type="text" class="form-control @error('percent_off') is-invalid @enderror" name="percent_off"
                value="{{ old('percent_off') }}" id="percent_off" placeholder="percent off">
            @error('percent_off')
            <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
            <label for="name">{{__('Expired date')}}</label>
            <input type="date" class="form-control @error('expired_date') is-invalid @enderror" name="expired_date"
                value="{{ old('expired_date') }}" id="expired_date" placeholder="">
            @error('expired_date')
            <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>


        <button type="submit" class="btn btn-primary mt-4">{{__('Add')}}</button>
    </form>
</div>
@endsection

@section('js')
<link href="{{ asset('js/coupons.js') }}" rel="stylesheet">
@endsection
