<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Requests\CreateBrandRequest;
use App\Http\Requests\CreateFibreRequest;
use App\Http\Requests\CreateYarnNameRequest;
use App\Http\Requests\CreateYarnRequest;
use App\Brand;
use App\Fibre;
use App\YarnName;
use App\PutUp;
use App\YarnWeight;
use App\Yarn;

class YarnController extends Controller
{
  /****
  * adding a brand is the 1st bit of data to
  * be entered for a new yarn. Needs the brand
  * model to populate the select box.
   *********/
  public function add_brand()  {
    return view('yarn.add_brand')->with('brands', Brand::all());
  }

  /**************************************
  * In brand_store website can be null.
  * Creates one brand e.g. Rowan yarn
  *
  **************************************/
  public function brand_store(CreateBrandRequest $request) {
    Brand::create([
      'brand_name' => $request->brand_name,
      'website' => $request->website
    ]);
    session()->flash('success', 'Yarn brand created');
    return redirect('/yarn');
  }

  /**************************************
  * Search for a brand in order to move
  * to adding a yarn for Rowan, e.g. Rowan Valley Tweed
  * Returns results, searches for partial strings e.g. row.
  * Case insensitive search.
  **************************************/
  public function search_brand(Request $request) {
    try {
      $keywords = $request->brand_name;
      $results = Brand::search($keywords)->get();
      return view('yarn.search_brand')->with('results', $results);
    } catch (exception $e) {
      session()->flash('success', $e);
    }
  }

  /************************
  *
  *
  * Adding fibre type.
  ***************************/
  public function add_fibre() {
    return view('yarn.add_fibre')->with('fibres', Fibre::all());
  }

  /**************************************
  * fibre field is the fibre type e.g. wool, cotton.
  *
  *
  **************************************/
  public function store_fibre(CreateFibreRequest $request) {
    Fibre::create([
      'fibre' => $request->fibre
    ]);

    session()->flash('success', 'Fibre type created');
    return redirect('/yarn');
  }

  /******************************************
  * brands model fills in select box,
  * the brand e.g. Rowan is selected
  * Then the yarn name e.g. Valley Tweed
  * is inputted.
  * Add yarn_name - second thing to fill in after brand.
  *******/
  public function add_yarn_name() {
    return view('yarn.add_yarn_name')->with('brands', Brand::all());
  }

  /**************************************
  * Both fields are required.
  *
  *
  **************************************/
  public function store_yarn_name(CreateYarnNameRequest $request) {
    YarnName::create([
      'brand_id' => $request->brand_id,
      'yarn_name' => $request->yarn_name
    ]);

    session()->flash('success', 'Yarn name created');
    return redirect('/yarn/add_yarn_name');
  }

  /*************************
  * Add yarn - lots of little tables connect to this one (for selects).
  * Fibres are sorted a-z because there are 100+ fibre types.
  *
  *****************/
  public function add_yarn($brand_id) {
    return view('yarn.add_yarn', ['brands'=>Brand::find($brand_id),
            'yarn_names'=>YarnName::where('brand_id', '=', $brand_id)->get(),
            'put_ups'=>PutUp::all(),
            'fibres'=>Fibre::all()->sortBy('fibre'),
            'yarn_weights'=>YarnWeight::all()
    ]);
  }

  /**************************************
  * Check this for MySQL injection vulnerabilities.
  * Notes can be null, put up means ball, hank, cone of yarn.
  * It is the yarn packaging.
  **************************************/
  public function store_yarn(CreateYarnRequest $request) {
    //changes 0, 1, 2, 3 to 0 or 1.
    $tinyHandspun = (int) filter_var($request->handspun, FILTER_VALIDATE_BOOLEAN);
    Yarn::create([
      'brand_id' => $request->brand_id,
      'yarn_name_id' => $request->yarn_name_id,
      'yarn_weight_id' => $request->weights_id,
      'fibres_id' => $request->fibres_id,
      'put_up_id' => $request->put_up_id,
      'ball_weight' => $request->ball_weight,
      'metres_per_ball' => $request->metres_per_ball,
      'price_gbp' => (float) $request->price, // casted to decimal
      'handspun' => $tinyHandspun,
      'notes' => $request->notes
    ]);

    //$something = 1; // don't know what this is?
    session()->flash('success', 'Yarn added to database.');
    return redirect('/yarn/search_brand');
  }

