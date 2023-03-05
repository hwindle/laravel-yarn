@extends('layouts.app')

@section('content')
  <div class="justify-content-center">
    <h3>Add New Fibre</h3>
    <form method="post" action="{{ route('yarn.store_fibre') }}" class="container">
      @csrf
      <p class="form-group row">
        <label class="col-xs-12 col-sm-4" for="fibre">Fibre</label>
        <input type="text" class="y-form col-xs-12 col-sm-8"
        name="fibre" id="fibre" required />
      </p>
      <p class="form-group row">
        <input name="add" type="submit" value="Add Fibre"
        class="y-btn-xlarge col-xs-12 col-lg-4 offset-lg-8" />
      </p>
    </form>

  </div>
@endsection
