@component('mail::message')

<div>
 <div>
<div id="mailContent" style="color: black">
<p> Hello, <br> <blockquote> <b>{{ucfirst($user->name)}} </b></blockquote></p>

<p style="font-size: 22px;font-family: 'Lato', sans-serif;line-height: 1.5;color: black">
 This is a notice that an invoice has been generated on {{\Carbon\Carbon::now()->format('Y-m-d')}}

</p>

<br> Your payment method is: Cash / Bank Deposit/Transfer
@component('mail::panel')
<h1>Trip Details</h1>
<h2>Booking ID: {{$tripbooking->bookid}}</h2>
Trip Name : {{$tripdate->name}} <br>
Start Location : {{$tripdate->start_location}} <br>
Finish Location : {{$tripdate->finish_location}} <br>
        Departure Date : {{$tripbooking->start_date}}
@endcomponent

<br> <br>
The invoice for the transaction is attached with the mail. <br>
@component('mail::panel')
<h1>Bank Details</h1>
Bank Name: Himalayan Bank Limited <br>
Bank Address: Thamel, Kathmandu, Nepal <br>
Account Name: Swotah Travel and Adventure Pvt. Ltd. <br>
Account Number: 01906810810017 <br>
Account Type ($): Current <br>
<h2>Swift Code: HIMANPKA</h2>
@endcomponent
</div>
 </div>
</div>
 Important Note:  <br>
 Please make sure that you send the wire transfer deposit slip at: info@swotahtravel.com within three days of your booking date. <br>
 If sending a deposit slip takes longer than three days, you need to inform us in advance otherwise the invoice will be considered void. <br>

 Thanks, {{ config('app.name') }}


@endcomponent
