@extends('master')

@section('title','Edit Carousel')
@section('edit.carousel','active')

@section('content')
<style>
    .image-upload > input{
        display : none;
    }
</style>
<h5>List of Carousel Images</h5>
<hr>
<h5>Click the image to change the file</h5>
@if(count($imgs) > 0)
    @for($i = 0 ; $i < 4 ; $i++)
    <form action="{{ route('admin.caraousel.save') }}" method="post">
        <div class="image-upload">
        <label for="file-input">
            <img src="{{}}"/>
        </label>
        <input id="file-input" type="file" name="img[]"/>
    </form>
    </div>
    @endfor
@else

@endif
@endsection