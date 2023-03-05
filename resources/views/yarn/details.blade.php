@extends('layouts.app')

@section('content')
  <div class="justify-content-center">
    <h3>{{ $brand->brand_name}} - {{ $yarn_name->yarn_name }}</h3>
    <section class="yarn_details">
      <p><strong>{{ $yarn_weight->weight }}</strong>, {{ $yarn->metres_per_ball }} metres
        to {{ $yarn->ball_weight }}g.</p>
      <p><strong>Fibres:</strong> {{ $fibre->fibre }}</p>
      <p><strong>Approximate price:</strong> £{{ $yarn->price_gbp }}
        {{ ($yarn->handspun == 1) ? 'Handspun' : '' }}
      </p>
      <!-- put putup name into CSS, to change background img of div to pencil
       drawing of hank, ball or roll, spool or cone -->
      <p><strong>Packaging: </strong> {{ $put_up->name }}</p>
      <p><strong>Construction:</strong> {{ $yarn->notes }}</p>
    </section>
  </div>
@endsection
