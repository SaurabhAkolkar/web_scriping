@extends('layouts.dapp')


@section('content')
    <div class="col m-5">
        <form method="POST" action="{{ route('addmemberstore') }}" enctype='multipart/form-data'>
            @csrf
            <select class="form-select mt-5 mb-3" aria-label="Default select example" name="designation">
                <option selected>Select Order</option>
                <option value="1">संस्थापक</option>
                <option value="2">संस्थापक/अध्यक्ष</option>
                <option value="3">उपाध्यक्ष</option>
                <option value="4">व्यवस्थापक प्रमुख</option>
                <option value="5">सचिव</option>
                <option value="6">उपसचिव</option>
                <option value="7">कोषाध्यक्ष</option>

                <option value="8"> औरंगाबाद (मराठवाडा) विभाग प्रमुख </option>
                <option value="9"> औरंगाबाद जिल्हा प्रमुख </option>
                <option value="10"> जालना जिल्हा प्रमुख </option>
                <option value="11"> लातूर जिल्हा प्रमुख </option>
                <option value="12"> नांदेड जिल्हा प्रमुख </option>
                <option value="13"> हिंगोली जिल्हा प्रमुख </option>
                <option value="14"> परभणी जिल्हा प्रमुख </option>
                <option value="15"> उस्मानाबाद जिल्हा प्रमुख </option>
                <option value="16"> बीड जिल्हा प्रमुख </option>

                <option value="17">नागपूर (विदर्भ )विभाग प्रमुख </option>
                <option value="18"> नागपूर जिल्हा प्रमुख </option>
                <option value="19"> वर्धा जिल्हा प्रमुख </option>
                <option value="20"> भंडारा जिल्हा प्रमुख </option>
                <option value="21">गोंदिया जिल्हा प्रमुख </option>
                <option value="22"> चंद्रपूर जिल्हा प्रमुख </option>
                <option value="23"> गडचिरोली जिल्हा प्रमुख </option>

                <option value="24"> नाशिक (उत्तर महाराष्ट्र आणी खानदेश) विभाग प्रमुख </option>
                <option value="25"> नाशिक जिल्हा प्रमुख </option>
                <option value="26"> धुळे जिल्हा प्रमुख </option>
                <option value="27"> नंदुरबार जिल्हा प्रमुख </option>
                <option value="28"> जळगाव जिल्हा प्रमुख </option>
                <option value="29"> अहमदाबाद जिल्हा प्रमुख </option>

                <option value="30"> अमरावती (विदर्भ) विभाग प्रमुख </option>
                <option value="31"> अमरावती जिल्हा प्रमुख </option>
                <option value="32"> अकोला जिल्हा प्रमुख </option>
                <option value="33"> बुळढणा जिल्हा प्रमुख </option>
                <option value="34"> यवतमाळ जिल्हा प्रमुख </option>
                <option value="35"> वाशिम जिल्हा प्रमुख </option>

                <option value="36">पुणे (पश्चिम महाराष्ट्र) विभाग प्रमुख </option>
                <option value="37"> पुणे जिल्हा प्रमुख </option>
                <option value="38"> सातारा जिल्हा प्रमुख </option>
                <option value="39"> सांगली जिल्हा प्रमुख </option>
                <option value="40"> सोलापूर जिल्हा प्रमुख </option>
                <option value="41"> कोल्हापूर जिल्हा प्रमुख </option>

                <option value="42"> कोकण विभाग प्रमुख </option>
                <option value="43"> मुंबई शहर जिल्हा प्रमुख </option>
                <option value="44"> मुंबई उपनगर जिल्हा प्रमुख </option>
                <option value="45"> ठाणे जिल्हा प्रमुख </option>
                <option value="46"> पालघर जिल्हा प्रमुख </option>
                <option value="47"> रायगड जिल्हा प्रमुख </option>
                <option value="48"> रत्नागिरी जिल्हा प्रमुख </option>
                <option value="49"> सिंधुदुर्ग जिल्हा प्रमुख </option>
            </select>

            <div class="input-group mb-3">
                <input type="text" class="form-control" id="name" placeholder="Name" name="name">
            </div>

            <div class="input-group mb-3">
                <input type="file" class="form-control" id="image" placeholder="image" name="image">
            </div>

            <button type="submit" class="btn btn-primary float-end">Submit</button>
        </form>

    </div>
@endsection










@php
$avp = \App\Models\AddMember::where('designation', 9)->first();
@endphp


    <img class="lg:w-1/6 md:w-3/6 w-5/6 mb-2 object-cover object-center rounded" alt="hero"
        src="{{ asset('storage/members/' . $avp->image) }}">
    <h2 class="title-font font-medium text-lg text-gray-900 mb-2">{{ $avp->name }}</h2>
   


