<script type="text/javascript">
    @if(!empty(Session::get('message')))
    var popupId = "{{ uniqid() }}";
    if (!sessionStorage.getItem('shown-' + popupId)) {
        swal(
                @if (Session::has('alert-type'))
                    '{{strtoupper(Session::get('alert-type'))}}',
                @endif
                    '{{Session::get('message')}}',
                @if(Session::has('alert-type'))
                    '{{Session::get('alert-type')}}',
                @endif)
    }
    sessionStorage.setItem('shown-' + popupId, '1');
    @endif
</script>

