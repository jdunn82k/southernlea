@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <p class="mate-sc font-size-36 text-center mt-0 custom-header">Southern Lea Custom Order</p>
            </div>
        </div>
        <div class="first-pane">

            <div class="row">
                <div class="col-md-5 col-lg-5 col-sm-12">
                    <ul class="custom-list">
                        <li class="custom-listitem" id="custom-tees"><div class="link-block"></div> <span class="custom-link">Customs Tee's</span></li>
                        <li class="custom-listitem" id="custom-decal"><div class="link-block"></div> <span class="custom-link">Custom Decal</span></li>
                        <li class="custom-listitem" id="other"><div class="link-block"></div> <span class="custom-link">Other</span></li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="second-pane">

            <div class="custom-tees-pane hide">
                <div class="row">
                    <div class="col-md-5 col-lg-5 col-sm-12">
                        <ul class="custom-list">
                            <li class="custom-listitem custom-second-page-link" id="custom-tees-womens"><div class="link-block"></div> <span class="custom-link">Women's</span></li>
                            <li class="custom-listitem custom-second-page-link" id="custom-tees-men"><div class="link-block"></div> <span class="custom-link">Men's</span></li>
                            <li class="custom-listitem custom-second-page-link" id="custom-tees-youth"><div class="link-block"></div> <span class="custom-link">Youth</span></li>
                            <li class="custom-listitem custom-second-page-link" id="custom-tees-toddler"><div class="link-block"></div> <span class="custom-link">Toddler</span></li>
                            <li class="custom-listitem custom-second-page-link" id="custom-tees-infant"><div class="link-block"></div> <span class="custom-link">Infant</span></li>
                        </ul>
                    </div>
                </div>
            </div>

        </div>

        <div class="third-pane">
            <div class="custom-tshirt-selection hide">
                <div class="row">
                    <div class="col-md-5 col-lg-4 col-sm-12">
                        <div class="form-group">
                            <label>Size:</label>
                            <div class="flex-row hide mate-sc" id="size-swatches-non-infant">
                                <div class="size-swatch">S</div>
                                <div class="size-swatch">M</div>
                                <div class="size-swatch">L</div>
                                <div class="size-swatch">XL</div>
                                <div class="size-swatch">2X</div>
                            </div>
                            <div class="flex-row flex-wrap hide mate-sc" id="size-swatches-infant">
                                <div class="size-swatch-large">Newborn</div>
                                <div class="size-swatch-large">0-3m</div>
                                <div class="size-swatch-large">3-6m</div>
                                <div class="size-swatch-large">6-12m</div>
                                <div class="size-swatch-large">12-18m</div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="style-dropdown">Style:</label>
                            <select class="form-control" id="style-dropdown"></select>
                        </div>

                        <div class="form-group">
                            <label>Color:</label>
                            <div class="d-flex flex-row flex-wrap">
                                @foreach($custom_colors as $color)
                                    <div class="color-block" style="background-color: {{$color->name}}"></div>
                                @endforeach
                            </div>
                            <div class="dropdown mt-2 custom-dropdown-wrap">
                                <a class="custom-dropdown-toggle form-control color-dropdown d-flex flex-wrap" href="#" id="dropdownButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <div class="d-flex flex-wrap custom-dropdown-replace">
                                        <div class="dropdown-color-block" style="background-color: {{$custom_colors[0]->name}}"></div>
                                        <span class="ml-3">{{$custom_colors[0]->name}}</span>
                                    </div>
                                </a>
                                <div class="dropdown-menu custom-color-dropdown" aria-labelledby="dropdownButton">
                                    @foreach($custom_colors as $color)
                                        <div class="dropdown-item custom-dropdown-item dropdown-wrap d-flex flex-wrap">
                                            <div class="dropdown-color-block" style="background-color: {{$color->name}}"></div>
                                            <span class="ml-3">{{$color->name}}</span>
                                        </div>
                                        <div class="dropdown-divider"></div>
                                    @endforeach
                                </div>
                            </div>

                        </div>

                        <div class="form-group">
                            {{--<div class="upload-placeholder"></div>--}}
                            <button>Upload Sample Image</button>
                        </div>
                    </div>
                    <div class="col-md-4 col-lg-4 col-sm-12">
                        <div class="example-photo"></div>
                    </div>
                    <div class="col-md-3 col-lg-4 col-sm-12">
                        <div class="form-group">
                            <label for="addt-comments">Additional Comments:</label>
                            <textarea class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <button>Next</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="custom-decals-pane hide">

            </div>

            <div class="custom-other-pane hide">

            </div>
        </div>
    </div>
@endsection