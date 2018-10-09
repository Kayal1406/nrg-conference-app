@extends('layouts.master')
@section('content')
<section class="bc-product">
  <div class="container">
    <div class="row" >
      <div class="breadcrumb-width">
        <div class="col-sm-6">
          <ul class="bc-breadcrumb">
            <li><a href="/">Home</a>
            </li>
            <li class="active category"><a href="#">{{$name}}</a>
            </li>
          </ul>
        </div>
        <div class="col-sm-6">
          <div class="pull-right">
            <ul class="bc-Produc-mlist">
              <li>View:Sort :</li>
              <li><a href="#"> Popular</a>
              </li>
              <li><a href="#"> NewDiscount </a>
              </li>
              <li><a href="#">Price: LowHigh</a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <div class="row" >
      <div class="bc-Product-left hidden-sm hidden-xs">
        <div class="bc-categories-left">
          <span class="bc-expand-title">CATEGORIES</span>
          <a class="bc-expand">
          <div class="bc-expand-icon">[ - ]</div>
          </a>
          <div class="bc-detail-list">
            <ul class="bc-categories-list">
              @foreach($category_name as $m)
              <li><a href="{{url('/product/'.$m)}}"><i class="fa fa-caret-right" aria-hidden="true"></i> {{$m}}</a></li>
              @endforeach
            </ul>
          </div>
        </div>
        <div class="bc-categories-left">
        <div class="bc-mtb">
          <span class="bc-expand-title">New Arrival</span>
          <a class="bc-expand">
          <div class="bc-expand-icon">[ - ]</div>
          </a>
          <div class="bc-detail-list">
            <div class="checkbox checkbox-select"> 
              <input id="checkbox1" name="days" value="7" type="checkbox"  @if(old('days')) checked @endif/>
              <label for="checkbox1"> Last 07 days </label>
            </div>
            <div class="checkbox checkbox-select">
              <input value="15" name="days" id="checkbox2" type="checkbox"  @if(old('days')) checked @endif/>               
              <label for="checkbox2">Last 15 days </label>
            </div>
            <div class="checkbox checkbox-select">
              <input id="checkbox3" name="days" value="30" type="checkbox"  @if(old('days')) checked @endif/>
              <label for="checkbox3">Last 30 days </label>
            </div>
            <div class="checkbox checkbox-select">
              <input id="checkbox4" name="days" value="45" type="checkbox"  @if(old('days')) checked @endif/>
              <label for="checkbox4"> Last 45 days </label>
            </div>
          </div>
          </div>
        </div>
        <div class="bc-categories-left">
         <div class="bc-mtb">
          <span class="bc-expand-title">Price</span>
          <a class="bc-expand">
          <div class="bc-expand-icon">[ - ]</div>
          </a>
          <div class="bc-detail-list">
            <div class="bc-range-bar">
              <div class="bc-range-handle-left"></div>
              <div class="bc-range-handle-right"></div>
            </div>
            <div class="form-group bc-form-pric-sm">
              <select class="bc-select">
                <option value="Min">Min</option>
                <option value="200" >$200</option>
                <option value="500" >$500</option>
              </select>
            </div>
            <div class="form-group bc-input-group">
              <select class="bc-select">
                <option value="Min">Max</option>
                <option value="200" >$2000</option>
                <option value="5000" >$5000</option>
              </select>
            </div>
          </div>
          </div>
        </div>
        <div class="bc-categories-left">
         <div class="bc-mtb">
          <span class="bc-expand-title">Seller</span>
          <a class="bc-expand">
          <div class="bc-expand-icon">[ - ]</div>
          </a>
          <div class="bc-detail-list">
            <div class="checkbox checkbox-select">
              <input id="checkbox5" type="checkbox">
              <label for="checkbox5"> Seller - 1 </label>
            </div>
            <div class="checkbox checkbox-select">
              <input id="checkbox6" type="checkbox">
              <label for="checkbox6"> Seller - 2 </label>
            </div>
            <div class="checkbox checkbox-select">
              <input id="checkbox7" type="checkbox">
              <label for="checkbox7"> Seller - 3 </label>
            </div>
            <div class="checkbox checkbox-select">
              <input id="checkbox8" type="checkbox">
              <label for="checkbox8"> Seller - 4 </label>
            </div>
          </div>
        </div>
        </div>
      </div>
      <div class="bc-Product-right">
          @foreach($products as $product)
        <div class="bc-product-col">
          <div class="bc-product-list">
          <div class="bc-product-listimg">
            <img src="{{ asset($product->front_img) }}" alt="Women">
          </div>
          <div class="bc-actions">
            <a class=" bc-buy-line bc-view" href="#">View</a>
            <a class="bc-buy" href="/buy-now">Buy</a>
          </div>
          <span class="bc-brand-name">{{$product->name}}</span>
          <span class="bc-price">{{$product->price_per_unit}}</span>
          </div>
        </div>
          @endforeach
        <div class="text-right">
          <div class="page-nation">
            <ul class="pagination pagination-large">
              <li class="disabled"><span>Prev</span></li>
              <li class="active"><span>1</span></li>
              <li><a href="#">2</a>
              </li>
              <li><a href="#">3</a>
              </li>
              <li><a href="#">4</a>
              </li>
              <li class="disabled"><span>...</span></li>
              <li>
              <li><a rel="next" href="#">Next</a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<script>
$(document).ready(function () {
var categories = [];
    // Listen for 'change' event, so this triggers when the user clicks on the checkboxes labels
    $('input[name="days"]').on('change', function (e) {

        e.preventDefault();
        categories = []; // reset 

        $('input[name="days"]:checked').each(function()
        {
            var days = $(this).val();
            $.ajax({
              type: "get",
              url: '/getcreatedat',
              data: { 'days': days },
              success: function (data)
                  {
                    //console.log(data);  
                      var pageURL = $(location).attr("href");
                      window.location.href = pageURL+ '/' +data;
                  }
              });
        });
               

    });

});



// $("input[type='checkbox']").click(function() {
//   if ($(this).is(':checked')) {
//    var days = $(this).val();
//    $.ajax({
//         type: "get",
//         url: '/getcreatedat',
//         data: { 'days': days },
//         success: function (data)
//             {
//                 var pageURL = $(location).attr("href");
//                 window.location.href = pageURL+ '/' +data;
//             }
//         });
//     }
// });
</script>
@endsection