<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <style>
        .image{
            width: 60%;
            display: block;
            margin: auto;
            object-fit: cover;
        }

        .container{
            padding: 60px 100px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .child{
            margin-top: 30px;
        }

        .butt{
            color: white;
            background: #0FBA68;
            font-weight: bold;
            padding: 8px 15px;
            text-decoration: none;
            border-radius: 10px;
            text-align: center;
            
            width: 50%;
            display: block;
            margin: auto;
        }

        @media (max-width:650px){
            .butt{
                width: 95%
            }
        }


    </style>
</head>

<body>

    <div class="container">
        <div class="content">
            <img class="image" src="{{asset('img/email.png')}}" alt="image">
            <div class="child">
                <h1 style="text-align: center; font-weight:bold; ">
                    Confirmation email
                </h1>
                <h4 style="text-align: center; font-weight:400; display: block; margin-top: -5px;">
                    click this button to verify your email
                </h4>
                <a 
                class="butt"
                  href="{{ route('verify.email', $user->email_verification_token) }}">
                  verify email
                </a>
            </div>
        </div>
       
    </div>
    {{-- mt-6 text-white py-3 bg-greenButton font-bold --}}

</body>

</html>