  /*************************
  * List all yarn - Lists brand, yarn name, weight, fibres,.
  * Leaves out the put up and notes columns.
  *
  * The joins are connecting the smaller tables to this table
  * e.g. fibres is many to one, yarn_name is one to one.
  * brand, weight and put up are many to one.
  *****************/
  public function list_all_yarn() {
    $yarns = DB::select('SELECT yarn_id, t2.yarn_name, t3.brand_name,
                 t4.fibre, t5.weight, metres_per_ball,
                ball_weight, price_gbp, handspun FROM yarns AS t1
                  INNER JOIN yarn_names t2 ON t1.yarn_name_id = t2.yarn_name_id
                  INNER JOIN brands t3 ON t1.brand_id = t3.brand_id
                  LEFT JOIN fibres t4 ON t1.fibres_id = t4.fibre_id
                  LEFT JOIN yarn_weights t5 ON t1.yarn_weight_id = t5.yarn_weight_id
                  ORDER BY brand_name');

    return view('yarn.list_all_yarn')->with('yarns', $yarns);
  }

  /*******************************
  *
  * Edit yarn - for displaying the form only
  * finds yarn names belonging to Rowan, fetches
  * only Rowan yarn names, e.g. Felted Tweed, Summerlite.
  **********/
  public function edit($yarn_id) {
    $yarn = DB::table('yarns')->where('yarn_id', $yarn_id)->first();
    //dd($yarn);
    return view('yarn.edit_yarn', ['brands'=>Brand::find($yarn->brand_id),
            'yarn_names'=>YarnName::where('brand_id', '=', $yarn->brand_id)->get(),
            'put_ups'=>PutUp::all(),
            'fibres'=>Fibre::all()->sortBy('fibre'),
            'yarn_weights'=>YarnWeight::all()])->with('yarn', $yarn);
  }

  /***********************************
  * Update yarn: performs a put request into the yarn table.
  * Can't change the yarn brand. Hank refers to one ball of yarn.
  *
  * Could redirect this to search_yarn view.
  **************/
  public function update(Request $request, $yarn_id) {
    $hank = Yarn::find($yarn_id);
    $hank->yarn_name_id = $request->yarn_name_id;
    $hank->put_up_id = $request->put_up_id;
    $hank->yarn_weight_id = $request->weights_id;
    $hank->notes = $request->notes;
    $hank->handspun = $request->handspun;
    $hank->fibres_id = $request->fibres_id;
    $hank->metres_per_ball = $request->metres_per_ball;
    $hank->price_gbp = $request->price_gbp;
    $hank->ball_weight = $request->ball_weight;

    $hank->save();
    session()->flash('success', 'Yarn updated');
    return redirect(route('yarn.list_all_yarn'));
  }

  // search yarn view only.
  public function search_yarn_form() {
    return view('yarn.search_yarn');
  }

  /*************************************************
  * search yarn: searches yarns based on brand/yarn name,
  * fibre type and weight.
  ******************/
  public function search_yarn(Request $request) {
    $firstSQL = 'SELECT yarn_id, t2.yarn_name, t3.brand_name,
                 t4.fibre, yarn_weight_id, metres_per_ball,
                ball_weight, price_gbp, handspun FROM yarns AS t1
                  INNER JOIN yarn_names t2 ON t1.yarn_name_id = t2.yarn_name_id
                  INNER JOIN brands t3 ON t1.brand_id = t3.brand_id
                  LEFT JOIN fibres t4 ON t1.fibres_id = t4.fibre_id';
      $dirtyBrand = $request->brand_name;
      $dirtyYarnName = $request->yarn_name;
      // if dirtyBrand, $dirtyYarnName are empty, null str. else: where clause
      if ($dirtyBrand == '') {
        // the start ofthe where's so I don't have to keep checking brand, and yarn_name
        $brandSQL = ' WHERE t1.brand_id BETWEEN 0 AND 36000';
      } else {
        // preg replace those.  Case insensitive search with LOWER
        $cleanBrand = preg_replace('/[^A-Za-z0-9 -]/', '', $dirtyBrand);
        $brandSQL = ' WHERE LOWER(t3.brand_name) LIKE LOWER("%' . $cleanBrand . '%")';
      }
      if ($dirtyYarnName == '') {
        $yarnNameSQL = '';
      } else {
        $cleanYarnName = preg_replace('/[^A-Za-z0-9 -]/', '', $dirtyYarnName);
        $yarnNameSQL = ' AND LOWER(t2.yarn_name) LIKE LOWER("%' . $cleanYarnName . '%")';
      }
      // if fibre = any - sql here, else. fibre options.
      $fibreType = $request->fibre_type;
      switch ($fibreType) {
        case 0:
          $fibreSQL = ' '; // all fibre types.
          break;
        case 1:
          // Wool
          $fibreSQL = ' AND fibres_id = 1';
          break;
        case 2:
          // Sock yarn
          $fibreSQL = ' AND fibres_id IN (46, 230, 163, 16, 83)';
          break;
        case 3:
          // some wool - could be a small amount
          $fibreSQL = ' AND t4.fibre LIKE "%wool%"';
          break;
        case 4:
          // some alpaca
          $fibreSQL = ' AND t4.fibre LIKE "%Alpaca%"';
          break;
        case 5:
          // Merino wool only
          $fibreSQL = ' AND fibres_id = 10';
          break;
        case 6:
          // any amount of Acrylic
          $fibreSQL = ' AND t4.fibre LIKE "%Acrylic%"';
          break;
        case 7:
          // any amount of Cotton
          $fibreSQL = ' AND t4.fibre LIKE "%Cotton%"';
          break;
        case 8:
          // 100% cotton.
          $fibreSQL = ' AND fibres_id IN (43, 8)';
          break;
        case 9:
          // any amount of itchy mohair.
          $fibreSQL = ' AND t4.fibre LIKE "%Mohair%"';
          break;
        case 10:
          // some cashmere
          $fibreSQL = ' AND t4.fibre LIKE "%Cashmere%"';
          break;
        case 11:
          // bamboo or modal (almost the same thing.)
          $fibreSQL = ' AND t4.fibre IN ("%Bamboo%", "%Modal%")';
          break;
        default:
          $fibreSQL = ''; // null string.
      }
      // gauges/yarn_weights search switch statement.
      $gauge = $request->gauge;
      switch ($gauge) {
        case 0:
          $gaugeSQL = '';
          break;
        case 1:
          $gaugeSQL = ' AND yarn_weight_id = 11';
          break;
        case 2:
          $gaugeSQL = ' AND yarn_weight_id IN (2, 3)';
          break;
        case 3:
          $gaugeSQL = ' AND yarn_weight_id IN (4, 5)';
          break;
        case 4:
          $gaugeSQL = ' AND yarn_weight_id = 6';
          break;
        case 5:
          // DK gauge
          $gaugeSQL = ' AND yarn_weight_id = 1';
          break;
        case 6:
          $gaugeSQL = ' AND yarn_weight_id = 8';
          break;
        case 7:
          $gaugeSQL = ' AND yarn_weight_id = 7';
          break;
        case 8:
          $gaugeSQL = ' AND yarn_weight_id = 9';
          break;
        case 9:
          $gaugeSQL = ' AND yarn_weight_id = 10';
          break;
        default:
          $gaugeSQL = '';
      }
      // exclude hanks if needs winding isn't selected.
      $winding = (int) filter_var($request->winding_radio, FILTER_VALIDATE_BOOLEAN);
      if ($winding == 0) {
        $noHanks = ' AND put_up_id != 2';
      } else {
        $noHanks = ' AND put_up_id = 2';
      }
      // exclude from notes, ribbon eyelash or tube yarns.
      // include fluffy ones. Write optional yarn construction table.
      $noFancy = (int) filter_var($request->no_fancy_yarns, FILTER_VALIDATE_BOOLEAN);
      if ($noFancy == 1) {
        $seventhSQL = ' ';
      } else {
        $seventhSQL = ' AND notes IN ("Ribbon yarn", "Tube yarn", "Eyelash yarn")';
      }
      // get price range.
      $pricePoint = $request->price_select;
      if ($pricePoint == 0) {
        $priceSQL = ' AND price_gbp BETWEEN 0.00 AND 5.00';
      } elseif ($pricePoint == 1) {
        $priceSQL = ' AND price_gbp BETWEEN 5.00 AND 11.00';
      } elseif ($pricePoint == 2) {
        $priceSQL = ' AND price_gbp BETWEEN 11.00 AND 1000.00';
      } else {
        $priceSQL = '';
      }
      // Order by price_gbp then by brand_id
      $wholeSQL = $firstSQL . $brandSQL . $yarnNameSQL . $fibreSQL . $gaugeSQL
      . $noHanks  . $seventhSQL . $priceSQL . ' ORDER BY price_gbp, t1.brand_id';
        // running the SQL statement.
        $results = DB::select($wholeSQL);
    return view('yarn.search_yarn')->with('results', $results);
  }

  /*************************
  * Yarn details - Shows the details for one ball of yarn.
  * Parameters are the yarn_id.
  * Returns $yarn, results for one yarn.
  *****************/
  public function details($yarn_id) {
    $yarn = Yarn::findOrFail($yarn_id);
    return view('yarn.details', ['yarn'=>$yarn,
          'brand'=>Brand::find($yarn->brand_id),
            'yarn_name'=>YarnName::find($yarn->yarn_name_id),
            'put_up'=>PutUp::find($yarn->put_up_id),
            'fibre'=>Fibre::find($yarn->fibres_id),
            'yarn_weight'=>YarnWeight::find($yarn->yarn_weight_id)
    ]);
  }

}
