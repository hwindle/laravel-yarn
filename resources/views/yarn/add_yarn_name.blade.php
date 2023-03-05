@extends('layouts.app')

@section('content')
  <div class="justify-content-center">
    <h3>Add Yarn Name</h3>
    <p>This is the name that links to the brand, so you would select a brand, e.g.
      'Stylecraft' then you would type in the yarn name, e.g. 'Batik'. </p>
    <form method="post" action="{{ route('yarn.store_yarn_name') }}" class="">
      @csrf
      <p class="form-group row">
        <label for="brand_id" class="col-xs-12 col-sm-6">Brand</label>
          <select name="brand_id" id="brand_id" class="y-form col-xs-12 col-sm-6">
            @foreach($brands as $brand)
              <option value="{{ $brand->brand_id }}">
              {{ $brand->brand_name }}</option>
            @endforeach
          </select>
      </p><p class="form-group row">
        <label for="yarn_name" class="col-xs-12 col-sm-6">Yarn Name</label>
        <input class="y-form col-xs-12 col-sm-6" type="text" name="yarn_name"
        id="yarn_name" required />
      </p>

      <p class="form-group row">
        <input class="y-btn-xlarge col-xs-12 col-lg-4 offset-lg-8"
        name="add" type="submit" value="Create Yarn Name" />
      </p>
    </form>
  </div>
@endsection
