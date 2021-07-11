<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Company Name</title>
    <!-- 
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">


        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style> -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" />

</head>

<body>
    {{ view('nbar',  ['baseUrl' => env('BASE_URL')]) }}

    <div>
        <div>
            <div style="display: flex; flex-direction:column; justify-content: center; align-items:center; height:85vh ; background-image:  url('assets/company.png'); background-size: cover; ">
                <div>
                    <h1><strong>Welcome to Company A!</strong> </h1>
                </div>

                <div class="m-5">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                </div>
            </div>

            <!-- <img width="100%" src="assets/company.jpeg" style="opacity:0.5;z-index:0" /> -->
        </div>


        <div class="m-3">
            <div class="d-flex justify-content-center my-5">
                <h5><strong>Our Products</strong></h5>
            </div>

            <div class="d-flex justify-content-around">
                <div>
                    <div>
                        <h5>Product 1</h5>
                    </div>
                    <div>Description 1</div>
                </div>

                <div>
                    <div>
                        <h5>Product 2</h5>
                    </div>
                    <div>Description 2</div>
                </div>

                <div>
                    <div>
                        <h5>Product 3</h5>
                    </div>
                    <div>Description 3</div>
                </div>

                <div>
                    <div>
                        <h5>Product 4</h5>
                    </div>
                    <div>Description 4</div>
                </div>

                
            </div>

            <!-- <div>

                {{ json_encode(\App\Models\Payment::all()) }}
            </div>

            <hr />

            <div>
                {{ strlen (json_encode(\App\Models\Product::all())) }}
            </div>

            <div>
                <pre><small>
                {{ json_encode(\App\Models\Product::all()) }}

                </small></pre>

            </div>



            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Launch demo modal
            </button>

            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            ...
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Save changes</button>
                        </div>
                    </div>
                </div>
            </div> -->
        </div>

    </div>




</body>

<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>


</html>