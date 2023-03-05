@extends('layouts.app')

@section('content')
  <div class="row justify-content-center">
    <form method="post" action="{{ route('yarn.update_yarn', $yarn->yarn_id) }}"
    class="col-md-8">
      {{ csrf_field() }}
      @method('PUT')

      <p class="form-group row">

        <span class="brand col-xs-12 col-lg-6">{{ $brands->brand_name }}</span>
        <label for="yarn_name" class="col-xs-4 col-lg-2">Yarn Name</label>
        <select name="yarn_name_id" id="yarn_name" class="y-form col-xs-8 col-lg-4"
        placeholder="Yarn Name">
          @foreach($yarn_names as $yarn_name)
            <option value="{{ $yarn_name->yarn_name_id }}">
            {{ $yarn_name->yarn_name }}</option>
          @endforeach
        </select>
      </p>
      <p class="form-group row">
        <label for="weights_id" class="col-xs-4 col-lg-2">Weight &amp; Gauge</label>
        <select name="weights_id" id="weights_id" class="y-form col-xs-8 col-lg-4">
          @foreach($yarn_weights as $yarn_weight)
            <option value="{{ $yarn_weight->yarn_weight_id }}">
            {{ $yarn_weight->weight }}</option>
          @endforeach
        </select>
        <label for="fibres_id" class="col-xs-4 col-lg-2">Fibres</label>
        <select name="fibres_id" id="fibres_id" class="y-form col-xs-8 col-lg-4">
          @foreach($fibres as $fibre)
            <option value="{{ $fibre->fibre_id }}">
            {{ $fibre->fibre }}</option>
          @endforeach
        </select>
      </p>
      <p class="form-group row">
        <label for="put_up" class="col-xs-4 col-lg-2">Put Up</label>
        <select name="put_up_id" id="put_up" class="y-form col-xs-8 col-lg-3">
          @foreach($put_ups as $put_up)
            <option value="{{ $put_up->put_up_id }}">
            {{ $put_up->name }}</option>
          @endforeach
        </select>
        <label for="ball_weight" class="col-xs-4 col-lg-2">Ball Weight </label>
        <input class="y-form col-xs-8 col-lg-4" type="number"
          name="ball_weight" id="ball_weight" value="{{ $yarn->ball_weight }}" />
      </p><p class="form-group row">
        <span class="col-xs-12 col-lg-6">Metres per 100g: 
          <span class="javascript-grist"></span>
        </span>
        <label for="metres_per_ball" class="col-xs-4 col-lg-2">
        Metres in Ball</label>
        <input class="y-form col-xs-8 col-lg-4" type="number"
          name="metres_per_ball" id="metres_per_ball" value="{{ $yarn->metres_per_ball }}" />
      </p>
      <p class="form-group">
        <label class="col-xs-4 col-lg-2" for="price">Price GBP </label>
        <input class="y-form col-xs-8 col-lg-4" type="text" name="price_gbp" id="price"
          value="{{ $yarn->price_gbp }}" />
        <label for="handspun" class="col-xs-8 col-lg-4">Handspun</label>
        <input class="y-form col-xs-4 col-lg-2" type="checkbox" 
        name="handspun" id="handspun"
            checked="{{ isset($yarn->handspun) ? 'checked' : '' }}"  />
      </p>
      <p class="form-group row">
        <label for="notes">Notes</label>
        <textarea name="notes" id="notes" class="y-form">
            {{ $yarn->notes }}
        </textarea>
      </p>
      <p class="form-group">
        <input class="y-btn-xlarge"
          name="update" type="submit" value="Update" />
      </p>
    </form>
  </div>
@endsection
