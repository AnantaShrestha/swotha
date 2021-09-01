@component('mail::message')
    <div>
        <div>
            <div id="mailContent" style="color: black">
                <p> Hello <br> {{ucfirst($detail->fullname)}} </p>
                <p style="font-size: 22px;font-family: 'Lato', sans-serif;line-height: 1.5;color: black">
                    Congratulations!
                    Your trip has been confirmed with a successful payment. Please find the detailed invoice of your payment attached with this email
                </p>
            </div>
        </div>
    </div>
    Thanks, {{ config('app.name') }}
@endcomponent
