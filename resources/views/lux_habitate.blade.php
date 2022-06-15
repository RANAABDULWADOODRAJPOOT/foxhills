<!DOCTYPE html>
<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Questrial" />
    <link rel="stylesheet" href="{{asset('assets/css/app.css')}}">
    <link rel=”stylesheet” href=”build/css/intlTelInput.css”>

    <style type="text/css">
        .navbar{
            padding: .5rem 6rem;
        }
        .menu-item{
            /* font-family: Planyourfuture Light; */
            text-transform: uppercase;
            text-decoration: none;
            padding: 12px 12px 15px;
            border-spacing: 0px;
            border: 0px;
            z-index: 1;
            position: relative;
            font-size: 14px;
            font-weight: 300;
            text-rendering: optimizelegibility;
            line-height: 15px;
            display: flex;
            transition: color 0.25s ease-in-out 0s;
            color: rgb(204, 204, 204) !important;
        }
        .cover {
            min-width: -webkit-fill-available;
            background-color: black;
            border-radius: 0.3125rem;
        }

        
        .coverfilter{
            min-width: 50px;
            background-color: black;
            border-radius: 0.3125rem;
        }
        .subnav-contentone {
            position: absolute;
            background-color: black;
            z-index: 1;
             margin-top: 8px;
          
        }
        .subnav-contenttwo {
            
            position: absolute;
            background-color: black;
            z-index: 1;
            margin-left:-215px;
            margin-top: 8px;
          
        }

        .w-5{
            display: none;
        }

        .flex-1{
            display: none;
        }
        .text-gray-500{
            border: none;
        }


        
        mobileheading{
            font-size: 20px;
        }
        mobileparagraph{
            font-size: 20px;
        }
        .standard{
            font-size:25px;
            color: white;
        }

        .text-muted{
            color: #999;
            text-decoration: none;
            text-transform: uppercase;
            font-size: 14px;
           
        }
        .text-align-last{
            text-align-last:end;
        }



        .text-muted-filter{
            color: #999999;
            text-decoration: none;
            font-size: 20px;
        }
        ::placeholder { 
            color:#999;
            font-size: 15px;
        }
        textarea:focus, input:focus{
            outline: none;
        }
        button:focus, input:focus{
            outline: none;
        }
        input, select, textarea{
         color: #999;
         font-size: 16px;
       }
       .text-grey{
         color: #999;
         font-size: 13px;
       }
       a:hover {
        text-decoration: none;
    }
       .text-grey-mobile{
         color: #999;
         font-size: 16px;
       }
       .mobilefont{
         font-size: 15px;
         color: #999;

       }
       .bannerheight{
     height: 220px;
       }
       .bannerheightdesktop{
     height: 390px;
       }
       .line-height{
        line-height: 33px;
       }
       h2{

        font-family: Questrial,sans-serif;
        text-transform: uppercase;
        font-weight: 400;
        font-size: 24px;
        
        color: #fff;
        margin: 20px 0 10px;
    }
    h3{
         color: #fff;
         font-size: 20px;
    }
    h4{
          color: #fff;
         font-size: 18px;
    }
    h5{
      text-transform: uppercase;  
      font-size: 16px;
    }
    .margin-450{
      margin-top: 50px;
    }
   
    .options:hover{
         background:#999999 !important;
        }

        .btn-slider{
    background:transparent !important;
    color:white;
    border-radius:0px;
    border:1px solid white;
}

.btn-slider:hover{
    background:white !important;
    color:black;
    border-radius:0px;
}
    
.btn-filter{
    background: transparent;
    border-radius: 0px;
    border: 1px solid white;
    color: white;
    font-family: "Tw Cen MT", Helvetica, sans-serif;
}

.btn-filter-active{
    background: white;
    border-radius: 0px;
    border: 1px solid white;
    color: black;
    font-family: "Tw Cen MT", Helvetica, sans-serif;
}

input[type='checkbox']::after{
    background:transparent;
    filter: invert(100%) hue-rotate(18deg) brightness(1.7);
    
}

.dropdown-toggle{
    font-family: Questrial, sans-serif !important;
}

body{
    font-family: Questrial, sans-serif !important;
}


.button-bw:hover{

}




    </style>
</head>
<body style="background-color:black;">

    <script   src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script  src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/js/bootstrap.bundle.min.js"></script>
    <script  src="https://cdn.jsdelivr.net/npm/bs-custom-file-input/dist/bs-custom-file-input.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src=”build/js/intlTelInput.js”></script>



    @yield('header', View::make('includes.header',['allHeadings' => $allHeadings]))
    @yield('content')

     



    <script>
        $( window ).on("load", function() {
            @include('scripts.headerscript')
        });
    </script>




</body>
</html>