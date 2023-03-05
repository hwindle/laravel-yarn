@extends('layouts.app')

@section('content')
  <div class="justify-content-center">
    <h3>Add a Yarn Brand</h3>
    <form method="post" action="{{ route('yarn.brand_store') }}" class="">
      @csrf
      <p class="form-group row">
        <label class="col-sm-4" for="brand_name">Brand </label>
        <input type="text" class="y-form col-sm-8"
        name="brand_name" id="brand_name" required />
      </p>
      <p class="form-group row">
        <label class="col-sm-4" for="website">Website</label>
        <input type="text" name="website" class="y-form  col-sm-8"
        id="website" />
      </p>
      <p class="form-group row">
        <input name="add" type="submit" value="Add Brand"
        class="y-btn-xlarge col-xs-12 col-lg-4 offset-lg-8" />
      </p>
    </form>

  </div>
@endsection
