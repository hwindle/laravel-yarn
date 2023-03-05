@extends('layouts.app')

@section('content')

  <div class="container card">
    <table class="striped-table">
    @foreach ($yarns as $yarn)
      <tr>
        <td class="yarn_link">
          <a href="{{ route('yarn.details', $yarn->yarn_id) }}">
            {{ $yarn->brand_name }} {{ $yarn->yarn_name }} -
            {{ $yarn->weight }} {{ $yarn->fibre }}
      	  </a>
        </td>
        <td>
  	       <a href="{{ route('yarn.edit_yarn', $yarn->yarn_id) }}">
	           <button type="button" class="btn btn-success">Edit</button>
	         </a>
        </td>
      </tr>
    @endforeach
    </table>
  </div>

@endsection
