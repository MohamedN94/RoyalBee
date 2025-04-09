<span>
    @if($payment->payment_status == 0)
        {{__('Pending')}}
    @else
        --
    @endif
</span>
