@extends('layouts.layout')

@section('content')

<h2>{{ $customer->name }}</h2>

<h4>Balance:
    {{ $runningBalance }}
</h4>

<form action="{{ route('ledger.store') }}"
      method="POST">
@csrf
    <input type="hidden"
    name="customer_id"
    value="{{ $customer->id }}">

    <input type="number"
           name="credit"
           placeholder="you gave him">

    <input type="number"
           name="debit"
           placeholder="you got from him">

    <input type="text"
           name="remarks"
           placeholder="Remarks">

    <button type="submit">
        Save
    </button>

</form>
<hr>

<h3>Transaction History</h3>

<table class="table">

    <thead>

        <tr>

            <th>Date & Time</th>

            <th>You Gave</th>

            <th>You Got</th>

            <th>Balance</th>

            <th>Remarks</th>

        </tr>

    </thead>

    <tbody>

        @php
            $runningBalance = 0;
        @endphp
    
        @foreach($ledgers as $ledger)
    
            @php
                $credit = $ledger->credit;
                $debit = $ledger->debit;
                $runningBalance += $credit - $debit;
            @endphp
    
            <tr>
    
                <td>
                    {{ $ledger->created_at }}
                </td>
    
                <td>
                    {{ $credit }}
                </td>
    
                <td>
                    {{ $debit }}
                </td>
    
                <td>
                    {{ $runningBalance }}
                </td>
    
                <td>
                    {{ $ledger->remarks }}
                </td>
    
            </tr>
    
        @endforeach
    
    </tbody>
</table>

@endsection