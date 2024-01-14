<!DOCTYPE html>
<html lang="en" data-theme="interaction">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @include('admin.components.style')
    
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    

    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>

    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script>
    
    <script>
        // Show overlay
        function showOverlayWithMessage(message) {
            $("<div id='overlay'></div>")
                .css({
                    position: "fixed",
                    top: 0,
                    left: 0,
                    width: "100%",
                    height: "100%",
                    background: "rgba(0, 0, 0, 0.5)",
                    zIndex: 9999,
                    display: "flex",
                    justifyContent: "center",
                    alignItems: "center"
                })
                .html(`
                        <div id='overlay-message' class='d-flex alert alert-success'>
                        <div>${message} &nbsp;</div>
                        <div class="spinner-border text-success" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                        </div>
                    `)
                .appendTo("body");
        }
        // Hide overlay
        function hideOverlay() {
            $("#overlay").remove();
        }

        const waiting_msg = 'جاري المعالجة'
        const err_msg = 'حدث خطأ في المعالجة'

        function showToastMessage(text='تمت المعالجة بنجاح',isError=false){
            Toastify({  text ,
                        duration:3000,
                        style: {
                            background: isError ? "var(--error-color)" : "var(--success-color)",
                            color: "white" },
                            gravity: "top", 
                            position: "center" 
            }).showToast();
        }
    </script>


    <title>وش رايك</title>
    <style>
        html,body{
            direction: rtl;
        }
    </style>
</head>
<body>
    <div id="preloader">
        <div id="loader"></div>
    </div>
    @include('platform.components.navbar')
    <div class="container">
        <main>
                <div class="row pt-4">
                    <div class="col-12 col-md-4 col-lg-3">
                        @include('platform.components.sidebar')
                    </div>
                    <div class="col-12 col-md-8 col-lg-9">
                        @yield('content')
                    </div>
                </div>
        </main>
    </div>
    
     @include('platform.components.footer')
    @include('admin.components.scripts')
    

    <script src="{{ asset('assets/js/script.js') }}"></script>
    
</body>
</html>