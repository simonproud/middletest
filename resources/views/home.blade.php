@extends('layouts.app')

@section('content')

        <!-- BEGIN search-results -->
        <div id="search-results" class="section-container bg-silver">
            <!-- BEGIN container -->
            <div class="container">
                <!-- BEGIN search-container -->
                <div class="search-container">
                    <!-- BEGIN search-content -->
                    <div class="search-content">
                        <!-- BEGIN search-toolbar -->
                        <div class="search-toolbar">
                            <!-- BEGIN row -->
                            <div class="row">
                                <div class="col-md-6">
                                    <h4>We found 65 Items for "Apple Product"</h4>
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
                            @foreach($productsar['data'] as $product)
                            <? $i++; ?>

                                <!-- BEGIN item -->
                                <div class="item item-thumbnail">
                                    <a href="product-detail.html" class="item-image">
                                        <img src="{{$product['image']}}" alt="" />
                                    </a>
                                    <div class="item-info">
                                        <h4 class="item-title">
                                            <a href="/product/{{$product['id']}}">{{$product['title']}}</a>
                                        </h4>
                                        <p class="item-desc">3D Touch. 12MP photos. 4K video.</p>
                                        <div class="item-price">${{$product['price']}}</div>
                                    </div>
                                </div>
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
                        <!-- BEGIN pagination -->
                        <div class="text-center">
                            <ul class="pagination m-t-0">
                                <li class="disabled"><a href="javascript:;">Previous</a></li>
                                <li class="active"><a href="javascript:;">1</a></li>
                                <li><a href="javascript:;">2</a></li>
                                <li><a href="javascript:;">3</a></li>
                                <li><a href="javascript:;">4</a></li>
                                <li><a href="javascript:;">5</a></li>
                                <li><a href="javascript:;">Next</a></li>
                            </ul>
                        </div>
                        <!-- END pagination -->
                    </div>
                    <!-- END search-content -->
                    @include('sidebar')

                </div>
                <!-- END search-container -->
            </div>
            <!-- END container -->
        </div>
        <!-- END search-results -->
<!-- BEGIN #trending-items -->
        <div id="trending-items" class="section-container bg-silver">
            <!-- BEGIN container -->
            <div class="container">
                <!-- BEGIN section-title -->
                <h4 class="section-title clearfix">
                    Популярные товары
                    <small>Покупайте наиболее популярные товары по привликательным ценам!</small>
                </h4>
                <!-- END section-title -->

                <!-- BEGIN row -->
                <div class="row row-space-10">
                    <!-- BEGIN col-2 -->
                    <?php $i = 0; ?>
                    @foreach($items as $k=>$item)
                    <?php $i++; ?>
                    <div class="col-md-3 col-sm-4">

                        <!-- BEGIN item -->
                        <div class="item item-thumbnail">
                            <a href="product_detail.html" class="item-image">
                                <img src="{{$item['product']['image']}}" alt="" />

                            </a>
                            <div class="item-info">
                                <h4 class="item-title">
                                    <a href="product_detail.html">{{$item['product']['title']}}</a>
                                </h4>
                                <p class="item-desc">{{$item['product']['description']}}</p>
                                <div class="item-price">${{$item['price']}}</div>

                            </div>
                        </div>
                        <!-- END item -->

                    </div>
                    <!-- END col-2 -->
                    <?php if($i >= 4){ ?>
                    <?php $i = 0; ?>
                     </div><br/><div class="row row-space-10">
                    <?php } ?>
                    @endforeach
                </div>
                <!-- END row -->

            </div>
            <!-- END container -->
        </div>
        <!-- END #trending-items -->
@endsection
