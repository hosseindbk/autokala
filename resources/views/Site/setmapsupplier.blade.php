<!DOCTYPE html>
<html dir="rtl">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />

    <title>موقعیت مکانی فروشگاه</title>
    <link rel="stylesheet" href="{{asset('site/css/vendor/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('site/css/vendor/materialdesignicons.css')}}">
    <link rel="stylesheet" href="{{asset('site/css/vendor/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('site/css/main.css')}}">
    <link rel="stylesheet" href="https://cdn.map.ir/web-sdk/1.4.2/css/mapp.min.css">
    <link rel="stylesheet" href="https://cdn.map.ir/web-sdk/1.4.2/css/fa/style.css">
    <style>
        #app {
            width: 100%;
            height: 100%;
        }
        input {
            text-align: right;
            direction: rtl;
            border: 0;
            margin: 10px;
        }
        textarea:focus,
        input:focus {
            outline: none;
        }
        .search-box {
            position: absolute;
            top: 5px;
            right: 5px;
            z-index: 1000;
            min-width: 250px;
            max-width: 300px;
        }
        .search-box__item {
            background-color: white;
            margin-top: 3px;
            border-top: none;
            border: 1px solid #a8a7a7;
            border-radius: 5px;
        }
        .search-results {
            overflow: auto;
            max-height: 40vh;
            display: none;
        }
        .search-result-item {
            border-bottom: 1px solid #ccc;
            padding: 10px;
            cursor: pointer;
        }
        .search-result-item img {
            width: 20px;
            margin-left: 5px;
        }
        .search-result-item-title {
            font-weight: bolder;
        }
        .search-result-item-address {
            font-size: 1rem;
        }
        .clear-seach {
            cursor: pointer;
            position: absolute;
            left: 40px;
            padding: 10px;
            display: none;
        }
        .btn-seach {
            background-color: #ff0871;
            height: 45px;
            width: 40px;
            text-align: center;
            border-top-left-radius: 5px;
            border-bottom-left-radius: 5px;
            color: white;
            cursor: pointer;
            position: absolute;
            left: 1px;
            justify-content: center;
            align-items: center;
            padding: 10px;
            border-right: 1px solid #a8a7a7;
        }
        .flex-row {
            display: flex;
            flex-direction: row;
        }
    </style>
</head>
<body>
<div class="container-main">
    <div class="d-block">
        <section class="profile-home">
            <div class="col-lg">
                <div class="post-item-profile order-1 d-block">
                    <div class="main-content side-content pt-0">
                        <div class="container-fluid">
                            <div class="inner-body">
                                <div class="row row-sm">
                                    <div class="col-lg-12 col-md-12">
                                        <div class="card custom-card">
                                            <div class="card-body">
                                                <div class="row row-sm">
                                                    @foreach($suppliers as $supplier)
                                                        <div class="col-md-12">
                                                            <h3 class="text-center"> فروشگاه  {{$supplier->title}} </h3>
                                                            <p class="mt-4"> آدرس : {{$supplier->address}}</p>
                                                        </div>
                                                    @endforeach
                                                </div>
                                                <div class="row row-sm">
                                                    <div class="container search-box">
                                                        <div class="container search-box__item  flex-row">
                                                            <input autocomplete="off" type="text" id="search" placeholder="دنبال کجا می&zwnj;گردید..." /><span class="clear-seach">&#10006;</span>
                                                            <div class="btn-seach">
                                                                <span>برو</span>
                                                            </div>
                                                        </div>
                                                        <div class="container search-box__item search-results">
                                                            <div class="search-result-item"></div>
                                                        </div>
                                                    </div>
                                                    <div id="app" style="width: 100%; height: 500px;"></div>
                                                    <div class="col-md-12 text-center">
                                                        <p class="mt-4">بعد از انتخاب موقعیت مکانی فروشگاه خود بر روی دکمه ثبت کلیک نمایید</p>
                                                        <a  href="{{route('profile-business')}}" class="btn btn-success "> ثبت اطلاعات</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
</body>
<script src="{{asset('admin/assets/plugins/jquery/jquery.min.js')}}"></script>
<script src="{{asset('admin/assets/plugins/bootstrap/js/popper.min.js')}}"></script>
<script src="{{asset('admin/assets/plugins/bootstrap/js/bootstrap-rtl.js')}}"></script>
<script type="text/javascript" src="https://cdn.map.ir/web-sdk/1.4.2/js/mapp.env.js"></script>
<script type="text/javascript" src="https://cdn.map.ir/web-sdk/1.4.2/js/mapp.min.js"></script>

