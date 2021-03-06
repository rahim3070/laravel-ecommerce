@extends('client.client_master')
@section('client_content')
<!-- page wapper-->
<div class="columns-container">
    <div class="container" id="columns">
        <!-- breadcrumb -->
        <div class="breadcrumb clearfix">
            <a class="home" href="#" title="Return to Home">Home</a>
            <span class="navigation-pipe">&nbsp;</span>
            <span class="navigation_page">Checkout</span>
        </div>
        <!-- ./breadcrumb -->
        <!-- page heading-->
        <h2 class="page-heading">
            <span class="page-heading-title2">Checkout</span>
        </h2>
        <!-- ../page heading-->
        <div class="page-content checkout-page">
            <h3 class="checkout-sep">Payment Information</h3>
            {!! Form::open(['url' => '/place-order','method'=>'post']) !!}
            <div class="box-border">
                <div class="row">
                    <div class="col-md-4"></div>
                    <div class="col-md-4">
                        <ul>
                            <li>
                                <label for="radio_button_5"><input type="radio" checked name="payment_type" value="cash_on_delivery" id="radio_button_5"> Cash on Delivery</label>
                            </li>
                            <li>
                                <label for="radio_button_6"><input type="radio" name="payment_type" value="paypal" id="radio_button_6"> Paypal</label>
                            </li>
                        </ul>
                        <button class="button">Continue</button>
                    </div>
                    <div class="col-md-4"></div>
                </div>                
            </div>
            {!! Form::close() !!}
            
            <h3 class="checkout-sep">Order Review</h3>
            <div class="box-border">
                <table class="table table-bordered table-responsive cart_summary">
                    <thead>
                        <tr>
                            <th class="cart_product">Product</th>
                            <th>Description</th>
                            <th>Avail.</th>
                            <th>Unit price</th>
                            <th>Qty</th>
                            <th>Total</th>
                            <th  class="action"><i class="fa fa-trash-o"></i></th>
                        </tr>
                    </thead>
                    <?php
                    // For read all data
                    $content = Cart::content();
                    ?>
                    <tbody>
                        @foreach($content as $v_content)
                        <tr>
                            <td class="cart_product">
                                <a href="#"><img src="{{URL::to($v_content->options['image'])}}" alt="Product"></a>
                            </td>
                            <td class="cart_description">
                                <p class="product-name"><a href="#">{{$v_content->name}}</a></p>
<!--                                <small class="cart_ref">SKU : #123654999</small><br>
                                <small><a href="#">Color : Beige</a></small><br>   
                                <small><a href="#">Size : S</a></small>-->
                            </td>
                            <td class="cart_avail"><span class="label label-success">In stock</span></td>
                            <td class="price"><span>BDT {{$v_content->price}}</span></td>
                            <td class="qty">
                                {!! Form::open(['url' => '/update-cart','method'=>'post']) !!}
                                <input class="form-control input-sm" type="text" name="qty" value="{{$v_content->qty}}">
                                <input class="form-control input-sm" type="hidden" name="row_id" value="{{$v_content->rowId}}">
                                <br/>
                                <button type="submit">
                                    <div class="button-group">
                                        <span class="btn btn-success">Update</span>
                                    </div>
                                </button>
                                {!! Form::close() !!}
                            </td>
                            <td class="price">
                                <span>BDT {{$v_content->qty * $v_content->price}}</span>
                            </td>
                            <td class="action">
                                <a href="{{URL::to('delete-from-cart/'.$v_content->rowId)}}">Delete item</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="2" rowspan="2"></td>
                            <td colspan="3">Total products (tax incl.)</td>
                            <td colspan="2">0.00</td>
                        </tr>
                        <tr>
                            <td colspan="3"><strong>Total</strong></td>
                            <td colspan="2"><strong>{{Cart::total()}}</strong></td>
                        </tr>
                    </tfoot>    
                </table>
                <button class="button pull-right">Place Order</button>
            </div>
        </div>
    </div>
</div>
<!-- ./page wapper-->
@endsection