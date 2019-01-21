@extends('layouts.app')

@section('content')
 <!-- BEGIN search-results -->
        <div id="search-results" class="section-container bg-silver">
            <!-- BEGIN container -->
            <div class="container">
                <!-- BEGIN search-container -->
                <div class="">
                    <!-- BEGIN search-content -->
                    <div class="search-content">
                        <!-- BEGIN search-toolbar -->
                        <div class="search-toolbar">
                            <!-- BEGIN row -->
                            <div class="row">
                                <!-- BEGIN col-6 -->
                                <div class="col-md-6">
                                    <h4>We found {{$itemsar['total']}} Items for "<?=(isset($_REQUEST['query']))?$_REQUEST['query']:'Any'?>"</h4>
                                </div>
                                <!-- END col-6 -->
                                <!-- BEGIN col-6 -->
                                <div class="col-md-6 text-right">
                                    <ul class="sort-list">
                                        <li class="text"><i class="fa fa-filter"></i> Sort by:</li>
                                        <li class="active"><a href="#">Popular</a></li>
                                        <li><a href="#">New Arrival</a></li>
                                        <li><a href="#">Discount</a></li>
                                        <li><a href="#">Price</a></li>
                                    </ul>
                                </div>
                                <!-- END col-6 -->
                            </div>
                            <!-- END row -->
                        </div>
                        <!-- END search-toolbar -->
                        <!-- BEGIN search-item-container -->
                        <div class="search-item-container">
                            <!-- BEGIN item-row -->
                            <div class="item-row">
                              <? $i = 0; ?>
                            @foreach($itemsar['data'] as $product)
                            <? $i++; ?>
                                <!-- BEGIN item -->
                                <div class="item item-thumbnail">
                                    <a href="product_detail.html" class="item-image">
                                        <img src="{{$product['image']}}" alt="" />
                                    </a>
                                    <div class="item-info">
                                        <h4 class="item-title">
                                            <a href="/product/{{$product['id']}}">{{$product['title']}}</a>
                                        </h4>
                                        <p class="item-desc">{{$product['description']}}</p>
                                        <div class="item-price">${{$product['price']}}</div>

                                    </div>
                                </div>
                                <!-- END item -->
                                @if($i >= 3)
                                    </div><div class="item-row">
                                    <? $i = 0;?>
                                @endif
                                <!-- END item -->
                               @endforeach
                            </div>
                            <!-- END item-row -->
                        </div>
                        <!-- END search-item-container -->
                        {{ $items->links() }}
                    </div>
                    <!-- END search-content -->
                </div>
                <!-- END search-container -->
            </div>
            <!-- END container -->
        </div>
        <!-- END search-results -->

@endsection
