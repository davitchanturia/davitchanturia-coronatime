@component('mail::message')
<div style="padding-top: 50px;">
    <center>
        <div style="padding: 0px 15px;">
            <img class="image" src="{{asset('img/email.png')}}" alt="image">
        </div>
    </center>
    
    <div style="margin-top: 40px">
        <h1 style="margin-top:25px; text-align: center; font-weight:bold; font-size:25px; color:black;">Recover password</h1><br>
        <div style="margin-top: -33px;">
            <p style="text-align: center; color:black;"> click this button to recover a password</p>
        </div>
    </div>
</div>

<center>
    <a 
        style="color:white; background:#0FBA68; font-weight:bold; border-radius:9px; border:none; padding:8px 68px; text-decoration:none;"
        href="{{ route('password.reset', $user['token']) }}" class="btn">
        RECOVER PASSWORD
    </a>
</center>

