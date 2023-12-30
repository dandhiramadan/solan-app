<div>
    {{-- Knowing others is intelligence; knowing yourself is true wisdom. --}}
    <div class="card mb-4">
        <div class="table-responsive text-nowrap">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>SPK</th>
                        <th>Pemesan</th>
                        <th>Order</th>
                        <th>No PO</th>
                        <th>Code Style</th>
                        <th>Tgl masuk</th>
                        <th>Tgl kirim</th>
                        <th>Total Quantity</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    <tr>
                        <td>{{ $dataSpk->spk_number }}</td>
                        <td>{{ $dataSpk->customer_name }}</td>
                        <td>{{ $dataSpk->order_name }}</td>
                        <td>{{ $dataSpk->purchase_order }}</td>
                        <td>{{ $dataSpk->code_style }}</td>
                        <td>{{ $dataSpk->order_date }}</td>
                        <td>{{ $dataSpk->delivery_date }}</td>
                        <td>{{ $dataSpk->quantity - $dataSpk->stock }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
