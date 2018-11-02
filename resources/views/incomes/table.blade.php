@foreach($loansGranted as $key => $loanGranted)
    @foreach($loanGranted['payments'] as $key => $payment)
        <tr>
            <th >{{ $loanGranted["loan"]->id }}<span></span></th>
            <td>{{ $loanGranted["loan"]->loanType->name }}</td>
            <td>{{ $payment->payment_number }}</td>
            <td>{{ $loanGranted["loan"]->payments }}</td>
            <td>{{ Carbon\Carbon::parse($payment->due_date)->format('d-m-Y') }}</td>
            <td>{{ $loanGranted["loan"]->total_amount }}</td>
            <td>{{ $loanGranted["loan"]->updated_amount }}</td>
            <td>{{ $payment->payment_amount }}</td>
            <td>{{ $payment->payment_amount_paid }}</td>
        </tr>
    @endforeach
@endforeach


