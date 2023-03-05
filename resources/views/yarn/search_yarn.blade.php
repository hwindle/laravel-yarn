@extends('layouts.app')

@section('content')
  <div class="row justify-content-center">
    <form method="post" action="{{ route('yarn.search_yarn') }}" class="col-md-8">
      @csrf
      <p class="row">
        <label for="brand_name" class="col-xs-4 col-lg-2">Brand </label>
        <input type="text" name="brand_name" id="brand_name"
        class="y-form col-xs-8 col-lg-4" />
        <label for="yarn_name" class="col-xs-4 col-lg-2">Yarn Name</label>
        <input type="text" name="yarn_name" id="yarn_name"
        class="y-form col-xs-8 col-lg-4" />
      </p>
      <p class="row"><button id="btn-show-hidden"
        class="y-btn-xlarge">More Options...</button></p>
      <div class="form-group  hide" id="hidden-yarn-search">
        <p class="row">
          <!-- fibre types (broader types) -->
          <label for="fibre_type" class="col-xs-4 col-lg-2">Fibre</label>
          <select id="fibre_type" name="fibre_type" class="y-form col-xs-8 col-lg-4">
            <option value="0">Any</option>
            <option value="1">100% Wool</option>
            <option value="2">Sock yarn</option>
            <option value="3">Some Wool</option>
            <option value="4">Some Alpaca</option>
            <option value="5">100% Merino wool</option>
            <option value="6">Some Acrylic</option>
            <option value="7">Some Cotton</option>
            <option value="8">100% Cotton</option>
            <option value="9">Some Mohair</option>
            <option value="10">Some cashmere</option>
            <option value="11">Bamboo or modal</option>
          </select>
          <!-- suitable gauges (related to weight) -->
          <label for="gauge" class="col-xs-4 col-lg-2">Gauge</label>
          <select id="gauge" name="gauge" class="y-form col-xs-8 col-lg-4">
            <option value="0">Any</option>
            <option value="1">Search for fibre only</option>
            <option value="2">Lace: 9 - 15 stitches per inch</option>
            <option value="3">Light 4ply: 7-9 stitches per inch</option>
            <option value="4">4ply/sport: 6-7 stitches per inch</option>
            <option value="5">DK: 5-6 stiches per inch</option>
            <option value="6">Worsted: 4.5-5.5 stitches per inch</option>
            <option value="7">Aran: 4-5 stitches per inch</option>
            <option value="8">Chunky: 2-4 stitches per inch</option>
            <option value="9">Super Chunky: 0.5-2 stitches per inch</option>
          </select>
        </p>
        <p class="row">
          <!-- needs winding -->
          <label for="winding_radio">Needs Winding: </label>
          <input type="checkbox" class="y-form"
          name="winding_radio" id="winding_radio" />
          <!-- Ribbon or tube/fluffy yarns -->
          <label for="no_fancy_yarns">Exclude ribbon and eyelash/fancy yarns:
          </label>
          <input type="checkbox" id="no_fancy_yarns" name="no_fancy_yarns"
            class="y-form" checked/>
        </p>
        <p class="row">
          <!-- price per gram of yarn -->
          <label for="price_select">Price Range: </label>
          <select id="price_select" name="price_select" class="y-form">
            <option value="3">Any</option>
            <option value="0">Budget (£0.50 - £5 per ball)</option>
            <option value="1">Mid Range (£4.10 - £11 per ball)</option>
            <option value="2">Expensive (more than £11 per ball)</option>
          </select>
        </p>
      </div>
      <p class="submit-btn-row">
        <input name="search" type="submit" class="y-btn-xlarge" value="Search for yarn" />
      </p>
    </form>
    <div id="yarns_list" class="container">
      @if(isset($results))
      <table>
        <thead>
          <th>Brand</th>
          <th>Yarn Name</th>
          <th>Fibre</th>
          <th>Price</th>
          <th>Details</th>
        </thead>
        @foreach($results as $result)

            <tr>
              <td>{{ $result->brand_name }}</td>
              <td>{{ $result->yarn_name }}</td>
              <td>{{ $result->fibre }}</td>
              <td>{{ $result->price_gbp }}</td>
              <td>
                <a class="btn btn-info " href="{{ route('yarn.details', $result->yarn_id) }}">
                  Details
                </a>
              </td>
            </tr>
          </a>
        @endforeach
      </table>
      @endif
    </div>
  </div>
@endsection

@section('scripts')
<script type="text/javascript">
$(function(){

  $('#btn-show-hidden').on('click', function() {
    $('#hidden-yarn-search').removeClass('hide');
    $('#hidden-yarn-search').addClass('y-fancy-show');
    /* this was in an earlier duck website, it makes the
     div visible after the click event. */
    event.preventDefault();
  });

});
</script>
@endsection
