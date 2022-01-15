@component('mail::message')
<div style="padding-top: 50px;">
    <center>
        <div style="padding: 0px 15px;">
            <img class="image" src="{{asset('img/email.png')}}" alt="image">
        </div>
    </center>
    
    <div style="margin-top: 40px">
        <h1 style="margin-top:25px; text-align: center; font-weight:bold; font-size:25px; color:black;">Confirmation email </h1><br>
        <div style="margin-top: -33px;">
            <p style="text-align: center; color:black;"> click this button to verify your email </p>
        </div>
    </div>
</div>

<center>
    <a 
        style="color:white; background:#0FBA68; font-weight:bold; border-radius:9px; border:none; padding:8px 68px; text-decoration:none;"
        href="{{ route('verify.email', $user->email_verification_token) }}" class="btn">
        VERIFY EMAIL
    </a>
</center>

