@extends('layouts.app')

@section('content-app')
<div class="container mt-4">
    <div class="card">
        <div class="card-body">
            <div>
                <h6 class="card-title mb-1">Single Select Style</h6>
                <p class="text-muted card-sub-title">First import a latest version of jquery in your page. Then the jquery.sumoselect.min.js and its css (sumoselect.css)</p>
            </div>
            <div class="mb-4">
                <p class="mg-b-10">Single Select</p>
                <select name="somename" class="form-control SlectBox" onclick="console.log($(this).val())" onchange="console.log('change is firing')">
                    <!--placeholder-->
                    <option title="Volvo is a car"  value="volvo">Volvo</option>
                    <option value="saab">Saab</option>
                    <option value="mercedes">Mercedes</option>
                    <option value="audi">Audi</option>
                </select>
            </div>
            <div class="mb-4">
                <p class="mg-b-10">Disabled Select</p>
                <select class="SlectBox form-control" disabled>
                    <option value="volvo">Volvo</option>
                    <option selected value="saab">Saab</option>
                    <option value="mercedes">Mercedes</option>
                    <option value="audi">Audi</option>
                    <option disabled value="opt1">option1</option>
                    <option value="opt2">option2</option>
                    <option value="opt3">option3</option>
                </select>
            </div>
            <div>
                <p class="mg-b-10">Inline Select</p>
                <select class="SlectBox form-control">
                    <option>selected</option>
                    <option>Volvo</option>
                    <option>Saab</option>
                    <option value="mercedes">Mercedes</option>
                    <option value="audi">Audi</option>
                    <option>Volvo</option>
                    <option>Saab</option>
                    <option value="mercedes">Mercedes</option>
                    <option value="audi">Audi</option>
                    <option>Volvo</option>
                    <option>Saab</option>
                    <option value="mercedes">Mercedes</option>
                    <option value="audi">Audi</option>
                    <option>Volvo</option>
                    <option>Saab</option>
                    <option value="mercedes">Mercedes</option>
                    <option value="audi">Audi</option>
                </select>
            </div>
        </div>
    </div>
</div>
@endsection
