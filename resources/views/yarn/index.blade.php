@extends('layouts.app')

@section('content')
  <ol>
    <li class="y-btn-xlarge"><a href="{{ route('yarn.search_yarn_form') }}">
      Search Yarn</a></li>
    <li class="y-btn-xlarge"><a href="{{ route('yarn.list_all_yarn') }}">
                    List all Yarn</a></li>

    <li class="y-btn-xlarge"><a href="{{ route('yarn.add_brand') }}">
          Add Brand</a></li>
    <li class="y-btn-xlarge"><a href="{{ route('yarn.add_yarn_name') }}">
          Add Yarn Name</a></li>
    <li class="y-btn-xlarge"><a href="{{ route('yarn.add_fibre') }}">
                 Add Fibre</a></li>
    <li class="y-btn-xlarge"><a href="{{ route('yarn.search_brand') }}">
        Add Yarn</a></li>
  </ol>
@endsection
