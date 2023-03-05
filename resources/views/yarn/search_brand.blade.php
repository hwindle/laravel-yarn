@extends('layouts.app')

@section('content')
  <div class="row justify-content-center">
    <form method="get" action="{{ route('yarn.search_brand') }}" class="col-md-8">
      @csrf
      <p class="form-group">
        <label for="brand_name">Brand </label>
        <input class="y-form" type="text"
        name="brand_name" id="brand_name" required />
      </p>
      <p class="form-group">
        <input name="add" type="submit" class="y-btn-xlarge" value="Search for brand" />
      </p>
    </form>
  </div>
  <div id="brands_list" class="row">
    <ul class="brands_results">
      @foreach($results as $result)
      <li>
        <span class="brand_name">{{ $result->brand_name }}</span>
        <button class="y-btn-large float-right">
          <a href="{{ route('yarn.add_yarn', $result->brand_id) }}">
            Add Yarn
          </a>
        </button>
      </li>
      @endforeach
    </ul>
  </div>

@endsection
