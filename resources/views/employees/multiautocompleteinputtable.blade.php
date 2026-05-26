@extends('master')
@section('title') Mulit AutoCompleted Table Input @endsection
@section('css')
    <style type="text/css">
       
    </style>    
@endsection
@section('content')
<table class="table table-bordered">
    <tr>
        <td>1</td>
        <td>
            <input list="ice-cream-flavors" id="ice-cream-choice1" name="ice-cream-choice1">
        </td>
        <td>125$</td>
    </tr>
    <tr>
        <td>2</td>
        <td>
            <input list="ice-cream-flavors" id="ice-cream-choice2" name="ice-cream-choice2">
        </td>
        <td>125$</td>
    </tr>
    <tr>
        <td>3</td>
        <td>
            <input list="ice-cream-flavors" id="ice-cream-choice3" name="ice-cream-choice3">
        </td>
        <td>125$</td>
    </tr>
</table>


<datalist id="ice-cream-flavors">
    <option value="Chocolate">
    <option value="Coconut">
    <option value="Mint">
    <option value="Strawberry">
    <option value="Vanilla">
</datalist>
@endsection