<script>
    var crosshairIcon = {
        iconUrl: '{{asset('site/images/icon_map.png')}}',
        iconSize:     [40, 50], // size of the icon
        iconAnchor:   [20, 55], // point of the icon which will correspond to marker's location
    };
    $(document).ready(function() {
        //create map and layers
        var app = new Mapp({
            element: '#app',
            presets: {
                @foreach($suppliers as $supplier)
                    @if($supplier->lat != '' && $supplier->lng != '')
                latlng: {
                    lat: {{$supplier->lat}},
                    lng: {{$supplier->lng}},

                },
                @else
                latlng: {
                    lat: 35.73249,
                    lng: 51.42268
                },
                @endif
                    @endforeach
                zoom: 14,
                icon: crosshairIcon,
            },
            apiKey: "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjI0OTE4ZjYzNjQ0ZmUxNTNjMWNiY2Y1NzcyNTJlOTkzNGNkZWZhMmQyM2ZhZjBjMzdkOWViNmUzZDgyYjJmMGQ4ZjU1MDY1ZjgyY2EyNWE2In0.eyJhdWQiOiIxNTQ5NCIsImp0aSI6IjI0OTE4ZjYzNjQ0ZmUxNTNjMWNiY2Y1NzcyNTJlOTkzNGNkZWZhMmQyM2ZhZjBjMzdkOWViNmUzZDgyYjJmMGQ4ZjU1MDY1ZjgyY2EyNWE2IiwiaWF0IjoxNjMxNzc5MjQ0LCJuYmYiOjE2MzE3NzkyNDQsImV4cCI6MTYzNDQ2MTI0NCwic3ViIjoiIiwic2NvcGVzIjpbImJhc2ljIl19.VsRI2wiG_IvFVkVKXt_XnOBpzyjMIygnv6s_s81u9WVC_Z-stANinKYH_6iJPuJ3lRdAX8SdtHwYCr2DZVF2hi6WiTu-BSvMuXPb6sg0iYXgYREKQjzsWU4NPf2kOwd4q6aj1R6UOT_EA7GIrJQ5FPYDceAmeT8va1VdK6xYp-Ypstja-clURippQKEk0mDe9Z_ABYWQNAWfqUt_ubYEZrETjnDoSQHbJxJc46vxWvYmwoK1sIZ4NoXaQbRrAb0QKZ_7Lnh3H3_vHqQGMB0vJELzwSJEmiNxr_h7uIvugtRAUneAa878lOJuv03976YNjIoepK_aWhxzrP-RmE4O5A",
        });
        app.addLayers();
        app.addZoomControls();
        app.addGeolocation({
            history: true,
            onLoad: false,
            onLoadCallback: function(){
                console.log(app.states.user.latlng);
            },
        });

        app.map.on('click', function (e) {

            var marker = app.addMarker({
                name: 'advanced-marker',
                latlng: {
                    lat: e.latlng.lat,
                    lng: e.latlng.lng,
                },
                icon: crosshairIcon,
                popup: {
                    title: {
                        i18n: 'موقعیت مکانی',
                    },
                    description: {
                        i18n: 'توضیحات',
                    },
                    class: 'marker-class',
                    open: false,
                },
            });
            $.ajax({
                url: '{{ route( 'suppliermap' ) }}',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    "_token": "{{ csrf_token() }}",
                    lat     : e.latlng.lat,
                    lng     : e.latlng.lng,
                    'address': e.address,
                    'id'    :{{$id}},
                },
                type: 'patch',
                dataType: 'json',
            }).done(function (data) {
                console.log(data);
            });
        })
        app.addVectorLayers();

        var drawnMarker = new L.LayerGroup();

        app.map.addLayer(drawnMarker);

        //search object
        const search = {
            params: {
                text: null
            },
            search: function(options, calback) {
                if (options.text === null || options.text === '') {
                    return null;
                }
                //prepare data
                const data = {};
                for (let key in options) {
                    if (options[key] !== null && options[key] !== '') {
                        data[key] = options[key];
                    }
                }
                calback(null); ///show results
                $.ajax({
                    url: `https://map.ir/search/v2/`,
                    data: JSON.stringify(data),
                    method: 'POST',
                    beforeSend: function(request) {
                        request.setRequestHeader('x-api-key', "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjI0OTE4ZjYzNjQ0ZmUxNTNjMWNiY2Y1NzcyNTJlOTkzNGNkZWZhMmQyM2ZhZjBjMzdkOWViNmUzZDgyYjJmMGQ4ZjU1MDY1ZjgyY2EyNWE2In0.eyJhdWQiOiIxNTQ5NCIsImp0aSI6IjI0OTE4ZjYzNjQ0ZmUxNTNjMWNiY2Y1NzcyNTJlOTkzNGNkZWZhMmQyM2ZhZjBjMzdkOWViNmUzZDgyYjJmMGQ4ZjU1MDY1ZjgyY2EyNWE2IiwiaWF0IjoxNjMxNzc5MjQ0LCJuYmYiOjE2MzE3NzkyNDQsImV4cCI6MTYzNDQ2MTI0NCwic3ViIjoiIiwic2NvcGVzIjpbImJhc2ljIl19.VsRI2wiG_IvFVkVKXt_XnOBpzyjMIygnv6s_s81u9WVC_Z-stANinKYH_6iJPuJ3lRdAX8SdtHwYCr2DZVF2hi6WiTu-BSvMuXPb6sg0iYXgYREKQjzsWU4NPf2kOwd4q6aj1R6UOT_EA7GIrJQ5FPYDceAmeT8va1VdK6xYp-Ypstja-clURippQKEk0mDe9Z_ABYWQNAWfqUt_ubYEZrETjnDoSQHbJxJc46vxWvYmwoK1sIZ4NoXaQbRrAb0QKZ_7Lnh3H3_vHqQGMB0vJELzwSJEmiNxr_h7uIvugtRAUneAa878lOJuv03976YNjIoepK_aWhxzrP-RmE4O5A");
                        request.setRequestHeader('content-type', 'application/json');
                    },
                    success: function(data, status) {
                        calback(data); ///show results
                    },
                    error: function(error) {
                        calback({ 'odata.count': 0, value: [] }); /// show results
                    }
                });
            },
            setParams: function(key, value, onUpdate, calback) {
                this.params[key] = value;
                if (onUpdate) {
                    this.search(this.params, calback);
                }
            }
        };

        function showResults(results) {
            if (results === null) {
                $('.search-results').text('در حال جستجو...');
                $('.search-results').show();
            } else {
                let count = results['odata.count'];
                if (count > 0) {
                    $('.clear-seach').show();
                    let html = '';
                    results['value'].forEach(function(item, index) {
                        html += `<div data-title="${item.title}" data-address="${
                            item.address
                        }" data-lat="${item.geom.coordinates[1]}" data-lon="${
                            item.geom.coordinates[0]
                        }" class="search-result-item">`;
                        html += `<p class="search-result-item-title"><img src="https://map.ir/css/images/marker-default-white.svg"/>${
                            item.title
                        }</p>`;
                        html += `<p class="search-result-item-address">${item.address}</p>`;
                        html += `</div>`;
                    });
                    //show results
                    $('.search-results').html(html);
                    $('.search-result-item').on('click', function(e) {
                        let lat = e.currentTarget.getAttribute('data-lat');
                        let lng = e.currentTarget.getAttribute('data-lon');
                        let title = e.currentTarget.getAttribute('data-title');
                        let address = e.currentTarget.getAttribute('data-address');
                        app.addMarker({
                            name: 'basic-marker',
                            latlng: {
                                lat,
                                lng
                            },
                            popup: {
                                title: {
                                    html: title
                                },
                                description: {
                                    html: address
                                },
                                open: true
                            }
                        });
                        app.map.flyTo({
                            lat,
                            lng
                        });
                    });
                    $('.search-results').show();
                } else {
                    $('.clear-seach').show();
                    $('.search-results').html('<p>نتیجه ای یافت نشد</p>');
                }
            }
        }

        //clear search
        $('.clear-seach').click(function() {
            search.params = {
                text: null
            };

            $('.search-results').html('');
            $('.search-results').hide();
            $('.clear-seach').hide();
            $('input#search').val('');
            $('.leaflet-container').css('cursor', '');

            if (app.groups.features !== undefined) {
                app.removeMarkers({
                    group: app.groups.features.markers
                });
            }
            drawnMarker.clearLayers();
        });

        //text change event handling
        $('#search').on('keyup paste', function(e) {
            let text = $('input#search').val();
            if (text.length > 1) {
                search.setParams('text', text, true, showResults);
            }
        });
    });</script>

