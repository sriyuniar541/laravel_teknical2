@extends('index')

@section('title', 'Laporan profit/loss')

@section('content')

<table class="table mt-5" id="table_laporan">
    <thead>
        <tr>
            <th scope="col">Kategori</th>
            <th scope="col">Jan</th>
            <th scope="col">Feb</th>
            <th scope="col">Mar</th>
            <th scope="col">Apr</th>
            <th scope="col">Mei</th>
            <th scope="col">Jun</th>
            <th scope="col">Jul</th>
            <th scope="col">Agu</th>
            <th scope="col">Sep</th>
            <th scope="col">Okt</th>
            <th scope="col">Nov</th>
            <th scope="col">Des</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($totalPerBulanPerKategori as $item)
            <tr class="@if ($item->kategori_id == 1 || $item->kategori_id == 2) table-secondary @else table-danger @endif">
                <td>{{ $item->kategori->nama }}</td>
                @foreach(['jan', 'feb', 'mar', 'apr', 'mei', 'juni', 'juli', 'agus', 'sep', 'okt', 'nov', 'des'] as $month)
                    <td>{{ $item->$month }}</td>
                @endforeach
            </tr>
        @empty
            <tr>
                <td colspan="13">Data tidak ada</td>
            </tr>
        @endforelse
        <tr class="table-secondary fw-bold">
            <td>Total Income</td>
            @foreach(['jan_income', 'feb_income', 'mar_income', 'apr_income', 'mei_income', 'jun_income', 'jul_income', 'agu_income', 'sep_income', 'okt_income', 'nov_income', 'des_income'] as $month)
                <td>{{ $totalIncome->$month }}</td>
            @endforeach
        </tr>
        <tr class="table-danger fw-bold">
            <td>Total Expense</td>
            @foreach(['jan_expense', 'feb_expense', 'mar_expense', 'apr_expense', 'mei_expense', 'jun_expense', 'jul_expense', 'agu_expense', 'sep_expense', 'okt_expense', 'nov_expense', 'des_expense'] as $month)
                <td>{{ $totalExpense->$month }}</td>
            @endforeach
        </tr>
        <tr class="table-info fw-bold">
            <td>Net Income</td>
            @if (!empty($netIncome))
                @foreach(['jan', 'feb', 'mar', 'apr', 'mei', 'jun', 'jul', 'agu', 'sep', 'okt', 'nov', 'des'] as $month)
                    <td>{{ $netIncome[$month] }}</td>
                @endforeach
            @else
                <td colspan="12">Net income not available</td>
            @endif
        </tr>
    </tbody>
</table>

@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#table_laporan').DataTable({
                dom: 'Bfrtip',
                buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
            });
        });
    </script>
@endpush
