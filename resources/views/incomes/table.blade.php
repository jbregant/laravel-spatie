@foreach($loansGranted as $key => $loanGranted)
    @foreach($loanGranted['payments'] as $key => $payment)
        <tr>
            <th >{{ $loanGranted["loan"]->id }}<span></span></th>
            <td>{{ $loanGranted["loan"]->loanType->name }}</td>
            <td>{{ $payment->payment_number }}</td>
            <td>{{ $loanGranted["loan"]->payments }}</td>
            <td>{{ Carbon\Carbon::parse($payment->due_date)->format('d-m-Y') }}</td>
        </tr>
    @endforeach
@endforeach


