<div class="table-responsive mt-3">
    <table class="table time-center tfr my_stripe_single" id="closeshiftTbl">
        <thead>
            <tr class="item_header bg-gradient-directional-blue white ">
                <th width="5%" class="text-center">User</th>
                <th width="15%" class="text-center">Pump</th>
                <th width="10%" class="text-center">Nozzle</th>
                <th width="10%" class="text-center">Item</th>
                <th width="20%" class="text-center">Opening Reading</th>
                <th width="30%" class="text-center">Current Readings</th>
                <th width="30%" class="text-center">Balance</th>
                <th width="30%" class="text-center">Amount</th>
                {{-- <th width="10%" class="text-center">Actions</th>                --}}
            </tr>
        </thead>
        <tbody>
            <!-- layout -->
            
            @if (isset($close_shift))
                @foreach ($close_shift->close_shift_items as $i => $item)
                <tr>
                    {{-- <td>{{$i+1}}</td>     --}}
                    <td>{{$item->user ? $item->user->name : ''}}</td>    
                    <td>{{$item->pump ? $item->pump->name : ''}}</td>    
                    <td>{{$item->nozzle ? $item->nozzle->code : ''}}</td>    
                    <td>{{$item->product ? $item->product->name : ''}}</td>      
                    <td><input name="open_stock[]" id="open_stock" class="form-control open_stock" value="{{$item->open_stock}}" readonly></td> 
                    <td><input name="current_stock[]" id="current_stock" class="form-control current_stock" value="{{$item->current_stock}}"></td>
                    <td><input name="balance[]" id="balance" class="form-control balance" value="{{$item->balance}}" readonly></td>
                    <td width="30%"><input name="amount[]" id="amount" class="form-control amount" value="{{$item->amount}}" readonly></td>
                    <input type="hidden" name="product_id[]" id="product_id" value="{{$item->product_id}}">
                    <input type="hidden" name="product_price[]" class="product_price" id="product_price" value="{{$item->product_price}}">
                    <input type="hidden" name="category[]" class="category" id="category" value="{{$item->category}}">
                    <input type="hidden" name="pump_id[]" id="pump_id" value="{{$item->pump_id}}">
                    <input type="hidden" name="user_id[]" id="user_id" value="{{$item->user_id}}">
                    <input type="hidden" name="nozzle_id[]" id="nozzle_id" value="{{$item->nozzle_id}}">
                    <input type="hidden" name="id[]" id="id" value="{{$item->id}}">
                </tr>
                @endforeach
            @endif
        </tbody>
    </table>
</div>
{{-- <a href="javascript:" class="btn btn-success mb-3" aria-label="Left Align" id="addstock"><i data-feather="plus"></i> Add Row</a> --}}