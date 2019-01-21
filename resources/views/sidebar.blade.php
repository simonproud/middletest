<!-- BEGIN search-sidebar -->

                    <div class="search-sidebar">
                        <h4 class="title">Filter By</h4>
                        <form action="product.html" method="POST" name="filter_form">
                            <div class="form-group">
                                <label class="control-label">Keywords</label>
                                <input type="text" class="form-control input-sm" name="keyword" value="" placeholder="Enter Keywords" />
                            </div>
                            <div class="m-b-30">
                                <button type="submit" class="btn btn-sm btn-inverse"><i class="fa fa-search"></i> Filter</button>
                            </div>
                        </form>
                        <h4 class="title m-b-0">Categories</h4>
                        <ul class="search-category-list">
                        @if(Request::path() !== '/')
                         <li><a href="<?=(is_null($actcategory))?'/':'/catalog/'.$actcategory[0]['alias']?>">..</a></li>
                        @endif

                        @foreach($categories as $category)
                        <li><a href="/catalog/{{$category['alias']}}">{{$category['title']}}</a></li>
                        @endforeach
                        </ul>
                    </div>
                    <!-- END search-sidebar -->
